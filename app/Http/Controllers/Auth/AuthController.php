<?php namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Http\Requests\LoginRequest;
use VotingApp\Events\UserCastFirstVote;
use VotingApp\Events\UserRegistered;
use VotingApp\Models\User;
use VotingApp\Models\Candidate;
use VotingApp\Models\Vote;
use Auth;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('voting.enabled', ['only' => ['getLogin', 'postLogin']]);
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the form for user login.
     * GET /login
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return redirect('admin');
    }

    /**
     * Authentication for a non-admin user.
     * POST /login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $input = $request->all();
        $user = User::isCurrentUser($input);
        $newUserAccount = false;

        // If user doesn't exist, attempt to create.
        if (!$user) {
            $this->validate($request, [
                'phone' => 'unique:users',
                'email' => 'unique:users',
            ]);

            $user = User::createNewUser($input);
            $newUserAccount = true;

            event(new UserRegistered($user));
        }

        // Log in the user.
        Auth::login($user);

        // Is the user login on a vote page?
        if ($request->has('candidate_id')) {
            $vote = Vote::createIfEligible($input['candidate_id'], $user->id);

            if ($vote) {
                $candidate = Candidate::find($input['candidate_id']);
                $url = route('candidates.show', [$candidate->slug, '#message']);

                // Trigger a vote transactional message only for new users.
                if ($newUserAccount) {
                    event(new UserCastFirstVote($vote));
                }

                return redirect()->to($url)->with('message', 'Welcome ' . $input['first_name'] . '. We got that vote!');
            } else {
                return redirect()->back()->with('message', 'Welcome back ' . $input['first_name'] . '. You already voted today!');
            }
        }

        return redirect()->intended('/')->withFlashMessage('Welcome ' . $input['first_name']);
    }

    /**
     * Show the form for admin login.
     * GET /admin
     *
     * @return \Illuminate\View\View
     */
    public function getAdmin()
    {
        return view('auth.admin');
    }

    /**
     * Authentication for an admin user.
     * POST /admin
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('message', 'Welcome back!');
        } else {
            return redirect()->back()->withInput()->with('message', 'Invalid username or password!');
        }
    }


    /**
     * Log the current user out of the site.
     * GET /logout
     *
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->home()->withFlashMessage('You\'re now signed out.');
    }
}
