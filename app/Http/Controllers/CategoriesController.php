<?php

use App\Http\Requests\CategoryRequest;

class CategoriesController extends \Controller
{

    protected $category;
    protected $categoryValidator;

    public function __construct(Category $category)
    {
        $this->category = $category;

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
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }


    /**
     * Display the specified resource.
     *
     * @param category $category
     * @return Response
     */
    public function show(Category $category)
    {
        $candidates = $category->candidates;
        $type = get_login_type();
        $winners = Winner::getCategoryWinners($category);
        return view('categories.show', compact('category', 'candidates', 'type', 'winners'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param CategoryRequest $request
     * @return Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories.index');
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
