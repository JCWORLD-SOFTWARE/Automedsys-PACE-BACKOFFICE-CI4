<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class UserRegistration extends BaseController
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
			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup",
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
		$pager->setPath(route_to('user_registration_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('user_registrations/index', [
			'userRegistrations' => $response['ResponseData']['Items'],
			'pager' => $pager,
		]);
	}

	public function show(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('user_registration_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('user_registrations/show', [
			'user' => $response['ResponseData'],
		]);
	}

	public function resendNotification(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup/{$id}/resend-notification",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'query' => ['RequestUrl' => "http://dev.automedsys.com/signup/"]
				]
			);
		} catch (Exception $exception) {
			return $this->fail(
				$exception->getMessage(),
				400,
				"An error occured while resending notification"
			);
		}

		$response = json_decode($response->getBody(), true);

		return $this->respond($response);
	}

	public function delete(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		session()->setFlashdata('success', 'User sign up deleted successfully');

		return redirect()->route('user_registration_index');
	}
}
