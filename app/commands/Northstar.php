<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Northstar extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'migrate:northstar';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'This command migrates user data to the Northstar database.';

  protected $client;

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    // Create the Guzzle HTTP Client.
    $base_url = \Config::get('services.northstar.url') . ":" . \Config::get('services.northstar.port');
    $version = \Config::get('services.northstar.version');

    $client = new \GuzzleHttp\Client([
        'base_url' => [$base_url . '/{version}/', ['version' => $version]],
        'defaults' => array(
          'headers' => [
            'X-DS-Application-Id' => \Config::get('services.northstar.app_id') ,
            'X-DS-REST-API-Key' => \Config::get('services.northstar.api_key'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
            ]
          ),
      ]);

    $this->client = $client;
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function fire()
  {
    $users = User::all();

    foreach($users as $user) {
      $tojson =  array(
        'email' => $user->email,
        'mobile' => $user->mobile,
        'cgg_id' => $user->id,
        'first_name' => $user->first_name,
        'birthdate' => $user->birthdate,
        'country' => $user->country_code,
        'updated_at' => $user->created_at,
        'created_at' => $user->updated_at,
      );
      $response = $this->client->post('users', [
        'body' => json_encode($tojson)
      ]);

      echo $user->email . " migrated. \n";
    }
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {

  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {

  }

}
