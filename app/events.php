<?php

// An event listener that handles user votes.
Event::listen('user.login.to.vote', function($candidate_id, $user_id) {
  // @TODO: check if a user can vote!
  $vote = Vote::createIfEligible($candidate_id, $user_id);
  // @TODO: Add a flash alert here.

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
    'birthdate' => strtotime($user->birthdate), // Message Broker expects UNIX timestamp

    // Request specific information
    'activity' => 'cgg2014_vote',
    'application_id' => 201,
    'activity_timestamp' => '???',
    'email_template' => 'mb-cgg2014-vote',
    'email_tags' => [
      0 => 'cgg2014_vote',
    ],
    'mailchimp_grouping_id' => '', //  need this from Marah
    'mailchimp_group_name' => '', // need this from Marah
    'merge_vars' => [
      'FNAME' => $user->first_name
    ]
  ];

  $payload = serialize($payload);
  $mb->publishMessage($payload);

});

Event::listen('user.create', function($user) {
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
    'birthdate' => strtotime($user->birthdate), // Message Broker expects UNIX timestamp

    // Request specific information
    'activity' => 'cgg2014_signup',
    'application_id' => 201,
    'activity_timestamp' => '???',
    'email_template' => 'mb-cgg2014-signup',
    'email_tags' => [
      0 => 'cgg2014_signup',
    ],
    'mailchimp_grouping_id' => '', //  need this from Marah
    'mailchimp_group_name' => '', // need this from Marah
    'merge_vars' => [
      'FNAME' => $user->first_name
    ]
  ];

  $payload = serialize($payload);
  $mb->publishMessage($payload);
});
