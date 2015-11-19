<?php

namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Models\WinnerCategory;

class WinnerCategoriesController extends Controller
{
    /**
     * Validation rules.
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $winnerCategories = WinnerCategory::orderBy('name', 'asc')->get();

        return view('winner-categories.index', compact('winnerCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('winner-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $winnerCategory = new WinnerCategory($request->all());
        $winnerCategory->save();

        return redirect()->route('winner-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  WinnerCategory $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(WinnerCategory $winnerCategory)
    {
        return view('winner-categories.edit', compact('winnerCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  WinnerCategory $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WinnerCategory $winnerCategory)
    {
        $this->validate($request, $this->rules);

        $winnerCategory->fill($request->all());
        $winnerCategory->save();

        return redirect()->route('winner-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param WinnerCategory $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WinnerCategory $winnerCategory)
    {
        if (count($winnerCategory->winners)) {
            return redirect()->back()
                ->with('message', 'Can\'t delete a category with winners in it.')
                ->with('message_type', 'error');
        }

        $winnerCategory->delete();

        return redirect()->route('winner-categories.index')->with('message', 'BAM! That category was removed.');
    }
}
