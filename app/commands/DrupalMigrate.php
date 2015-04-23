<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DrupalMigrate extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'migrate:drupal';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'This command migrates user data to the drupal database.';

  /**
   * HTTP client.
   *
   * @var GuzzleHttp\Client
   */
  protected $client;


  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function fire()
  {
    // Create the Guzzle HTTP Client.
    $this->client = new \GuzzleHttp\Client([
      'base_url' => [$this->argument('api_base_url'), []],
      'defaults' => [
        'headers' => [
          'Content-Type' => 'application/json',
          'Accept'       => 'application/json',
        ],
      ],
    ]);

    // Retrieve users.
    $last_user = Setting::find('drupal_migrate_last_user');
    if (!$last_user) {
      Setting::create([
        'key' => 'drupal_migrate_last_user',
        'value' => -1,
      ]);

      // Reload the model.
      // Fixes a bug when primary key gets reset to `0`.
      $last_user = Setting::find('drupal_migrate_last_user');
    }

    $users = User::where('country_code', $this->argument('country_code'))
      ->where('id', '>', $last_user->value)
      ->orderBy('id', 'asc')
      ->get();

    foreach($users as $key => $user) {

      if (empty($user->email)) {
        $this->error("User #" . $user->id . " skipped due to empty email.");
      } else {
        $fields =  [
          'email'                    => $user->email,
          'birthdate'                => $user->birthdate,
          'first_name'               => $user->first_name,
          'user_registration_source' => 'CGG',
        ];

        // Optional.
        if (!empty($user->phone)) {
          $fields['mobile'] = $user->phone;
        }

        try {
          $this->client->post('users', [
            'body' => json_encode($fields)
          ]);
          $this->info("User " . $user->email . " migrated.");
        } catch (GuzzleHttp\Exception\ClientException $e) {
          // No response, unknown error.
          if (!$e->hasResponse()) {
            $this->error($e);
          } else {
            // Check the response.
            $reason = $e->getResponse()->getReasonPhrase();
            $pattern = '/^: Email .+ is registered to User uid [0-9]+.$/';
            if (preg_match($pattern, $reason)) {
              // User already exists.
              $this->comment("User " . $user->email . " already registered.");
            } else {
              // Unknown response.
              $this->error($reason);
            }
          }
        }
      }

      // Save last_user id.
      $last_user->update(['value' => $user->id]);
    }
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['api_base_url', InputOption::VALUE_REQUIRED, 'Drupal API endpoint to push users to.'],
      ['country_code', InputOption::VALUE_REQUIRED, 'Soecify country code to filter users.'],
    ];
  }

}
