<?php

class VotesController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth');
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
    $candidate = Candidate::find($candidate_id);
    $user = Auth::user();

    // Check if the user is allowed to vote on this candidate.
    if(!$user->canVote($candidate)) return Redirect::back()->withFlashMessage('You can\'t vote on this category yet!');

    Vote::castVote($candidate->id, $user->id);

    return Redirect::back();
	}

}
