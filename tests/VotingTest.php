<?php

use VotingApp\Models\User;
use VotingApp\Models\Setting;
use VotingApp\Models\Candidate;
use VotingApp\Events\UserRegistered;
use VotingApp\Events\UserCastFirstVote;
use DoSomething\Gateway\Resources\NorthstarUser;
use Illuminate\Contracts\Validation\ValidationException;

class VotingTest extends TestCase
{
    protected $candidate;

    protected $userEmail;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = Candidate::all()->first();
    }

    /**
     * Verify that a user may submit their vote.
     * @test
     */
    public function testSubmitVote()
    {
        $northstarMock = $this->mock(\DoSomething\Gateway\Northstar::class);

        $northstarMock->shouldReceive('createUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
        ]));

        $northstarMock->shouldReceive('updateUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
            'interests' => ['cats'],
        ]));

        // Set expectation that events should be triggered for the registration & vote.
        $this->expectsEvents([
            UserRegistered::class,
            UserCastFirstVote::class,
        ]);

        $this->inCountry('US')
            ->visit(route('candidates.show', [$this->candidate->slug]))
            ->type('Puppet', 'first_name')
            ->type('1/2/1990', 'birthdate')
            ->type('test-example-user@example.com', 'email')
            ->press('Count My Vote');

        // We should see confirmation messaging on the following page.
        $this->see('Thanks, we got that vote!');

        // Check the user & vote were created in the database
        $user = User::where('email', 'test-example-user@example.com')->first();

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'first_name' => 'Puppet',
            'birthdate' => '1990-01-02',
            'northstar_id' => '1287216786',
        ]);

        $this->seeInDatabase('votes', [
            'user_id' => $user->id,
            'candidate_id' => $this->candidate->id,
        ]);

        // If the user tries to vote again, they should see an error
        $this->logout();

        $this->visit(route('candidates.show', [$this->candidate->slug]))
            ->type('Puppet', 'first_name')
            ->type('1/2/1990', 'birthdate')
            ->type('test-example-user@example.com', 'email')
            ->press('Count My Vote');

        $this->see('You already voted today!');
    }

    /**
     * Verify that a user may submit their vote, even if their details
     * end up making a conflict on Northstar (e.g. voting with a phone number
     * that's already registered to a different email address).
     * @test
     */
    public function testSubmitVoteWithNorthstarConflict()
    {
        $northstarMock = $this->mock(\DoSomething\Gateway\Northstar::class);

        $northstarMock->shouldReceive('createUser')->andThrow($this->mock(ValidationException::class));

        $northstarMock->shouldNotReceive('updateUser');

        $this->inCountry('US')
            ->visit(route('candidates.show', [$this->candidate->slug]))
            ->type('Puppet', 'first_name')
            ->type('1/2/1990', 'birthdate')
            ->type('test-example-user@example.com', 'email')
            ->press('Count My Vote');

        $this->see('Thanks, we got that vote!');

        $this->seeInDatabase('users', [
            'first_name' => 'Puppet',
            'birthdate' => '1990-01-02',
            'northstar_id' => null,
        ]);
    }

    /**
     * Test voting as a US user, where phone number is optional.
     * Should cast vote without a phone number.
     * @test
     */
    public function testUSVoteWithoutPhone()
    {
        $northstarMock = $this->mock(\DoSomething\Gateway\Northstar::class);

        $northstarMock->shouldReceive('createUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
        ]));

        $northstarMock->shouldReceive('updateUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
            'interests' => ['cats'],
        ]));

        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('US')
            ->visit($url);

        // The cell phone field should be displayed
        $this->see('Cell Number');

        $this->type('Puppet', 'first_name')
            ->type('1/2/1992', 'birthdate')
            ->type('puppet.sloth@example.com', 'email')
            ->press('Count My Vote');

        // Check the user & vote were created in the database
        $user = User::where('email', 'puppet.sloth@example.com')->first();
        $this->seeInDatabase('users', [
            'id' => $user->id,
            'first_name' => 'Puppet',
            'birthdate' => '1992-01-02',
        ]);

        $this->seeInDatabase('votes', [
            'user_id' => $user->id,
            'candidate_id' => $this->candidate->id,
        ]);

        $this->see('Thanks, we got that vote!');
    }

    /**
     * Test voting as a US user, where phone number is optional.
     * Should accept the users phone number and cast vote.
     * @test
     */
    public function testUSVoteWithPhone()
    {
        $northstarMock = $this->mock(\DoSomething\Gateway\Northstar::class);

        $northstarMock->shouldReceive('createUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
        ]));

        $northstarMock->shouldReceive('updateUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
            'interests' => ['cats'],
        ]));

        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('GB')
            ->visit($url)
            ->inCountry('US')
            ->visit($url)
            ->type('Puppet', 'first_name')
            ->type('1/2/1992', 'birthdate')
            ->type('puppet.sloth@example.com', 'email')
            ->type('(650) 253-0000', 'mobile')
            ->press('Count My Vote');

        // Check the user was created in the database
        $user = User::where('email', 'puppet.sloth@example.com')->first();
        $this->assertNotEmpty($user);

        $this->seeInDatabase('users', [
            'first_name' => 'Puppet',
            'mobile' => '6502530000',
            'birthdate' => '1992-01-02',
            'northstar_id' => '1287216786',
        ]);

        $this->see('Thanks, we got that vote!');
    }

    /**
     * Verify basic form validation.
     * @test
     */
    public function testSharedValidationRules()
    {
        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('US')
            ->visit($url)
            ->press('Count My Vote');

        // Required fields should throw errors if blank.
        $this->see('The first name field is required.');
        $this->see('The birthdate field is required.');
        $this->see('The email field is required.');
    }

    /**
     * Verify localized date validation rules for domestic
     * users (e.g. expected `MM/DD/YYYY`).
     */
    public function testUSLocalizedDateValidationRules()
    {
        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('US')
            ->visit($url)
            ->type('30/1/1990', 'birthdate') // Incorrectly DD/MM/YYYY date
            ->press('Count My Vote');

        $this->see('Enter your birthdate in MM/DD/YYYY.');
    }

    /**
     * Verify localized date validation rules for international
     * users (e.g. expected `DD/MM/YYYY`).
     */
    public function testInternationalLocalizedDateValidationRules()
    {
        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('ES')
            ->visit($url)
            ->type('1/30/1990', 'birthdate') // Incorrectly MM/DD/YYYY date
            ->press('Count My Vote');

        $this->see('Enter your birthdate in DD/MM/YYYY.');
    }

    /**
     * Verify that required fields are displayed & validated
     * for international users in countries where we don't
     * collect phone numbers.
     * @test
     */
    public function testInternationalValidation()
    {
        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('ES')
            ->visit($url);

        // The "phone" field should not be present.
        $this->dontSee('Cell Number');
        $this->dontSee('Mobile Number');

        $this->press('Count My Vote');

        // Date field should require `DD/MM/YYYY` format.
        $this->type('lol', 'birthdate');
        $this->press('Count My Vote');

        $this->see('Enter your birthdate in DD/MM/YYYY');
    }

    /**
     * Verify that required fields are displayed & validated for
     * international users in countries where we collect phones.
     * @test
     */
    public function testInternationalValidationWithPhone()
    {
        $setting = Setting::where('key', 'phone_countries')->first();
        $setting->value = 'BR';
        $setting->save();

        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('BR')
            ->visit($url);

        // The "phone" field should be present.
        $this->see('Mobile Number');
        $this->dontSee('Cell Number');

        $this->type('not a phone number', 'mobile')
            ->press('Count My Vote');

        $this->see('That doesn\'t look like a valid phone number.');
    }

    /**
     * Test voting as an international user, where phone number is not
     * accepted. Should accept the users details and cast vote.
     * @test
     */
    public function testInternationalVoteWithEmail()
    {
        $northstarMock = $this->mock(\DoSomething\Gateway\Northstar::class);

        $northstarMock->shouldReceive('createUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
        ]));

        $northstarMock->shouldReceive('updateUser')->andReturn(new NorthstarUser([
            'id' => '1287216786',
            'interests' => ['cats'],
        ]));

        $url = route('candidates.show', [$this->candidate->slug]);

        $this->inCountry('ES')
            ->visit($url)
            ->type('Puppet', 'first_name')
            ->type('25/01/1990', 'birthdate') // DD/MM/YYYY
            ->type('marioneta.pereza@example.com', 'email')
            ->press('Count My Vote');

        // Check the user was created in the database
        $user = User::where('email', 'marioneta.pereza@example.com')->first();
        $this->seeInDatabase('users', [
            'id' => $user->id,
            'first_name' => 'Puppet',
            'birthdate' => '1990-01-25',
        ]);

        $this->see('Thanks, we got that vote!');
    }
}
