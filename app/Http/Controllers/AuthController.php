<?php

namespace VotingApp\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use VotingApp\Services\Registrar;

class AuthController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var \Illuminate\Contracts\Auth\Registrar
     */
    protected $registrar;

    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('voting.enabled', ['only' => ['getLogin', 'postLogin']]);
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the form for admin login.
     * GET /admin.
     *
     * @return \Illuminate\View\View
     */
    public function getAdmin()
    {
        return view('auth.admin');
    }

    /**
     * Authentication for an admin user.
     * POST /admin.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials)) {
            return redirect()->intended('/')->with('message', 'Welcome back!');
        } else {
            return redirect()->back()->withInput()->with('message', 'Invalid username or password!');
        }
    }

    /**
     * Log the current user out of the site.
     * GET /logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();
    }
}
