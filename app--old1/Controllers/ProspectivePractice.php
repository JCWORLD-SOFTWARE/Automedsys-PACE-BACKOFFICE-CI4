<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class ProspectivePractice extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$filterRequestMap = [
			'NPI' => 'practice_npi',
			'PracticeName' => 'practice_name',
			'Street1' => 'address_line_1',
			'Street2' => 'address_line_2',
			'Country' => 'country',
			'State' => 'state',
			'City' => 'city',
			'ZipCode' => 'zip_code',
			'contact_prefix' => 'contact_prefix',
			'contact_firstname' => 'contact_firstname',
			'contact_middlename' => 'contact_middlename',
			'contact_lastname' => 'contact_lastname',
			'contact_suffix' => 'contact_suffix',
		];

		$filter = new ApiResourceFilter($filterRequestMap);

		$page = $this->request->getVar('page') ?? 1;

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/prospective/practices",
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
		$pager->setPath(route_to('prospective_practice_index'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('prospective_practices/index', [
			'prospectivePractices' => $response['ResponseData']['Items'],
			'pager' => $pager,
			'isFiltered' => $filter->isFiltered(),
			'filter' => $filter->getParams()
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
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/prospective/practices/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('prospective_practice_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('prospective_practices/show', [
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
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/prospective/practices/{$id}",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->route('prospective_practice_index');
		}

		$response = json_decode($response->getBody(), true);

		return view('prospective_practices/edit', [
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
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/prospective/practices/{$id}",
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

		session()->setFlashdata('success', 'Prospective practice details updated successfully');

		return redirect()->route('prospective_practice_index');
	}

	public function delete(string $id)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/paceapi/v1/prospective/practices/{$id}/reactivate",
				['headers' => ['Authorization' => "Bearer {$token}"]]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		session()->setFlashdata('success', 'Prospective practice deleted successfully');

		return redirect()->route('prospective_practice_index');
	}
}
