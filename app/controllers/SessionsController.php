<?php

class SessionsController extends \BaseController {

  protected $sessionsValidator;

  public function __construct(SessionValidator $sessionValidator)
  {
    $this->sessionValidator = $sessionValidator;
  }


	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
    $input = Input::only('email', 'password');
    $this->sessionValidator->validate($input);

    if(Auth::attempt($input)) {
      return Redirect::intended('/')->withFlashMessage('Welcome back!');
    }

    return Redirect::back()->withInput()->withFlashMessage('Invalid username or password!');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null)
	{
    Auth::logout();

    return Redirect::home()->withFlashMessage('You\'re now signed out.');;
	}

}
