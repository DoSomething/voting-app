<?php

class UsersController extends \BaseController {

  protected $userValidator;

  public function __construct(User $user, UserValidator $userValidator)
  {
    $this->user = $user;
    $this->userValidator = $userValidator;

    $this->beforeFilter('role:admin', ['only' => ['index', 'show']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $users = $this->user->with('roles')->paginate(25);
    $count = $this->user->count();

    return View::make('users.index', compact('users', 'count'));
  }

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
    if(Auth::check()) return Redirect::home();

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
    return Redirect::home()->withFlashMessage('You\'re all signed up! Get voting!');
	}


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(User $user)
  {
    $votes = $user->votes;
    $vote_count = $user->votes()->count();

    return View::make('users.show', compact('user', 'votes', 'vote_count'));
  }


}
