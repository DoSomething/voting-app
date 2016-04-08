<?php

namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Models\Setting;

class SettingsController extends Controller
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     * GET /settings.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $settings = $this->setting->get();

        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /settings/{id}.
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Setting $setting)
    {
        // If this is a text field, ensure it is not blank
        if ($setting->type === 'text' && $setting->key !== 'phone_countries') {
            $this->validate($request, ['value' => 'required']);
        }

        // If this setting is a file, get & save the uploaded file
        if ($setting->type === 'file') {
            $this->validate($request, ['value' => ['required']]);
            $setting->saveFile($request->file('value'));
        } else {
            // Otherwise, save the value submitted in the request.
            $setting->value = $request->get('value');
        }

        $setting->save();

        return redirect()->route('settings.index')->withFlashMessage('Setting updated.');
    }

    public function destroy(Setting $setting)
    {
        // If this setting is a file, clear the value
        if ($setting->type === 'file') {
            $setting->value = '';
        }

        $setting->save();

        return redirect()->route('settings.index')->withFlashMessage('Setting cleared.');
    }
}
