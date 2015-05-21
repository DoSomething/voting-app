<?php namespace VotingApp\Http\Middleware;

use Closure;
use VotingApp\Repositories\SettingsRepository;


class RedirectIfVotingDisabled {

    /**
     * @var SettingsRepository
     */
    protected $settings;

    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if (!$this->settings->get('enable_voting')) {
            return redirect(route('home'))
                ->with('message', 'Sorry, voting is disabled!')
                ->with('message_type', 'error');
        }

		return $next($request);
	}

}
