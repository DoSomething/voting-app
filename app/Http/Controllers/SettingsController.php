<?php

use Illuminate\Http\Request;

class SettingsController extends \Controller
{

    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     * GET /settings
     *
     * @return Response
     */
    public function index()
    {
        $settings = $this->setting->get();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /settings/{id}/edit
     *
     * @param Setting $setting
     * @return Response
     */
    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /settings/{id}
     *
     * @param Request $request
     * @param Setting $setting
     * @return Response
     */
    public function update(Request $request, Setting $setting)
    {
        // If this is a text field, ensure it is not blank
        if($setting->type === 'text') {
            $this->validate($request, ['value' => 'required']);
        }

        $setting->value = $request->get('value');
        $setting->save();

        return redirect()->route('settings.index')->withFlashMessage('Setting updated.');
    }
}
