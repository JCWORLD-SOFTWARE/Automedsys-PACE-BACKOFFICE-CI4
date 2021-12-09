<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
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

		$filterRequestMap = [
			'FirstName' => 'first_name',
			'LastName' => 'last_name',
			'Provider_Npi' => 'npi',
			'email' => 'email_address',
			'telephone' => 'phone_number',
		];

		$filter = new ApiResourceFilter($filterRequestMap);

		$page = $this->request->getVar('page') ?? 1;

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => array_merge($filter->getParams(), [
					'PageNumber' => $page,
					'PageSize' => static::PER_PAGE,
					'datefrom' => '2021-01-01'
				])
			]
		);

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('user_registration_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('user_registrations/index', [
			'userRegistrations' => $response['ResponseData']['Items'],
			'pager' => $pager,
			'isFiltered' => $filter->isFiltered(),
			'filter' => $filter->getParams()
		]);
	}

	public function create()
	{
		return view('user_registrations/create');
	}

	public function store()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'first_name' => 'required|string|min_length[2]',
			'last_name' => 'required|string|min_length[2]',
			'npi' => 'string|exact_length[0,10]',
			'email_address' => 'required|string|valid_email',
			'phone_number' => 'required|numeric',
			'password' => 'required|string|min_length[5]',
			'g-recaptcha-response' => 'required|string',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'UsernameEmail' => $this->request->getPost('email_address'),
						'Password' => $this->request->getPost('password'),
						'FirstName' => $this->request->getPost('first_name'),
						'LastName' => $this->request->getPost('last_name'),
						'Telephone' => $this->request->getPost('phone_number'),
						'ProviderNPI' => $this->request->getPost('npi'),
						'RequestUrl' => "http://dev.automedsys.com/signup",
						'captchaToken' => $this->request->getPost('g-recaptcha-response')
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'New user signed up successfully');

		return redirect()->route('user_registration_index');
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
					'query' => ['RequestUrl' => "http://dev.automedsys.com/signup"]
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

	public function edit(string $id)
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

		return view('user_registrations/edit', [
			'user' => $response['ResponseData'],
		]);
	}

	public function update(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'first_name' => 'required|string|min_length[2]',
			'last_name' => 'required|string|min_length[2]',
			'npi' => 'string|exact_length[0,10]',
			'email_address' => 'required|string|valid_email',
			'phone_number' => 'required|numeric',
			'password' => 'required|string|min_length[5]',
			'g-recaptcha-response' => 'required|string',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		} 

		try {
			$client->request(
				'PATCH',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup/{$id}",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'UsernameEmail' => $this->request->getPost('email_address'),
						'Password' => $this->request->getPost('password'),
						'FirstName' => $this->request->getPost('first_name'),
						'LastName' => $this->request->getPost('last_name'),
						'Telephone' => $this->request->getPost('phone_number'),
						'ProviderNPI' => $this->request->getPost('npi'),
						'RequestUrl' => "http://dev.automedsys.com/signup",
						'captchaToken' => $this->request->getPost('g-recaptcha-response')
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'User sign up updated successfully');

		return redirect()->route('user_registration_index');
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

	public function verifyNPI(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/signup/{$id}/verify-npi",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'query' => ['RequestUrl' => "http://dev.automedsys.com/signup"]
				]
			);
		} catch (Exception $exception) {
			return $this->fail(
				$exception->getMessage(),
				400,
				"An error occured while verifying NPI"
			);
		}

		$response = json_decode($response->getBody(), true);

		return $this->respond($response);
	}
}
