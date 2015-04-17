<?php

class PagesController extends \Controller
{

  protected $page;
  protected $pageValidator;

  public function __construct(Page $page)
  {
    $this->page = $page;
//    $this->pageValidator = $pageValidator;

    $this->beforeFilter('role:admin', ['except' => ['show']]);
  }

  /**
   * Display a listing of the resource.
   * GET /pages
   *
   * @return Response
   */
  public function index()
  {
    $pages = $this->page->get();
    return view('pages.index', compact('pages'));
  }

  /**
   * Show the form for creating a new resource.
   * GET /pages/create
   *
   * @return Response
   */
  public function create()
  {
    return view('pages.create');
  }

  /**
   * Store a newly created resource in storage.
   * POST /pages
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();
    // @TODO FormRequest
//    $this->pageValidator->validate($input);

    $page = new Page($input);
    $page->save();

    return redirect()->route('pages.index');
  }

  /**
   * Display the specified resource.
   * GET /pages/{id}
   *
   * @param Page $page
   * @return Response
   */
  public function show(Page $page)
  {
    return view('pages.show', compact('page'));
  }

  /**
   * Show the form for editing the specified resource.
   * GET /pages/{id}/edit
   *
   * @param Page $page
   * @return Response
   */
  public function edit(Page $page)
  {
    return view('pages.edit', compact('page'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /pages/{id}
   *
   * @param Page $page
   * @return Response
   */
  public function update(Page $page)
  {
    $input = Input::all();
    $page->fill($input);

    // @TODO FormRequest
//    $this->pageValidator->validate($input);
    $page->save();

    return redirect()->route('pages.index');
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /pages/{id}
   *
   * @param Page $page
   * @return Response
   */
  public function destroy(Page $page)
  {
    //
  }

}
