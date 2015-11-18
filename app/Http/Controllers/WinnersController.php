<?php

namespace VotingApp\Http\Controllers;

use VotingApp\Models\Winner;
use Illuminate\Http\Request;
use VotingApp\Models\WinnerCategory;

class WinnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $winners = Winner::with('candidate.category')->orderBy('rank')->get();

        return view('winners.index', compact('winners', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $winner = Winner::firstOrCreate(['candidate_id' => $request->get('id')]);

        return redirect()->route('winners.edit', ['id' => $winner->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Winner $winner
     * @return \Illuminate\View\View
     */
    public function edit(Winner $winner)
    {
        $winnerCategories = WinnerCategory::lists('name', 'id')->all();
        return view('winners.edit', compact('winner', 'winnerCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Winner $winner
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Winner $winner, Request $request)
    {
        $winner->fill($request->all());
        $winner->save();

        return redirect()->route('winners.index')->with('message', 'Cool, we saved that person as a winner.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Winner $winner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Winner $winner)
    {
        $winner->delete();

        return redirect()->route('winners.index')->with('message', 'BAM! that winner was removed.');
    }
}
