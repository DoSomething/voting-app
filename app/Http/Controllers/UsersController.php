<?php

class UsersController extends \Controller
{

    protected $userValidator;

    public function __construct(User $user)
    {
        $this->user = $user;

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

        return view('users.index', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::check()) {
            return Redirect::home();
        }

        return view('users.create');
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
        $this->validate($input, [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User($input);
        $user->save();

        Auth::login($user);
        return redirect()->home()->withFlashMessage('You\'re all signed up! Get voting!');
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $votes = $user->votes;
        $vote_count = $user->votes()->count();

        return view('users.show', compact('user', 'votes', 'vote_count'));
    }
}
