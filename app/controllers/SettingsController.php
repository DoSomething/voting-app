<?php

class SettingsController extends \BaseController {

  protected $setting;
  protected $settingValidator;

  public function __construct(Setting $setting, SettingValidator $settingValidator)
  {
    $this->setting = $setting;
    $this->settingValidator = $settingValidator;

    $this->beforeFilter('role:admin');
    $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
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
    return View::make('settings.index', compact('settings'));
  }

  /**
   * Show the form for editing the specified resource.
   * GET /settings/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Setting $setting)
  {
    return View::make('settings.edit', compact('setting'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /settings/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Setting $setting)
  {
    $input = Input::only('value');

    $setting->fill($input);
    $setting->save();

    return Redirect::route('settings.index')->withFlashMessage('Setting updated.');
  }

}
