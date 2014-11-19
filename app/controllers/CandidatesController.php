<?php

class CandidatesController extends \BaseController {

  protected $candidate;
  protected $candidateValidator;

  public function __construct(Candidate $candidate, CandidateValidator $candidateValidator)
  {
    $this->candidate = $candidate;
    $this->candidateValidator = $candidateValidator;

    $this->beforeFilter('role:admin', ['except' => ['index', 'show']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $candidates = $this->candidate->get();
    return View::make('candidates.index', compact('candidates'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('candidates.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();
    $this->candidateValidator->validate($input);

    $candidate = new Candidate($input);

    if($file = Input::file('photo')) {
      $image = Image::make($file->getRealPath());
      $candidate->savePhoto($image);
    }

    $candidate->save();

    return Redirect::route('candidates.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Candidate $candidate)
  {
    $votes = $candidate->votes;
    $vote_count = $candidate->votes()->count();
    $type = get_login_type();

    return View::make('candidates.show', compact('candidate', 'votes', 'vote_count', 'type'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Candidate $candidate)
  {
    return View::make('candidates.edit', compact('candidate'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Candidate $candidate)
  {
    $input = Input::all();
    $candidate->fill($input);

    if($file = Input::file('photo')) {
      $image = Image::make($file->getRealPath());
      $candidate->savePhoto($image);
    }

    $this->candidateValidator->validate($input);
    $candidate->resluggify();
    $candidate->save();

    return Redirect::route('candidates.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


}
