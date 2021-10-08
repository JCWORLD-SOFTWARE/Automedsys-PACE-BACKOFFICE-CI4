<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class ScopeAssignment extends BaseController
{
	use ResponseTrait;

	public function store(string $organizationId, string $applicationId)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$validation =  Services::validation();

		$validation->setRules([
			'scopes.*' => 'required|numeric',
		]);

		if (!$validation->withRequest($this->request)->run()) {
			session()->setFlashdata('error', "Invalid form submission");

			return redirect()->back()
				->withInput()
				->with('errors', $validation->getErrors());
		}

		try {
			$token = ClientAuthenticator::getToken();
			$client->request(
				'POST',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/applications/{$applicationId}/scopes",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => ['Scopes' => $this->request->getPost('scopes')]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Scope assigned successfully');

		return redirect()->route('application_show', [$organizationId, $applicationId]);
	}

	public function delete(string $organizationId, string $applicationId, string $scopeId)
	{
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		try {
			$token = ClientAuthenticator::getToken();
			$client->request(
				'DELETE',
				"{$apiEndpointsConfig->baseUrl}/emrapi/v1/apimanagement/applications/{$applicationId}/scopes",
				[
					'headers' => ['Authorization' => "Bearer {$token}"],
					'json' => ['Scopes' => [$scopeId]]
				]
			);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back()->withInput();
		}

		session()->setFlashdata('success', 'Scope unassigned successfully');

		return redirect()->route('application_show', [$organizationId, $applicationId]);
	}
}
