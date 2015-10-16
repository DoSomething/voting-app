<?php

namespace VotingApp\Http\Controllers;

use VotingApp\Models\User;
use VotingApp\Services\MessageBroker;
use VotingApp\Services\Registrar;

class UsersController extends Controller
{
    /**
     * The registration service.
     *
     * @var Registrar
     */
    protected $registrar;

    public function __construct(User $user, Registrar $registrar, MessageBroker $broker)
    {
        $this->user = $user;
        $this->registrar = $registrar;
        $this->broker = $broker;

        $this->middleware('admin', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $users = $this->user->paginate(25);
        $count = $this->user->count();

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
