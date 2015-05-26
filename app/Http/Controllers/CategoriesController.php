<?php namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Models\Category;
use VotingApp\Models\Winner;

class CategoriesController extends Controller
{

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'name' => 'required',
    ];

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $category = new Category($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param category $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        $candidates = $category->candidates;
        $winners = Winner::getCategoryWinners($category);
        return view('categories.show', compact('category', 'candidates', 'winners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, $this->rules);

        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        if($category->candidates()) {
            return redirect()->back()
                ->with('message', 'Can\'t delete a category with candidates in it.')
                ->with('message_type', 'error');
        }

        $category->delete();
        return redirect()->route('winners.index')->with('message', 'BAM! That category was removed.');
    }

}
