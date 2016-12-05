<?php

namespace VotingApp\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Paths which should not check CSRF token.
     * @var array
     */
    protected $excludedPaths = [
        'vote',
        'admin'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Skip CSRF verification on excluded paths
        if($this->shouldSkipVerification($request)) {
            return $this->addCookieToResponse($request, $next($request));
        }

        return parent::handle($request, $next);
    }

    /**
     * Check if CSRF verification should be skipped for this page.
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function shouldSkipVerification($request)
    {
        return in_array($request->path(), $this->excludedPaths);
    }
}
