<?php namespace VotingApp\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use VotingApp\Models\Candidate;
use VotingApp\Models\User;
use Exception;

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
        $appId = config('services.northstar.app_id');
        $key = config('services.northstar.key');

        $this->client = new Client([
            'base_url' => $base_url . '/v1/',
            'defaults' => [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'X-DS-Application-Id' => $appId,
                    'X-DS-REST-API-Key' => $key,
                ]
            ]
        ]);
    }

    /**
     * Log any exceptions that occur.
     * @param \Exception $e
     */
    public function logException(Exception $e)
    {
        app('stathat')->ezCount(env('STATHAT_APP_NAME', 'votingapp') . ' - Northstar API error', 1);

        $info = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
        ];

        if($e instanceof RequestException)
        {
            $info['body'] = $e->getResponse()->json();
        }

        logger('Northstar API Exception', $info);
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

        if($user->country_code) {
            $payload['country'] = $user->country_code;
        }

        try {
            $response = $this->client->post('users', ['body' => json_encode($payload)]);
            $json = $response->json();

            return $json['data']['_id'];
        } catch(Exception $e) {
            $this->logException($e);
            return null;
        }
    }

    /**
     * Store a candidate's category in the User's interest
     * field on Northstar.
     *
     * @param User $user
     * @param Candidate $candidate
     * @return bool - Success or failure
     */
    public function storeInterest(User $user, Candidate $candidate)
    {
        if(!$user->northstar_id) return false;

        $payload = ['interests' => $candidate->category->slug];

        try {
            $response = $this->client->put('users/' . e($user->northstar_id), ['body' => json_encode($payload)]);
            return $response->getStatusCode() === 200;
        } catch(Exception $e) {
            $this->logException($e);
            return false;
        }

    }

}
