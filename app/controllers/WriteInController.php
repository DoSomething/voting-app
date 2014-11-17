<?php

class WriteInController extends \BaseController {

  public function create()
  {
    return View::make('write-in.create');
  }
  /**
   * Store a newly created resource in storage.
   * POST /votes
   *
   * @return Response
   */
  public function store()
  {
    $user = Auth::user();

    $input = Input::only('candidate_name', 'description');

    $write_in = new WriteIn();
    $write_in->user_id = $user->id;
    $write_in->fill($input);
    $write_in->save();

    return Redirect::back()->with('flash_message', 'Cool, we got that vote!');
  }

}
