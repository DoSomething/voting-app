<?php

class SessionsController extends \BaseController {

  protected $sessionsValidator;

  public function __construct(UserSessionValidator $userSessionValidator)
  {
    $this->userSessionValidator = $userSessionValidator;
    // $this->adminSessionValidator
  }


  /**
   * Show the form for creating a new resource.
   * GET /sessions/create
   *
   * @return Response
   */
  public function create()
  {
    // @TODO: switch email/phone based on IP.
    return View::make('sessions.create');
  }

  /**
   * Allows an admin to log in.
   *
   */
  public function adminCreate()
  {
    return View::make('sessions.admin-create');

  }

  /**
   * Store a newly created resource in storage.
   * POST /sessions
   *
   * @return Response
   */
  public function store()
  {
    // If coming from admin, use that login method.
    if (strpos($_SERVER['HTTP_REFERER'], 'admin')) {
      $input = Input::only('email', 'password');
      return $this->adminLogin($input);
    }
    // Use the user login/create method.
    else {
      $input = Input::only('first_name', 'email', 'birthdate');
      $this->sessionValidator->validate($input);

      return $this->userLogin($input);
    }
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
  /**
   *
   */
  public function userLogin($input)
  {
    $user = User::isCurrentUser($input);
    if (!$user) {
      $user = User::createNewUser($input);
    }
    // Log in the user.
    Auth::login($user);
    return Redirect::intended('/')->withFlashMessage('Welcome ' . $input['first_name']);
  }

  /**
   *
   */
  public function adminLogin($input)
  {
    // $this->sessionValidator->validate($input);
    if(Auth::attempt($input)) {
      return Redirect::intended('/')->withFlashMessage('Welcome back!');
    }
    else {
      return Redirect::back()->withInput()->withFlashMessage('Invalid username or password!');
    }

  }

}
