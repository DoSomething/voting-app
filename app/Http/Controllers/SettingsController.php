<?php

class SettingsController extends \Controller
{

  protected $setting;
  protected $settingValidator;

  public function __construct(Setting $setting, SettingValidator $settingValidator)
  {
    $this->setting = $setting;
    $this->settingValidator = $settingValidator;

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
  public function update(Setting $setting)
  {
    $input = Input::only('value');

    $setting->fill($input);
    $setting->save();

    return redirect()->route('settings.index')->withFlashMessage('Setting updated.');
  }

}
