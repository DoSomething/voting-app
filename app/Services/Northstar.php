<?php namespace VotingApp\Services;

use GuzzleHttp\Client;
use VotingApp\Models\User;

class Northstar
{

    /**
     * The HTTP client
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $base_url = config('services.northstar.url');
        $key = config('services.northstar.key');

        $this->client = new Client([
            'base_url' => $base_url . '/v1/',
            'defaults' => [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'X-DS-Application-Id' => 456,
                    'X-DS-REST-API-Key' => $key,
                ]
            ]
        ]);
    }

    /**
     * Register a Northstar user for the given VotingApp user.
     *
     * @param User $user
     * @return string - Northstar ID
     */
    public function register(User $user)
    {
        $payload = [
            'first_name' => $user->first_name,
            'birthdate' => $user->birthdate,
            config('services.northstar.id_field') => $user->id
        ];

        if($user->phone) {
            $payload['mobile'] = $user->phone;
        }

        if($user->email) {
            $payload['email'] = $user->email;
        }

        try {
            $response = $this->client->post('users', ['body' => json_encode($payload)]);
            $json = $response->json();

            return $json['_id'];
        } catch(\Exception $e) {
            logger('Northstar API Exception', [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'body' => $e->getResponse()->json()
            ]);
        }
    }

}
