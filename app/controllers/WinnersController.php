<?php

class WinnersController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $winners = Winner::with('candidate')->get();
    $winners = DB::table('winners')
                  ->join('candidates', 'winners.candidate_id', '=', 'candidates.id')
                  ->join('categories', 'candidates.category_id', '=', 'categories.id')
                  ->select('candidates.name', 'winners.id', 'winners.rank', 'categories.name as category')
                  ->orderBy('category', 'DESC')
                  ->orderBy('rank')
                  ->get();

    return View::make('winners.index', compact('winners', 'categories'));
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
    $candidate_id = Input::get('id');
    $winner = Winner::where('candidate_id', '=', $candidate_id)->first();
    if (!$winner) {
      $winner = new Winner;
      $winner->candidate_id = $candidate_id;
      $winner->save();
    }

    return Redirect::route('winners.edit', array('id' => $winner->id));

  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $winner = Winner::whereId($id)->with('candidate')->firstOrFail();
    return View::make('winners.edit', compact('winner'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $winner = Winner::whereId($id)->firstOrFail();
    $input = Input::all();
    $winner->fill($input)->save();

    return Redirect::route('winners.index')->with('flash_message', 'Cool, we saved that person as a winner.');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $winner = Winner::whereId($id)->firstOrFail();
    $winner->delete();
    return Redirect::route('winners.index')->with('flash_message', 'BAM! that winner was removed.');
  }


}
