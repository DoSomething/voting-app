<?php namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Auth;

class VotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('voting.enabled');
    }

    /**
     * Store a newly created resource in storage.
     * POST /votes
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $candidate_id = $request->get('candidate_id');
        $user_id = Auth::user()->id;

        $vote = Vote::createIfEligible($candidate_id, $user_id);
        if (!$vote) {
            return redirect()
                ->back()
                ->with('message', 'You can\'t vote on this category yet!');
        }

        $candidate = Candidate::find($candidate_id);

        return redirect()
            ->route('candidates.show', [$candidate->slug, '#message'])
            ->with('message', 'We got that vote!');
    }

}
