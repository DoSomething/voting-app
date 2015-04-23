<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use SettingsRepository;


class RedirectIfVotingDisabled {

    /**
     * Array of site settings.
     * @var array
     */
    protected $settings;

    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings->all();
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
        if (!$this->settings['enable_voting']) {
            return redirect(route('home'))
                ->with('message', 'Sorry, voting is disabled!')
                ->with('flash_message_type', 'error');
        }

		return $next($request);
	}

}
