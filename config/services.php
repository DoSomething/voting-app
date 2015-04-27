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

    'stathat' => [
        'key' => env('STATHAT_EZ_KEY')
    ],

    'message_broker' => [
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
