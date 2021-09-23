<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use Config\Services;
use App\Services\AuxPaceClient;
use CodeIgniter\API\ResponseTrait;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class Server extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function index()
	{
		return view('servers/index', [
			'servers' => AuxPaceClient::getPracticeServerList(),
		]);
	}

	// public function index()
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	$page = $this->request->getVar('page') ?? 1;

	// 	$response = $client->request(
	// 		'GET',
	// 		"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers",
	// 		[
	// 			'headers' => ['Authorization' => "Bearer {$token}"],
	// 			'query' => [
	// 				'PageNumber' => $page,
	// 				'PageSize' => static::PER_PAGE,
	// 				'datefrom' => '2021-01-01'
	// 			]
	// 		]
	// 	);

	// 	$response = json_decode($response->getBody(), true);

	// 	$pager = service('pager');
	// 	$pager->setPath(route_to('user_registration_index'));
	// 	$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

	// 	return view('servers/index', [
	// 		'userRegistrations' => $response['ResponseData']['Items'],
	// 		'pager' => $pager,
	// 	]);
	// }

	// public function create()
	// {
	// 	return view('servers/create');
	// }

	// public function store()
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	$validation =  Services::validation();

	// 	$validation->setRules([
	// 		'first_name' => 'required|string|min_length[2]',
	// 		'last_name' => 'required|string|min_length[2]',
	// 		'npi' => 'string|exact_length[0,10]',
	// 		'email_address' => 'required|string|valid_email',
	// 		'phone_number' => 'required|numeric',
	// 		'password' => 'required|string|min_length[5]',
	// 		'g-recaptcha-response' => 'required|string',
	// 	]);

	// 	if (!$validation->withRequest($this->request)->run()) {
	// 		return redirect()->back()
	// 			->withInput()
	// 			->with('errors', $validation->getErrors());
	// 	}

	// 	{
	// 		"Name": "string",
	// 		"HostAddress": "string",
	// 		"PortNo": "string",
	// 		"Binding": "string",
	// 		"EndpointAddress": "string",
	// 		"ApplicationPackage": "string",
	// 		"ApplicationDeployment": "string",
	// 		"Status": 0,
	// 		"PortRange": [
	// 			{
	// 			"min_port": 0,
	// 			"max_port": 0
	// 			}
	// 		],
	// 		"LegacyPortRange": [
	// 			{
	// 			"min_port": 0,
	// 			"max_port": 0
	// 			}
	// 		]
	// 	}

	// 	try {
	// 		$client->request(
	// 			'POST',
	// 			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers",
	// 			[
	// 				'headers' => ['Authorization' => "Bearer {$token}"],
	// 				'json' => [
	// 					'UsernameEmail' => $this->request->getPost('email_address'),
	// 					'Password' => $this->request->getPost('password'),
	// 					'FirstName' => $this->request->getPost('first_name'),
	// 					'LastName' => $this->request->getPost('last_name'),
	// 					'Telephone' => $this->request->getPost('phone_number'),
	// 					'ProviderNPI' => $this->request->getPost('npi'),
	// 				]
	// 			]
	// 		);
	// 	} catch (Exception $exception) {
	// 		session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
	// 		return redirect()->back()->withInput();
	// 	}

	// 	session()->setFlashdata('success', 'Server created successfully');

	// 	return redirect()->route('user_registration_index');
	// }

	// public function show(string $id)
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	try {
	// 		$response = $client->request(
	// 			'GET',
	// 			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers/{$id}",
	// 			['headers' => ['Authorization' => "Bearer {$token}"]]
	// 		);
	// 	} catch (Exception $exception) {
	// 		session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
	// 		return redirect()->route('user_registration_index');
	// 	}

	// 	$response = json_decode($response->getBody(), true);

	// 	return view('servers/show', [
	// 		'user' => $response['ResponseData'],
	// 	]);
	// }

	// public function edit(string $id)
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	try {
	// 		$response = $client->request(
	// 			'GET',
	// 			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers/{$id}",
	// 			['headers' => ['Authorization' => "Bearer {$token}"]]
	// 		);
	// 	} catch (Exception $exception) {
	// 		session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
	// 		return redirect()->route('user_registration_index');
	// 	}

	// 	$response = json_decode($response->getBody(), true);

	// 	return view('servers/edit', [
	// 		'user' => $response['ResponseData'],
	// 	]);
	// }

	// public function update(string $id)
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	$validation =  Services::validation();

	// 	$validation->setRules([
	// 		'first_name' => 'required|string|min_length[2]',
	// 		'last_name' => 'required|string|min_length[2]',
	// 		'npi' => 'string|exact_length[0,10]',
	// 		'email_address' => 'required|string|valid_email',
	// 		'phone_number' => 'required|numeric',
	// 		'password' => 'required|string|min_length[5]',
	// 		'g-recaptcha-response' => 'required|string',
	// 	]);

	// 	if (!$validation->withRequest($this->request)->run()) {
	// 		return redirect()->back()
	// 			->withInput()
	// 			->with('errors', $validation->getErrors());
	// 	}

	// 	try {
	// 		$client->request(
	// 			'PATCH',
	// 			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers/{$id}",
	// 			[
	// 				'headers' => ['Authorization' => "Bearer {$token}"],
	// 				'json' => [
	// 					'UsernameEmail' => $this->request->getPost('email_address'),
	// 					'Password' => $this->request->getPost('password'),
	// 					'FirstName' => $this->request->getPost('first_name'),
	// 					'LastName' => $this->request->getPost('last_name'),
	// 					'Telephone' => $this->request->getPost('phone_number'),
	// 					'ProviderNPI' => $this->request->getPost('npi')
	// 				]
	// 			]
	// 		);
	// 	} catch (Exception $exception) {
	// 		session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
	// 		return redirect()->back()->withInput();
	// 	}

	// 	session()->setFlashdata('success', 'Server updated successfully');

	// 	return redirect()->route('user_registration_index');
	// }

	// public function delete(string $id)
	// {
	// 	$token = ClientAuthenticator::getToken();
	// 	$client = new HTTPClient();
	// 	$apiEndpointsConfig = config('ApiEndpoints');

	// 	try {
	// 		$client->request(
	// 			'DELETE',
	// 			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/deploymentservers/{$id}",
	// 			['headers' => ['Authorization' => "Bearer {$token}"]]
	// 		);
	// 	} catch (Exception $exception) {
	// 		session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
	// 		return redirect()->back();
	// 	}

	// 	session()->setFlashdata('success', 'Server deleted successfully');

	// 	return redirect()->route('user_registration_index');
	// }
}
