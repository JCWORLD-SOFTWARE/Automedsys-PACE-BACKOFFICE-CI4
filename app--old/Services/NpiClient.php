<?php

namespace App\Services;

use GuzzleHttp\Client as HTTPClient;

class NpiClient
{
	public static function getNpiData(string $npi)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/emrapi/v1/npiregisry/providers/{$npi}",
			[
				'headers' => ['Authorization' => "Bearer {$token}"]
			]
		);

		return json_decode($response->getBody());
	}
}
