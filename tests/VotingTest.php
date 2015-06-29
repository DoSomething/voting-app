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

        $this->userEmail = 'test-example-user@example.com';
    }

    protected function fillVoteForm($candidate)
    {
        $this->visit(route('candidates.show', [$candidate->slug]))
             ->fill('Puppet', '#first_name')
             ->fill('1/1/1990', '#birthdate')
             ->fill($this->userEmail, '#email')
             ->press('Count My Vote');

        return $this;
    }

    /**
     * Verify that a user may submit their vote.
     * @test
     */
    public function testSubmitVote()
    {
        $this->fillVoteForm($this->candidate);
        $this->see('Thanks, we got that vote!');

        // Check the user & vote were created in the database
        $user = User::where('email', $this->userEmail)->first();
        $this->seeInDatabase('votes', [
            'user_id' => $user->id,
            'candidate_id' => $this->candidate->id
        ]);

        // If the user tries to vote again, they should see an error
        $this->visit('logout');
        $this->fillVoteForm($this->candidate);
        $this->see('You already voted today!');
    }

}
