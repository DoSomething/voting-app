<?php namespace VotingApp\Http\Middleware;

use Auth;
use Closure;

class Administrator
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user() || !Auth::user()->admin) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin');
            }
        }

        return $next($request);
    }

}
