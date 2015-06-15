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

    public function __construct($url)
    {
        $this->client = new Client([
            'base_url' => $url,
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
     * @param $component
     * @param $props
     * @return string - HTML
     */
    public function render($component, $props)
    {
        $propsJSON = json_encode($props);
        $id = $component . md5($component . $propsJSON);

        try {
            $response = $this->client->post($component, ['body' => $propsJSON]);
            $renderedComponent = $response->getBody()->getContents();
        } catch(RequestException $e) {
            app('log')->error('Unable to pre-render React view.', [$e]);
            $renderedComponent = '';
        }

        $markup = '<div data-rendered-component="' . $component .'" id="' . $id . '">' . $renderedComponent . '</div>';
        $markup = $markup . '<script id="' . $id . '-props" type="application/json">' . $propsJSON . '</script>';

        return $markup;
    }

}
