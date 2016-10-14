<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'react' => [
        'url' => env('REACT_SERVER_URL', 'http://localhost:3000'),
    ],

    'stathat' => [
        'debug' => env('APP_DEBUG', false),
        'ez_key' => env('STATHAT_EZ_KEY'),
    ],

    'northstar' => [
        'grant' => 'client_credentials', // Default OAuth grant to use: either 'password' or 'client_credentials'
        'url' => env('NORTHSTAR_URL'), // the environment you want to connect to

        // Then, configure client ID, client secret, and scopes per grant.
        'client_credentials' => [
            'client_id' => env('NORTHSTAR_CLIENT_ID'),
            'client_secret' => env('NORTHSTAR_CLIENT_SECRET'),
            'scope' => ['user', 'admin'],
        ],
        'authorization_code' => [
            'client_id' => env('NORTHSTAR_AUTHORIZATION_ID'),
            'client_secret' => env('NORTHSTAR_AUTHORIZATION_SECRET'),
            'scope' => ['user', 'role:staff', 'role:admin', 'openid'],
            'redirect_uri' => 'login',
        ],
    ],

    'message_broker' => [
        // MailChimp List IDs
        'lists' => [
            'US' => env('MAILCHIMP_LIST_US'),
            'GB' => env('MAILCHIMP_LIST_GB'),
            'BR' => env('MAILCHIMP_LIST_BR'),
            'MX' => env('MAILCHIMP_LIST_MX'),
            'XG' => env('MAILCHIMP_LIST_GLOBAL'),
        ],

        // Mobile Commons/MGage Opt-In Paths
        'opt_in_paths' => [
            'US' => env('MOBILE_OPT_IN_PATH_US'),
            'BR' => env('MOBILE_OPT_IN_PATH_BR'),
            'MX' => env('MOBILE_OPT_IN_PATH_MX'),
            'XG' => env('MOBILE_OPT_IN_PATH_GLOBAL'),
        ],

        'config' => [
            // Exchange options
            'exchange' => [
                'name' => 'directExternalApplicationsExchange',
                'type' => 'topic',
                'passive' => '0',
                'durable' => '1',
                'auto_delete' => '0',
            ],

            // Queue options
            'queue' => [
                'externalApplicationUserQueue' => [
                    'name' => 'externalApplicationUserQueue',
                    'passive' => '0',
                    'durable' => '1',
                    'exclusive' => '0',
                    'auto_delete' => '0',
                    'bindingKey' => '*.user.*',
                ],

                'externalApplicationVoteQueue' => [
                    'name' => 'externalApplicationEventQueue',
                    'passive' => '0',
                    'durable' => '1',
                    'exclusive' => '0',
                    'auto_delete' => '0',
                    'bindingKey' => '*.event.*',
                ],
            ],
        ],

        'credentials' => [
            'host' => env('RABBITMQ_HOST', 'localhost'),
            'port' => env('RABBITMQ_PORT', '5672'),
            'username' => env('RABBITMQ_USERNAME', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost' => env('RABBITMQ_VHOST', ''),
        ],
    ],

];
