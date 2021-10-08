<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class Application extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index(string $organizationId)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();

			$filterRequestMap = [
				'APPName' => 'application_name',
				'APPDescr' => 'application_description',
				'UserId' => 'user_id',
				'APPClientId' => 'client_id',
			];

			$filter = new ApiResourceFilter($filterRequestMap);

			$page = $this->request->getVar('page') ?? 1;

			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'query' => array_merge($filter->getParams(), [
						'PageNumber' => $page,
						'PageSize' => static::PER_PAGE,
						'DateFrom' => '2021-01-01'
					])
				]
			);

			$organization = $this->getOrganization($token, $organizationId);
		} catch (Exception $exception) {
			return $this->respond($exception->getMessage());
		}

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('application_index', $organizationId));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('applications/index', [
			'organization' => $organization,
			'applications' => $response['ResponseData']['Items'],
			'pager' => $pager,
			'isFiltered' => $filter->isFiltered(),
			'filter' => $filter->getParams()
		]);
	}

	public function create(string $organizationId)
	{
		try {
			$token = ClientAuthenticator::getToken();
			$organization = $this->getOrganization($token, $organizationId);
		} catch (Exception $exception) {
			return $this->respond($exception->getMessage());
		}

		return view('applications/create', [
			'organization' => $organization
		]);
	}

	public function store(string $organizationId)
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'application_name' => 'required|string|min_length[2]',
			'application_description' => 'required|string|min_length[2]',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'APPName' => $this->request->getPost('application_name'),
						'APPDescr' => $this->request->getPost('application_description'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'New application created successfully');

		return redirect()->route('application_index', [$organizationId]);
	}

	public function show(string $organizationId, string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);

			$organization = $this->getOrganization($token, $organizationId);
			$scopes = $this->getScopes($token);
			$scopeAssignments = $this->getScopeAssignments($token, $id);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('application_index');
		}

		$response = json_decode($response->getBody(), true);

		$assignedScopeIds = array_column($scopeAssignments, 'ScopeDefnId');

		$assignedScopes = array_filter($scopes, fn ($scope) => in_array($scope['ID'], $assignedScopeIds));
		$assignedScopes = array_values($assignedScopes);

		$unassignedScopes = array_filter($scopes, fn ($scope) => !in_array($scope['ID'], $assignedScopeIds));
		$unassignedScopes = array_values($unassignedScopes);

		return view('applications/show', [
			'assignedScopes' => $assignedScopes,
			'unassignedScopes' => $unassignedScopes,
			'organization' => $organization,
			'application' => $response['ResponseData'],
		]);
	}

	public function edit(string $organizationId, string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$response = $client->request(
				'GET',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);

			$organization = $this->getOrganization($token, $organizationId);
			$scopes = $this->getScopes($token);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('application_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('applications/edit', [
			'organization' => $organization,
			'scopes' => $scopes,
			'application' => $response['ResponseData'],
		]);
	}

	public function update(string $organizationId, string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'application_name' => 'required|string|min_length[2]',
			'application_description' => 'required|string|min_length[2]',
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
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications/{$id}",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => [
						'APPName' => $this->request->getPost('application_name'),
						'APPDescr' => $this->request->getPost('application_description'),
					]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Application updated successfully');

		return redirect()->route('application_index', [$organizationId]);
	}

	public function delete(string $organizationId, string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}/applications/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		session()->setFlashdata('success', 'Application deleted successfully');

		return redirect()->route('application_index', [$organizationId]);
	}

	public function getOrganization(string $token, string $organizationId)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/organizations/{$organizationId}",
			['headers' => ['Authorization' => "Bearer {$token}"]]
		);

		$response = json_decode($response->getBody(), true);

		return $response['ResponseData'];
	}

	public function getScopes(string $token)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/scopes",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => [
					'PageSize' => 100,
					'DateFrom' => '2021-01-01'
				]
			]
		);

		$response = json_decode($response->getBody(), true);

		return $response['ResponseData']['Items'];
	}

	public function getScopeAssignments(string $token, string $applicationId)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/applications/{$applicationId}/scopes",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => [
					'PageSize' => 100,
					'DateFrom' => '2021-01-01'
				]
			]
		);

		$response = json_decode($response->getBody(), true);

		return $response['ResponseData']['Items'];
	}
}
