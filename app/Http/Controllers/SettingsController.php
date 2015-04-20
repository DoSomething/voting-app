<?php

use App\Http\Requests\SettingRequest;

class SettingsController extends \Controller
{

  protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;

        $this->beforeFilter('role:admin');
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
   * @param Setting $setting
   * @return Response
   */
  public function update(Setting $setting, SettingRequest $request)
  {
      $setting->fill($request->all());
      $setting->save();

      return redirect()->route('settings.index')->withFlashMessage('Setting updated.');
  }
}
