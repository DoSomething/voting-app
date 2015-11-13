<?php

namespace VotingApp\Services;

use MessageBroker as MessageBrokerConnection;

class MessageBroker
{
    /**
     * Serialize and send payload to the Message Broker using a
     * given routing key.
     *
     * @param array $payload
     * @param string $routingKey
     */
    public function publishRaw($payload, $routingKey)
    {
        // Don't send messages locally.
        if (app()->environment('local', 'testing')) {
            return;
        }

        // Configure the message broker connection
        $credentials = config('services.message_broker.credentials');
        $config = config('services.message_broker.config');
        $broker = new MessageBrokerConnection($credentials, $config);

        $serializedPayload = serialize($payload);
        $broker->publish($serializedPayload, $routingKey);
    }

    /**
     * Append expected configuration variables to the payload, and
     * then send to the Message Broker.
     *
     * @param string $activity
     * @param array $payload
     * @param string $routingKey
     */
    public function publish($activity, $payload, $routingKey)
    {
        // Set common configuration values:
        $payload['application_id'] = env('MESSAGE_BROKER_APPLICATION_ID');

        // Add activity type and timestamp
        $payload['activity'] = $activity;
        $payload['activity_timestamp'] = time();

        $this->publishRaw($payload, $routingKey);
    }
}
