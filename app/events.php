<?php

// An event listener that handles user votes.
Event::listen('first.vote', function($candidate, $user) {
  // Don't send messages locally.
  if (App::environment('local')) return;
  // Sign user up for transaction messages.
  $credentials = Config::get('messagebroker.credentials');
  $config = Config::get('messagebroker.config');
  $config['routingKey'] = 'cgg.event.vote';

  $mb = new MessageBroker($credentials, $config);

  $payload = [
    // User information
    'first_name' => $user->first_name,
    'email' => $user->email,
    'mobile' => $user->phone,
    'birthdate_timestamp' => $user->birthdate_timestamp(), // Message Broker expects UNIX timestamp
    'country_code' => $user->country_code,

    // Candidate information.
    'candidate_id' => $candidate->id,
    'candidate_name' => $candidate->name,

    // Request specific information
    'activity' => 'cgg2014_vote',
    'application_id' => 201,
    'activity_timestamp' => time(),
    'email_template' => 'mb-cgg2014-vote',
    'email_tags' => [
      0 => 'cgg2014_vote',
    ],
    'mailchimp_grouping_id' => '10621',
    'mailchimp_group_name' => 'CelebsGoneGood2014',
    'mc_opt_in_path_id' => '174269',
    'merge_vars' => [
      'FNAME' => $user->first_name
    ]
  ];

  $payload = serialize($payload);
  $mb->publishMessage($payload);


});

Event::listen('user.create', function($user) {
  // Don't send messages locally.
  if (App::environment('local')) return;

  //  // Log this event to stathat.
  $stathat_key = Config::get('services.stathat.key');
  if ($stathat_key)
    stathat_ez_count($stathat_key, 'cgg - user register', 1);

  // Sign user up for transaction messages.
  $credentials = Config::get('messagebroker.credentials');
  $config = Config::get('messagebroker.config');
  $config['routingKey'] = 'cgg.user.registration';

  $mb = new MessageBroker($credentials, $config);

  $payload = [
    // User information
    'first_name' => $user->first_name,
    'email' => $user->email,
    'mobile' => $user->phone,
    'birthdate_timestamp' => $user->birthdate_timestamp(), // Message Broker expects UNIX timestamp
    'country_code' => $user->country_code,

    // Request specific information
    'activity' => 'cgg2014_signup',
    'application_id' => 201,
    'activity_timestamp' => time(),
    'email_template' => 'mb-cgg2014-signup',
    'email_tags' => [
      0 => 'cgg2014_signup',
    ],
    'mailchimp_grouping_id' => '10621',
    'mailchimp_group_name' => 'CelebsGoneGood2014',
    'mc_opt_in_path_id' => '174269',
    'merge_vars' => [
      'FNAME' => $user->first_name
    ],
    'user_registration_source' => 'cgg2014'
  ];

  $payload = serialize($payload);
  $mb->publishMessage($payload);

});

Event::listen('user.vote', function() {
  if (App::environment('local')) return;
  // Log this event to stathat.
  $stathat_key = Config::get('services.stathat.key');
  if ($stathat_key)
    stathat_ez_count($stathat_key, 'cgg - vote', 1);
});
