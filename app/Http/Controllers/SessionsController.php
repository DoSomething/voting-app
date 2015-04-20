<?php

use App\Http\Requests\UserSessionRequest;
use App\Http\Requests\AdminSessionRequest;

class SessionsController extends \Controller
{

    protected $sessionsValidator;

    public function __construct()
    {
        // $this->userSessionValidator = $userSessionValidator;
        // $this->adminSessionValidator = $adminSessionValidator;
        // $this->registrationValidator = $registrationValidator;
        // @TODO FormRequest
    }


    /**
     * Show the form for creating a new resource.
     * GET /login
     *
     * @return Response
     */
    public function userCreate()
    {
        return View::make('sessions.login');
    }

    /**
     * Allows an admin to log in.
     * GET /admin
     *
     * @return Response
     */
    public function adminCreate()
    {
        return View::make('sessions.admin');
    }

    /**
     * Remove the specified resource from storage.
     * GET /logout
     *
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();

        return Redirect::home()->withFlashMessage('You\'re now signed out.');
    }

    /**
     * Authentication for a non-admin user.
     * @param UserSessionRequest $request
     */
    public function userLogin(UserSessionRequest $request)
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
            Event::fire('user.create', [$user]);
        }

        // Log in the user.
        Auth::login($user);

        // Is the user login on a vote page?
        if (Input::has('candidate_id')) {
            $vote = Vote::createIfEligible($input['candidate_id'], $user->id);

            if ($vote) {
                $candidate = Candidate::find($input['candidate_id']);
                $url = URL::route('candidates.show', [$candidate->slug, '#message']);

                // Trigger a vote transactional message only for new users.
                if ($newUserAccount) {
                    Event::fire('first.vote', [$candidate, $user]);
                }

                return Redirect::to($url)->withFlashMessage('Welcome ' . $input['first_name'] . '. We got that vote!');
            } else {
                return Redirect::back()->withFlashMessage('Welcome back ' . $input['first_name'] . '. You already voted in that category today!');
            }
        }

        return Redirect::intended('/')->withFlashMessage('Welcome ' . $input['first_name']);
    }

    /**
     * Authentication for an admin user.
     * @param AdminSessionRequest $request
     */
    public function adminLogin(AdminSessionRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::intended('/')->withFlashMessage('Welcome back!');
        } else {
            return Redirect::back()->withInput()->withFlashMessage('Invalid username or password!');
        }
    }
}
