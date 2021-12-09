<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class Scope extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$filterRequestMap = [
			'ScopeID' => 'scope_id',
			'ScopeDescr' => 'scope_description',
			'ReqdGrantTypes' => 'requested_grant_types',
		];

		$filter = new ApiResourceFilter($filterRequestMap);

		$page = $this->request->getVar('page') ?? 1;

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => array_merge($filter->getParams(), [
					'PageNumber' => $page,
					'PageSize' => static::PER_PAGE,
					'DateFrom' => '2021-01-01'
				])
			]
		);

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('scope_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('scopes/index', [
			'scopes' => $response['ResponseData']['Items'],
			'pager' => $pager,
			'isFiltered' => $filter->isFiltered(),
			'filter' => $filter->getParams()
		]);
	}

	public function create()
	{
		return view('scopes/create');
	}

	public function store()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'scope_id' => 'required|string|min_length[2]',
			'scope_description' => 'required|string|min_length[2]',
			'requested_grant_types' => 'required|string|min_length[2]',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'ScopeID' => $this->request->getPost('scope_id'),
						'ScopeDescr' => $this->request->getPost('scope_description'),
						'ReqdGrantTypes' => $this->request->getPost('requested_grant_types'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'New scope created successfully');

		return redirect()->route('scope_index');
	}

	public function show(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('scope_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('scopes/show', [
			'scope' => $response['ResponseData'],
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
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('scope_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('scopes/edit', [
			'scope' => $response['ResponseData'],
		]);
	}

	public function update(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'scope_id' => 'required|string|min_length[2]',
			'scope_description' => 'required|string|min_length[2]',
			'requested_grant_types' => 'required|string|min_length[2]',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'PATCH',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes/{$id}",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'ScopeID' => $this->request->getPost('scope_id'),
						'ScopeDescr' => $this->request->getPost('scope_description'),
						'ReqdGrantTypes' => $this->request->getPost('requested_grant_types'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Scope updated successfully');

		return redirect()->route('scope_index');
	}

	public function delete(string $id)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		session()->setFlashdata('success', 'Scope deleted successfully');

		return redirect()->route('scope_index');
	}
}
