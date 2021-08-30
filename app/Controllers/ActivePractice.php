<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use GuzzleHttp\Client as HTTPClient;

class ActivePractice extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$page = $this->request->getVar('page') ?? 1;

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/active/practices",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => [
					'PageNumber' => $page,
					'PageSize' => static::PER_PAGE,
					'datefrom' => '2021-01-01'
				]
			]
		);

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('active_practice_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('active_practices/index', [
			'activePractices' => $response['ResponseData']['Items'],
			'pager' => $pager,
		]);
	}
}
