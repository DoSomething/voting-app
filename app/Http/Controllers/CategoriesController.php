<?php

class CategoriesController extends \Controller
{

  protected $category;
  protected $categoryValidator;

  public function __construct(Category $category)
  {
    $this->category = $category;
    // @TODO FormRequest
//    $this->categoryValidator = $categoryValidator;

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
    return view('categories.index', compact('categories'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('categories.create');
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

    $category = new Category($input);
    $category->save();

    return redirect()->route('categories.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return Response
   */
  public function show(category $category)
  {
    $candidates = $category->candidates;
    $type = get_login_type();
    $winners = Winner::getCategoryWinners($category);
    return View::make('categories.show', compact('category', 'candidates', 'type', 'winners'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return Response
   */
  public function edit(category $category)
  {
    return View::make('categories.edit', compact('category'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int $id
   * @return Response
   */
  public function update(category $category)
  {
    $input = Input::all();
    // @TODO FormRequest
//    $this->categoryValidator->validate($input);

    $category->fill($input);
    $category->save();

    return Redirect::route('categories.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


}
