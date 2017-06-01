<?php

use VotingApp\Models\User;
use VotingApp\Models\Vote;
use VotingApp\Models\Candidate;

class TransactionalTest extends TestCase
{
    /**
     * Test that transactional payload is created correctly.
     */
    public function testMessageBrokerCall()
    {
        $user = User::create([
            'first_name' => 'Jubilation',
            'birthdate' => '10-5-1989',
            'email' => 'jubilation.lee@marvel.com',
        ]);

        $candidate = Candidate::all()->first();

        $vote = Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $candidate->id,
        ]);

        // This should call the Message Broker with the expected activity type & routing key.
        $broker = $this->mock(\VotingApp\Services\MessageBroker::class);
        $broker->shouldReceive('publish')->with('vote', Mockery::any(), 'votingapp.event.vote')->once();

        event(new \VotingApp\Events\UserCastFirstVote($vote));
    }
}
