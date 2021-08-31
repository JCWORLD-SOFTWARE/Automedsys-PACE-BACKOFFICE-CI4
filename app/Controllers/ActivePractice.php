<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class ActivePractice extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$page = $this->request->getVar('page') ?? 1;

		$token = ClientAuthenticator::getToken();
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

	public function show(string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/active/practices/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('active_practice_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('active_practices/show', [
			'practice' => $response['ResponseData'],
		]);
	}
}
