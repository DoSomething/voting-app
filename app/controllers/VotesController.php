<?php

class VotesController extends \BaseController {

  public function __construct()
  {
    $this->beforeFilter('auth');
    $this->beforeFilter('voting_disabled');
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
    if (!$vote)
      return Redirect::back()->withFlashMessage('You can\'t vote on this category yet!');

    $candidate = Candidate::find($candidate_id);
    $url = URL::route('candidates.show', [$candidate->slug, '#message']);

    return Redirect::to($url)->withFlashMessage('We got that vote!');
	}

}
