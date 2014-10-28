<?php

class UsersController extends \BaseController {

  protected $userValidator;

  public function __construct(UserValidator $userValidator)
  {
    $this->userValidator = $userValidator;
  }

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
    $input = Input::all();
    $this->userValidator->validate($input);

    $user = new User($input);
    $user->save();

    Auth::login($user);
    return Redirect::to('/');
	}

}
