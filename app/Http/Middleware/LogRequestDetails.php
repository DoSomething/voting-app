<?php

namespace VotingApp\Http\Middleware;

use Closure;

class LogRequestDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('LOG_REQUEST_DETAILS')) {
            logger('Received request with country header "'.get_country_code().'".', [
                'HTTP_X_FASTLY_COUNTRY_CODE' => $request->server('HTTP_X_FASTLY_COUNTRY_CODE', null),
                'IP' => $request->ip(),
                'url' => $request->url(),
                'method' => $request->method(),
            ]);
        }

        return $next($request);
    }
}
