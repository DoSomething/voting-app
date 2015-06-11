<?php namespace VotingApp\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;

class ReactService
{

    /**
     * The HTTP client
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = new Client([
            'base_url' => config('services.react.url'),
            'defaults' => [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'text/html',
                ]
            ]
        ]);
    }

    /**
     * Render a given React component with props.
     *
     * @param $id
     * @param $component
     * @param $props
     * @return string - HTML
     */
    public function render($id, $component, $props)
    {
        $response = $this->client->post($component, ['body' => json_encode($props)]);
        $renderedComponent = $response->getBody()->getContents();

        $markup = '<div data-rendered-component="' . $component .'" id="' . $id . '"">' . $renderedComponent . '</div>';
        $markup = $markup . '<script id="' . $id . '-props" type="application/json">' . json_encode($props) . '</script>';

        return $markup;
    }

}
