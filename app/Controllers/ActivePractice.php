<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use App\Services\EmailNotifier;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
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

	public function edit(string $id)
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

		return view('active_practices/edit', [
			'practice' => $response['ResponseData'],
		]);
	}

	public function update(string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'practice_npi' => "string|exact_length[0,10]",
			'practice_name' => "required|string|min_length[2]",
			'address_line_1' => "required|string|min_length[2]",
			'address_line_2' => "required|string|min_length[2]",
			'country' => "required|string|min_length[2]",
			'state' => "required|string|min_length[2]",
			'city' => "required|string|min_length[2]",
			'zip_code' => "required|string|min_length[2]",
			'contact_prefix' => "string",
			'contact_firstname' => "required|string|min_length[2]",
			'contact_middlename' => "string",
			'contact_lastname' => "required|string|min_length[2]",
			'contact_suffix' => "string",
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$token = ClientAuthenticator::getToken();
			$client->request(
				'PATCH',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/active/practices/{$id}",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'NPI' =>  $this->request->getPost('practice_npi'),
						'PracticeName' =>  $this->request->getPost('practice_name'),
						'Street1' =>  $this->request->getPost('address_line_1'),
						'Street2' =>  $this->request->getPost('address_line_2'),
						'Country' =>  $this->request->getPost('country'),
						'State' =>  $this->request->getPost('state'),
						'City' =>  $this->request->getPost('city'),
						'ZipCode' =>  $this->request->getPost('zip_code'),
						'contact_prefix' =>  $this->request->getPost('contact_prefix'),
						'contact_firstname' =>  $this->request->getPost('contact_first_name'),
						'contact_middlename' =>  $this->request->getPost('contact_middle_name'),
						'contact_lastname' =>  $this->request->getPost('contact_last_name'),
						'contact_suffix' =>  $this->request->getPost('contact_suffix'),
					],
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Active practice details updated successfully');

		return redirect()->route('active_practice_index');
	}

	public function resendNotification(string $id)
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

			$response = json_decode($response->getBody(), true);

			EmailNotifier::providerDeploymentReminder($response['ResponseData']);
		} catch (Exception $exception) {
			return $this->respond(['message' => $exception->getMessage()], 400);
		}

		return $this->respond(['message' => "Notification sent successfully"]);
	}
}
