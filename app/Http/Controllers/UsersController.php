<?php

class UsersController extends \Controller
{

    protected $userValidator;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('admin');
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
