<?php

return [
  'config' => [
    // Exchange options
    'exchange' => [
      'name' => getenv("MB_EXTERNAL_APPLICATIONS_EXCHANGE"),
      'type' => getenv("MB_EXTERNAL_APPLICATIONS_EXCHANGE_TYPE"),
      'passive' => getenv("MB_EXTERNAL_APPLICATIONS_EXCHANGE_PASSIVE"),
      'durable' => getenv("MB_EXTERNAL_APPLICATIONS_EXCHANGE_DURABLE"),
      'auto_delete' => getenv("MB_EXTERNAL_APPLICATIONS_EXCHANGE_AUTO_DELETE"),
    ],

    // Queue options
    'queue' => [
      'externalApplicationUserQueue' => [
        'name' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE'),
        'passive' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE_PASSIVE'),
        'durable' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE_DURABLE'),
        'exclusive' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE_EXCLUSIVE'),
        'auto_delete' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE_AUTO_DELETE'),
        'bindingKey' => getenv('MB_EXTERNAL_APPLICATIONS_USER_QUEUE_BINDING_KEY'),
      ],
    ],
  ],

  'credentials' => [
    'host' => getenv('RABBITMQ_HOST') ? getenv('RABBITMQ_HOST') : 'localhost',
    'port' => getenv('RABBITMQ_PORT') ? getenv('RABBITMQ_PORT') : '5672',
    'username' => getenv('RABBITMQ_USERNAME') ? getenv('RABBITMQ_USERNAME') : 'guest',
    'password' => getenv('RABBITMQ_PASSWORD') ? getenv('RABBITMQ_PASSWORD') : 'guest',
    'vhost' => getenv('RABBITMQ_VHOST') ? getenv('RABBITMQ_VHOST') : '',
  ],

];
