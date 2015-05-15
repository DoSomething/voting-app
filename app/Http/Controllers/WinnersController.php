<?php namespace VotingApp\Http\Controllers;

use VotingApp\Models\Winner;
use Illuminate\Http\Request;
use DB;

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
        $winners = DB::table('winners')
            ->join('candidates', 'winners.candidate_id', '=', 'candidates.id')
            ->join('categories', 'candidates.category_id', '=', 'categories.id')
            ->select('candidates.name', 'winners.id', 'winners.rank', 'categories.name as category')
            ->orderBy('category', 'DESC')
            ->orderBy('rank')
            ->get();

        return view('winners.index', compact('winners', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $candidate_id = Input::get('id');
        $winner = Winner::where('candidate_id', '=', $candidate_id)->first();
        if (!$winner) {
            $winner = new Winner;
            $winner->candidate_id = $candidate_id;
            $winner->save();
        }

        return redirect()->route('winners.edit', ['id' => $winner->id]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $winner = Winner::whereId($id)->with('candidate')->firstOrFail();
        return view('winners.edit', compact('winner'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $winner = Winner::whereId($id)->firstOrFail();
        $winner->fill($request->all());
        $winner->save();

        return redirect()->route('winners.index')->with('message', 'Cool, we saved that person as a winner.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $winner = Winner::whereId($id)->firstOrFail();
        $winner->delete();
        return redirect()->route('winners.index')->with('message', 'BAM! that winner was removed.');
    }
}
