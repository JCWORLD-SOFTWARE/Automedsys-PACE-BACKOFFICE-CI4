<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class Organization extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();

			$page = $this->request->getVar('page') ?? 1;

			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'query' => [
						'PageNumber' => $page,
						'PageSize' => static::PER_PAGE,
						'DateFrom' => '2021-01-01'
					]
				]
			);
		} catch (Exception $exception) {
		}

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('organization_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('organizations/index', [
			'organizations' => $response['ResponseData']['Items'],
			'pager' => $pager,
		]);
	}

	public function create()
	{
		return view('organizations/create');
	}

	public function store()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'organization_name' => 'required|string|min_length[2]',
			'organization_description' => 'required|string|min_length[2]',
			'address_line_1' => 'required|string|min_length[2]',
			'address_line_2' => 'required|string|min_length[2]',
			'city' => 'required|string|min_length[2]',
			'state' => 'required|string|min_length[2]',
			'zip_code' => 'required|string|min_length[2]',
			'country' => 'required|string|min_length[2]',
			'contact_name' => 'required|string|min_length[2]',
			'contact_phone' => 'required|numeric',
			'contact_email' => 'required|string|valid_email',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'OrgName' => $this->request->getPost('organization_name'),
						'OrgDescr' => $this->request->getPost('organization_description'),
						'AddressLine1' => $this->request->getPost('address_line_1'),
						'AddressLine2' => $this->request->getPost('address_line_2'),
						'City' => $this->request->getPost('city'),
						'State' => $this->request->getPost('state'),
						'ZipCode' => $this->request->getPost('zip_code'),
						'Country' => $this->request->getPost('country'),
						'ContactName' => $this->request->getPost('contact_name'),
						'ContactPhone' => $this->request->getPost('contact_phone'),
						'ContactEmail' => $this->request->getPost('contact_email'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'New organization created successfully');

		return redirect()->route('organization_index');
	}

	public function show(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('organization_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('organizations/show', [
			'organization' => $response['ResponseData'],
		]);
	}

	public function edit(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('organization_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('organizations/edit', [
			'organization' => $response['ResponseData'],
		]);
	}

	public function update(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'organization_name' => 'required|string|min_length[2]',
			'organization_description' => 'required|string|min_length[2]',
			'address_line_1' => 'required|string|min_length[2]',
			'address_line_2' => 'required|string|min_length[2]',
			'city' => 'required|string|min_length[2]',
			'state' => 'required|string|min_length[2]',
			'zip_code' => 'required|string|min_length[2]',
			'country' => 'required|string|min_length[2]',
			'contact_name' => 'required|string|min_length[2]',
			'contact_phone' => 'required|numeric',
			'contact_email' => 'required|string|valid_email',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'PATCH',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$id}",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'OrgName' => $this->request->getPost('organization_name'),
						'OrgDescr' => $this->request->getPost('organization_description'),
						'AddressLine1' => $this->request->getPost('address_line_1'),
						'AddressLine2' => $this->request->getPost('address_line_2'),
						'City' => $this->request->getPost('city'),
						'State' => $this->request->getPost('state'),
						'ZipCode' => $this->request->getPost('zip_code'),
						'Country' => $this->request->getPost('country'),
						'ContactName' => $this->request->getPost('contact_name'),
						'ContactPhone' => $this->request->getPost('contact_phone'),
						'ContactEmail' => $this->request->getPost('contact_email'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Organization updated successfully');

		return redirect()->route('organization_index');
	}

	public function delete(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		session()->setFlashdata('success', 'Organization deleted successfully');

		return redirect()->route('organization_index');
	}
}
