<?php

class PagesController extends \BaseController {

  protected $page;
  protected $pageValidator;

  public function __construct(Page $page, PageValidator $pageValidator)
  {
    $this->page = $page;
    $this->pageValidator = $pageValidator;

    $this->beforeFilter('role:admin', ['except' => ['show']]);
    $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
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
    return View::make('pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pages/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('pages.create');
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
    $this->pageValidator->validate($input);

    $page = new Page($input);
    $page->save();

    return Redirect::route('pages.index');
	}

	/**
	 * Display the specified resource.
	 * GET /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Page $page)
	{
    return View::make('pages.show', compact('page'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Page $page)
	{
    return View::make('pages.edit', compact('page'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Page $page)
	{
    $input = Input::all();
    $page->fill($input);

    $this->pageValidator->validate($input);
    $page->save();

    return Redirect::route('pages.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
