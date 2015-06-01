<?php namespace VotingApp\Http\Controllers;

use VotingApp\Models\Candidate;
use VotingApp\Models\Category;
use Illuminate\Http\Request;
use Auth;
use DB;

class CandidatesController extends Controller
{

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'photo_source' => 'url',
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
        // Show admin interface instead for administrators. Admin users can
        // use the `?guest=1` query parameter to bypass the admin view.
        if(Auth::check() && Auth::user()->hasRole('admin') && !$request->get('guest')) {
            return $this->adminIndex($request);
        }

        $categories = Category::with('candidates')->get();

        return view('candidates.index', compact('categories', 'type'));
    }

    /**
     * Display administrative view for candidates.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function adminIndex(Request $request){
        // Get optional request params.
        $sort_by = $request->get('sort_by');
        $direction = $request->get('direction');

        $query = DB::table('candidates')
            ->join('categories', 'categories.id', '=', 'candidates.category_id')
            ->join('votes', 'candidates.id', '=', 'votes.candidate_id')
            ->select('candidates.name as name', 'candidates.slug', 'candidates.id', 'categories.name as category', DB::raw('COUNT(votes.id) as votes'))
            ->groupBy('candidates.name');

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
        $categories = Category::lists('name', 'id');
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
        $candidate = new Candidate($request->all());

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
        $categories = Category::lists('name', 'id');
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
        $this->validate($request, $this->rules);

        $candidate->fill($request->all());

        if ($file = $request->file('photo')) {
            $image = Image::make($file->getRealPath());
            $candidate->savePhoto($image);
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
