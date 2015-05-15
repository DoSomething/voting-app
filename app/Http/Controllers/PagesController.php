<?php namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;

class PagesController extends Controller
{

    /**
     * @var Page
     */
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;

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
        $pages = $this->page->get();
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
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
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
     * @param Page $page
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page, PageRequest $request)
    {
        $page->fill($request->all());
        $page->save();

        return redirect()->route('pages.index');
    }

}
