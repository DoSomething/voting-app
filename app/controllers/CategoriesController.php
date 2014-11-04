<?php

class CategoriesController extends \BaseController {

  protected $category;
  protected $categoryValidator;

  public function __construct(Category $category, CategoryValidator $categoryValidator)
  {
    $this->category = $category;
    $this->categoryValidator = $categoryValidator;

    $this->beforeFilter('role:admin', ['except' => ['show']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories = $this->category->get();
    return View::make('categories.index', compact('categories'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('categories.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();
    $this->categoryValidator->validate($input);

    $category = new category($input);
    $category->save();

    return Redirect::route('categories.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(category $category)
  {
    $candidates = $category->candidates;
    return View::make('categories.show', compact('category', 'candidates'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(category $category)
  {
    return View::make('categories.edit', compact('category'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(category $category)
  {
    $input = Input::all();
    $this->categoryValidator->validate($input);

    $category->fill($input);
    $category->save();

    return Redirect::route('categories.index');
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
