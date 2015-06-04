<?php namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Models\Page;

class PagesController extends Controller
{

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     * GET /pages
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /pages/create
     *
     * @return \Illuminate\View\View;
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /pages
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $page = new Page($request->all());
        $page->save();

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     * GET /pages/{id}
     *
     * @param Page $page
     * @return \Illuminate\View\View;
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /pages/{id}/edit
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /pages/{id}
     *
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, $this->$rules);

        $page->fill($request->all());
        $page->save();

        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->home()->with('message', 'BAM! That page was removed!');
    }

}
