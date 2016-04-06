<?php

namespace VotingApp\Http\Controllers;

use VotingApp\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $users = User::paginate(25);
        $count = $users->count();

        return view('users.index', compact('users', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\View\View;
     */
    public function show(User $user)
    {
        $votes = $user->votes;
        $vote_count = $user->votes()->count();

        return view('users.show', compact('user', 'votes', 'vote_count'));
    }
}
