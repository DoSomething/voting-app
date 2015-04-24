<?php

use App\Http\Requests\CandidateRequest;

class CandidatesController extends \Controller
{

    private $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;

        $this->middleware('admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show admin interface instead for administrators. Admin users can
        // use the `?guest=1` query parameter to bypass the admin view.
        if(Auth::check() && Auth::user()->hasRole('admin') && !Request::get('guest')) {
            return $this->adminIndex();
        }

        $type = get_login_type();
        $categories = Category::with('candidates')->get();

        return view('candidates.index', compact('categories', 'type'));
    }

    /**
     * Display administrative view for candidates.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex(){
        // Get optional request params.
        $sort_by = Request::get('sort_by');
        $direction = Request::get('direction');

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
     * @return Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id');
        return view('candidates.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CandidateRequest $request
     * @return Response
     */
    public function store(CandidateRequest $request)
    {
        $candidate = new Candidate($request->all());

        if ($file = Input::file('photo')) {
            $image = Image::make($file->getRealPath());
            $candidate->savePhoto($image);
        }

        $candidate->save();

        return redirect()->route('candidates.show', [$candidate->slug]);
    }


    /**
     * Display the specified resource.
     *
     * @param Candidate $candidate
     * @return Response
     */
    public function show(Candidate $candidate)
    {
        $votes = $candidate->votes();
        $vote_count = $candidate->votes()->count();
        $type = get_login_type();

        return view('candidates.show', compact('candidate', 'votes', 'vote_count', 'type'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Candidate $candidate
     * @return Response
     */
    public function edit(Candidate $candidate)
    {
        $categories = Category::lists('name', 'id');
        return view('candidates.edit', compact('candidate', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Candidate $candidate
     * @param CandidateRequest $request
     * @return Response
     */
    public function update(Candidate $candidate, CandidateRequest $request)
    {
        $candidate->fill($request->all());

        if ($file = Input::file('photo')) {
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
     * @return Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->home()->with('flash_message', 'BAM, that person was removed!');
    }
}
