<?php

namespace VotingApp\Http\Middleware;

use Closure;

class SetLanguageFromHeader
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
        // Set locale for translation. Will fall back to English.
        app()->setLocale('en_'.get_country_code());

        return $next($request);
    }
}
