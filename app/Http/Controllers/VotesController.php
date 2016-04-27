<?php

namespace VotingApp\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Validation\ValidationException;
use VotingApp\Events\UserCastFirstVote;
use VotingApp\Http\Requests\VoteRequest;
use VotingApp\Models\Candidate;
use VotingApp\Models\Vote;
use Northstar;

class VotesController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var \Illuminate\Contracts\Auth\Registrar
     */
    protected $registrar;

    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('voting.enabled');
    }

    /**
     * Store a newly created resource in storage.
     * POST /votes.
     *
     * @param VoteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VoteRequest $request)
    {
        $user = $this->auth->user();

        // If not logged in... authenticate or register a new user.
        if (! $user) {
            try {
                $user = $this->registrar->create($request->all());
                $this->auth->login($user);
            } catch (ValidationException $e) {
                $slug = Candidate::where('id', $request->get('candidate_id'))->first()->slug;

                return redirect()->route('candidates.show', $slug)
                    ->withErrors($e->errors())->withInput($request->input());
            }
        }

        $hasVotedBefore = Vote::where('user_id', $user->id)->exists();
        $vote = Vote::createIfEligible($request->get('candidate_id'), $user->id);

        // If we couldn't create a vote, redirect back & let the user know.
        if (! $vote) {
            return redirect()->back()->with('message', 'Welcome back '.$request->get('first_name').'. You already voted today!');
        }

        // If this is the user's first vote, trigger an event.
        if (! $hasVotedBefore) {
            event(new UserCastFirstVote($vote));
        }

        // If we have a valid Northstar ID, let's try to update their profile with their vote.
        if (array_has(['CONFLICT', 'ERROR', 'ERROR_CONNECTION'], $user->northstar_id)) {
            Northstar::updateUser($user->northstar_id, [
                'interests' => [
                    $vote->candidate->name,
                ],
            ]);
        }

        $candidate = Candidate::find($request->get('candidate_id'));
        $url = route('candidates.show', [$candidate->slug, '#message']);

        return redirect()->to($url)->with('message', 'Thanks, we got that vote!');
    }
}
