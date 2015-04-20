<?php

use App\Http\Requests\CandidateRequest;

class CandidatesController extends \Controller
{

    private $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;

        $this->beforeFilter('role:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        // @TODO We need an administrative view for this.
//        // Get optional request params.
//        $sort_by = Request::get('sort_by');
//        $direction = Request::get('direction');
//        $filter_by = Request::get('filter_by');
//
//        $query = DB::table('candidates')
//            ->join('categories', 'categories.id', '=', 'candidates.category_id')
//            ->join('votes', 'candidates.id', '=', 'votes.candidate_id')
//            ->select('candidates.name as name', 'candidates.slug', 'candidates.id', 'categories.name as category', DB::raw('COUNT(votes.id) as votes'))
//            ->groupBy('candidates.name');
//        if ($sort_by) {
//            $query->orderBy($sort_by, $direction);
//        } else {
//            $query->orderBy('votes', 'DESC');
//        }
//        if ($filter_by) {
//            $query->where('category_id', $filter_by);
//        }
//
//        $candidates = $query->get();
        $type = get_login_type();
        $categories = Category::with('candidates')->get();

        return view('candidates.index', compact('categories', 'type'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('candidates.create');
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

        return redirect()->route('candidates.index');
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
        return view('candidates.edit', compact('candidate'));
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

        // @TODO FormRequest
//    $this->candidateValidator->validate($input);

        $candidate->save();

        return redirect()->route('candidates.index');
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
