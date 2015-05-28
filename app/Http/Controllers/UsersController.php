<?php namespace VotingApp\Http\Controllers;

use Illuminate\Http\Request;
use VotingApp\Models\User;
use VotingApp\Services\Registrar;

class UsersController extends Controller
{

    /**
     * The registration service.
     *
     * @var Registrar
     */
    protected $registrar;

    public function __construct(User $user, Registrar $registrar)
    {
        $this->user = $user;
        $this->registrar = $registrar;

        $this->middleware('admin', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $users = $this->user->with('roles')->paginate(25);
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
        $this->registrar->create($request->all());

        // @TODO: Add user to transactional bucket through Message Broker!

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
