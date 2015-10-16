<?php

use VotingApp\Models\Candidate;
use VotingApp\Models\User;

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
        $this->visit(route('candidates.show', [$this->candidate->slug]))
            ->fill('Puppet', '#first_name')
            ->fill('1/1/1990', '#birthdate')
            ->fill('test-example-user@example.com', '#email')
            ->press('Count My Vote');

        $this->see('Thanks, we got that vote!');

        // Check the user & vote were created in the database
        $user = User::where('email', 'test-example-user@example.com')->first();
        $this->seeInDatabase('votes', [
            'user_id' => $user->id,
            'candidate_id' => $this->candidate->id,
        ]);

        // If the user tries to vote again, they should see an error
        $this->visit('logout');

        $this->visit(route('candidates.show', [$this->candidate->slug]))
            ->fill('Puppet', '#first_name')
            ->fill('1/1/1990', '#birthdate')
            ->fill('test-example-user@example.com', '#email')
            ->press('Count My Vote');

        $this->see('You already voted today!');
    }

    /**
     * Test voting as a US user, where phone number is required.
     */
    public function testDomesticVote()
    {
        $url = route('candidates.show', [$this->candidate->slug]);

        $this->visitFromCountry($url, 'US')
            ->fill('Puppet', '#first_name')
            ->fill('1/1/1992', '#birthdate')
            ->fill('(123) 456-5555', '#phone')
            ->press('Count My Vote');

        $this->see('Thanks, we got that vote!');
    }

    /**
     * Verify that required fields are validating.
     */
    public function testValidation()
    {
        $url = route('candidates.show', [$this->candidate->slug]);
        $this->visitFromCountry($url, 'ES')
            ->press('Count My Vote');

        $this->see('The first name field is required.');
        $this->see('The birthdate field is required.');
        $this->see('The email field is required.');

        $this->visitFromCountry($url, 'US')
            ->press('Count My Vote');

        $this->see('The first name field is required.');
        $this->see('The birthdate field is required.');
        $this->see('The phone field is required.');
    }
}
