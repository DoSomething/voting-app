<?php

namespace VotingApp\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'VotingApp\Http\Middleware\VerifyCsrfToken',
        'VotingApp\Http\Middleware\SetCountryCodeFromHeader',
        'VotingApp\Http\Middleware\SetLanguageFromHeader',
        'VotingApp\Http\Middleware\LogRequestDetails',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin' => 'VotingApp\Http\Middleware\Administrator',
        'auth' => 'VotingApp\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'VotingApp\Http\Middleware\RedirectIfAuthenticated',
        'voting.enabled' => 'VotingApp\Http\Middleware\RedirectIfVotingDisabled',
    ];
}
