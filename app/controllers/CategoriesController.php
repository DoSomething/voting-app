<?php


class CategoriesController extends \BaseController {

  protected $category;

  public function __construct(Category $category)
  {
    $this->category = $category;
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
    $category = new category(Input::all());

    if(!$category->save()) {
      return Redirect::back()->withInput()->withErrors($category->getErrors());
    }

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
    $category->fill(Input::all());

    if(!$category->save()) {
      return Redirect::back()->withInput()->withErrors($category->getErrors());
    }

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
