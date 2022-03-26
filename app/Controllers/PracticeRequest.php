<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use App\Services\ClientAuthenticator;
use App\Services\NpiClient;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use GuzzleHttp\Client as HTTPClient;
use Exception;

class PracticeRequest extends BaseController
{
	use ResponseTrait;

	const COMPACT_TYPE = 2;
	const PER_PAGE = 10;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function show(string $practiceCode)
	{
		try {
			list($practiceRequests) = AuxPaceClient::getPracticeRequestList(1, 0, $practiceCode);
			list(, $ranges) = AuxPaceClient::getPracticeDeployList(self::COMPACT_TYPE);
		} catch (Exception $exception) {
			session()->setFlashdata('error', $exception->getMessage());
			return redirect()->to(route_to('practice_request_index'));
		}

		$servers = array_filter(
			AuxPaceClient::getPracticeServerList(),
			fn ($server) => $server['status'] === "1"
		);

		return view('practice_requests/show', [
			'application' => $practiceRequests[0],
			'servers' => $servers,
			'databaseServerTemplates' => AuxPaceClient::getDatabaseServerTemplateList(),
			'stamps' => $this->getGroupedDeploymentRanges((array) $ranges),
		]);
	}

	public function getGroupedDeploymentRanges(array $ranges): array
	{
		$stamps = [];

		foreach ((array) $ranges as $range) {
			unset($range['PracticeServer_ID']);
			unset($range['binding']);
			unset($range['endpoint_address']);

			if (!isset($stamps[$range['Stamp']])) {
				$stamps[$range['Stamp']] = $range;
			} else {
				$stamps[$range['Stamp']]['Deployments'] += $range['Deployments'];
				$stamps[$range['Stamp']]['name'] .= ", {$range['name']}";
			}
		}

		krsort($stamps);

		return $stamps;
	}

	public function showNpiData(string $npi)
	{
		$data = NpiClient::getNpiData($npi);

		return $this->respond($data);
	}

	public function approve(string $practiceId)
	{
		try {
			$token = ClientAuthenticator::getToken();
			$client = new HTTPClient();
			$apiEndpointsConfig = config('ApiEndpoints');

			$deploymentType = $this->request->getPost('deployment_type');
			$databaseServerTemplates = AuxPaceClient::getDatabaseServerTemplateList();

			$serverId = "0";
			$parentTenantId = "0";
			$databaseServerTemplate = ['server_id' => "0", 'template_id' => "0"];

			if ($deploymentType === "dedicated_server") {
				$databaseServerTemplate = current(array_filter($databaseServerTemplates, function ($dst) {
					return (string) $dst['ID'] === $this->request->getPost('template');
				}));

				if (!$databaseServerTemplate) {
					session()->setFlashdata('error', "Error fetching database server template");
					return redirect()->back();
				}
			}


			if ($deploymentType === "dedicated_server") {
				$serverId = $this->request->getPost('server');
			} elseif ($deploymentType === "co_tenant") {
				$parentTenantId = $this->request->getPost('parent_practice');
			}

var_dump([
	'PracticeId' => $practiceId,
	'ServerId' => $serverId,
	'ParentTenantId' => $parentTenantId,
	'DatabaseServerId' => $databaseServerTemplate['server_id'],
	'DatabaseTemplateId' => $databaseServerTemplate['template_id']
]);

$baseURL2 = 'http://'.$_SERVER['HTTP_HOST'];
echo $baseURL2;
exit;

			$approvedPractice = AuxPaceClient::approvePractice([
				'PracticeId' => $practiceId,
				'ServerId' => $serverId,
				'ParentTenantId' => $parentTenantId,
				'DatabaseServerId' => $databaseServerTemplate['server_id'],
				'DatabaseTemplateId' => $databaseServerTemplate['template_id']
			]);

			//var_dump($approvedPractice);
			//exit;

			
if (isset($approvedPractice['PracticeCode'] ) && $approvedPractice['PracticeCode'] != '' ) {


	$client->request(
		'PUT',
		"{$apiEndpointsConfig->baseUrl}/paceapi/v1/active/practices/{$approvedPractice['PracticeCode']}/deployment-email",
		['headers' => ['Authorization' => "Bearer {$token}"]]
	);

	//Redirect to the succces page here
	//$this->showApprovalSuccessJs($approvedPractice);
	session()->setFlashdata('success', 'Practice deployed successfully');

	return redirect()->route('practice_request_approve_success_show', [
	 	base64_encode(json_encode($approvedPractice))
	 ]);

} else {
	session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			
	//Redirect to the failure page here
}


	
			
		} catch (Exception $exception) {
			 session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			// return redirect()->back();

			echo $exception->getMessage();
		}

		// echo base64_encode(json_encode($approvedPractice));

		//session()->setFlashdata('success', 'Practice deployed successfully');

		//return redirect()->route('practice_request_approve_success_show', [
		// 	base64_encode(json_encode($approvedPractice))
		// ]);
	}

	public function showApprovalSuccessJs($PracticeData)
	{
	//	$application = json_decode(base64_decode($PracticeData), true);

	//	if (!$application) {
	//		throw PageNotFoundException::forPageNotFound();
	//	}

		return view('practice_requests/show_approval_success', [
			'application' => $PracticeData,
		]);
	}


	public function showApprovalSuccess(string $encodedPracticeData)
	{
		$application = json_decode(base64_decode($encodedPracticeData), true);

		if (!$application) {
			throw PageNotFoundException::forPageNotFound();
		}

		return view('practice_requests/show_approval_success', [
			'application' => $application,
		]);
	}
}
