<?php namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     * POST /users
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->registrar->rules());
        $user = $this->registrar->create($request->all());

        // Now that we've registered a user, add them to the transactional bucket.
        $payload = [
            // User information
            'first_name' => $user->first_name,
            'birthdate_timestamp' => strtotime($user->birthdate), // Message Broker expects UNIX timestamp
            'country_code' => $user->country_code,
        ];

        // Send fields for domestic users
        if($user->country_code === 'US') {
            $payload['mobile'] = $user->phone;
            $payload['mobile_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
            ];
        }

        // Send fields for international users
        if($user->country_code !== 'US') {
            $payload['email'] = $user->email;
            $payload['subscribed'] = 1;
            $payload['email_template'] = env('CLOSED_TEMPLATE', 'mb-votingapp-closed');
            $payload['email_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
            ];
            $payload['merge_vars'] = [
                'FNAME' => $user->first_name,
            ];
        }

        $routingKey = env('CLOSED_FORM_ROUTING_KEY', 'votingapp.event.closed');
        $this->broker->publish('closed', $payload, $routingKey);

        // And show confirmation message.
        return view('users.confirmation');
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
