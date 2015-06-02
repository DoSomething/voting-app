<?php

use VotingApp\Models\Candidate;

class VotingTest extends TestCase
{

    protected function fillVoteForm()
    {
        $candidate = Candidate::all()->first();

        $this->visit(route('candidates.show', [$candidate->slug]))
             ->fill('Puppet', '#first_name')
             ->fill('1/1/1990', '#birthdate')
             ->fill('test-example-user@example.com', '#email')
             ->press('Count My Vote');

        return $this;
    }

    /**
     * Verify that a user may submit their vote.
     * @test
     */
    public function testSubmitVote()
    {
        $this->fillVoteForm();
        $this->see('Thanks, we got that vote!');

        // If the user tries to vote again, they should see an error
        $this->visit('logout');
        $this->fillVoteForm();
        $this->see('You already voted today!');
    }

}
