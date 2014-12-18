<?php

class WinnersController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $winner = new Winner;
    $winner->candidate_id = Input::get('id');
    $winner->save();

    return Redirect::route('winners.edit', array('id' => $winner->id));

  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Candidate $candidate)
  {

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Candidate $candidate)
  {

  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Candidate $candidate)
  {

  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Candidate $candidate)
  {

  }


}
