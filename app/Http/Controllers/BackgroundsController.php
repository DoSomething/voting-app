<?php namespace VotingApp\Http\Controllers;

use VotingApp\Models\Background;
use Illuminate\Http\Request;
use Image;

class BackgroundsController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
    }

	/**
	 * Display a listing of the resource.
	 *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
        $backgrounds = Background::all();
        return view('backgrounds.index', compact('backgrounds'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function store(Request $request)
	{
        $this->validate($request, [
            'image' => ['required', 'image', 'mimes:jpeg,png']
        ]);

        $background = new Background();
        $background->saveImage($request->file('image'));
        $background->save();

        return redirect()->route('backgrounds.index')->with('message', 'Saved!');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Background $background
     * @return \Illuminate\Http\RedirectResponse
     */
	public function destroy(Background $background)
	{
        $background->delete();

        return redirect()->route('backgrounds.index')->with('message', 'BAM! That background was removed.');
	}

}
