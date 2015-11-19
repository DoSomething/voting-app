<?php

namespace VotingApp\Http\Controllers;

use VotingApp\Models\Candidate;
use VotingApp\Models\Category;
use VotingApp\Models\Winner;
use VotingApp\Models\WinnerCategory;
use Illuminate\Http\Request;
use Auth;

class CandidatesController extends Controller
{
    /**
     * Validation rules.
     * @var array
     */
    protected $rules = [
        'name' => ['required'],
        'category_id' => ['required'],
        'photo_source' => ['url'],
        'image' => ['image'],
    ];

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $showAsGuest = Auth::check() && Auth::user()->admin && $request->get('guest');

        // Show admin interface instead for administrators. Admin users can
        // use the `?guest=✓` query parameter to bypass the admin view.
        if (Auth::check() && Auth::user()->admin && ! $showAsGuest) {
            return $this->adminIndex($request);
        }

        $query = $request->get('query', '');
        $limit = (int) $request->get('limit', 16);
        $categories = Category::orderBy('name', 'asc')->with('candidates')->get();
        $winnerCategories = WinnerCategory::orderBy('name', 'desc')->with('winners', 'winners.candidate')->get();
        $title = setting('site_title');

        // Hide candidates if `show_candidates` setting is disabled, unless logged
        // in as an administrator & using "show as guest" override
        if (! setting('show_candidates') && ! $showAsGuest) {
            $categories = [];
        }

        return view('candidates.index', compact('categories', 'winnerCategories', 'query', 'limit', 'title'));
    }

    /**
     * Display administrative view for candidates.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function adminIndex(Request $request)
    {
        // Get optional request params.
        $sort_by = $request->get('sort_by', 'name');
        $direction = $request->get('direction', 'ASC');

        $query = app('db')->table('candidates')
            ->join('categories', 'categories.id', '=', 'candidates.category_id')
            ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
            ->select('candidates.name as name', 'candidates.slug', 'candidates.id', 'candidates.gender', 'categories.name as category', app('db')->raw('COUNT(votes.id) as votes'))
            ->groupBy('candidates.id');

        // If a sorting method & direction are provided, order by them.
        if ($sort_by && $direction) {
            $query->orderBy($sort_by, $direction);
        }

        // Within given sorting method, always list in descending vote order.
        $query->orderBy('votes', 'DESC');

        $candidates = $query->get();

        return view('candidates.adminIndex', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();

        return view('candidates.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = $this->rules;
        $rules['name'][] = 'unique:candidates';

        $this->validate($request, $rules);

        $candidate = Candidate::create($request->all());

        if ($file = $request->file('photo')) {
            $candidate->savePhoto($file);
        }

        $candidate->save();

        return redirect()->route('candidates.show', [$candidate->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param Candidate $candidate
     * @return \Illuminate\View\View
     */
    public function show(Candidate $candidate)
    {
        $votes = $candidate->votes();
        $vote_count = $candidate->votes()->count();
        $winner = Winner::with('candidate')->where('candidate_id', $candidate->id)->first();

        if (setting('show_winners') && $winner) {
            return view('candidates.show', compact('candidate', 'winner'));
        }

        return view('candidates.show', compact('candidate', 'votes', 'vote_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Candidate $candidate
     * @return \Illuminate\View\View
     */
    public function edit(Candidate $candidate)
    {
        $categories = Category::lists('name', 'id')->all();

        return view('candidates.edit', compact('candidate', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Candidate $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Candidate $candidate)
    {
        $rules = $this->rules;
        $rules['name'][] = 'unique:candidates,name,'.$candidate->id;

        $this->validate($request, $rules);

        $candidate->fill($request->all());

        if ($file = $request->file('photo')) {
            $candidate->savePhoto($file);
        }

        $candidate->save();

        return redirect()->route('candidates.show', [$candidate->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Candidate $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->votes()->delete();
        $candidate->delete();

        return redirect()->home()->with('message', 'BAM! That candidate was removed!');
    }
}
