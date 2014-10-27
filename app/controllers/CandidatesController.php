<?php


class CandidatesController extends \BaseController {

  protected $candidate;

  public function __construct(Candidate $candidate)
  {
    $this->candidate = $candidate;
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
    $candidate = new Candidate(Input::all());
    $file = Input::file('photo');

    if($file) {
      $image = Image::make($file->getRealPath());
      $filename = $candidate->sluggify()->slug . '.' . $file->getClientOriginalExtension();

      $image->save(public_path('images') . '/' . $filename)
        ->fit(400)
        ->save(public_path('images') . '/' . 'thumb-' . $filename);

      $candidate->photo = $filename;
    }

    if(!$candidate->save()) {
      return Redirect::back()->withInput()->withErrors($candidate->getErrors());
    }

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
    return View::make('candidates.show', compact('candidate'));
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
    $candidate->fill(Input::all());
    $file = Input::file('photo');

    if($file) {
      $image = Image::make($file->getRealPath());
      $filename = $candidate->sluggify()->slug . '.' . $file->getClientOriginalExtension();

      $image->save(public_path('images') . '/' . $filename)
        ->fit(400)
        ->save(public_path('images') . '/' . 'thumb-' . $filename);

      $candidate->photo = $filename;
    }

    if(!$candidate->save()) {
      return Redirect::back()->withInput()->withErrors($candidate->getErrors());
    }

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
