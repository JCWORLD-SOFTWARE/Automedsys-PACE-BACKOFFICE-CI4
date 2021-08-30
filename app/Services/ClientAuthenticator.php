<?php

namespace App\Services;

use GuzzleHttp\Client as HTTPClient;

class ClientAuthenticator
{
    public static function getToken()
    {
        $apiEndpointsConfig = config('ApiEndpoints');

        $baseUrl = $apiEndpointsConfig->baseUrl;
        $username = $apiEndpointsConfig->clientCredentials['username'];
        $password = $apiEndpointsConfig->clientCredentials['password'];

        $client = new HTTPClient();

        $response = $client->request(
            'POST',
            "{$baseUrl}/emrapi/v1/identity/connect/otoken",
            [
                'auth' => [$username, $password],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Media-Type' => 'application/json',
                ],
                'json' => ['grant_type' => 'client_credentials']
            ]
        );

        $response = json_decode($response->getBody(), true);

        return $response['Data']['Token'];
    }
}
