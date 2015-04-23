<?php

class VotesController extends \Controller
{

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('voting.enabled');
    }

    /**
     * Store a newly created resource in storage.
     * POST /votes
     *
     * @return Response
     */
    public function store()
    {
        $candidate_id = Input::get('candidate_id');
        $user_id = Auth::user()->id;

        $vote = Vote::createIfEligible($candidate_id, $user_id);
        if (!$vote) {
            return redirect()->back()->withFlashMessage('You can\'t vote on this category yet!');
        }

        $candidate = Candidate::find($candidate_id);

        return redirect()->route('candidates.show', [$candidate->slug, '#message'])->withFlashMessage('We got that vote!');
    }
}
