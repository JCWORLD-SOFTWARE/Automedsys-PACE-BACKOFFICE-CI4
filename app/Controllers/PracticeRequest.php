<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use App\Services\EmailNotifier;
use App\Services\NpiClient;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class PracticeRequest extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function index()
	{
		$page = $this->request->getVar('page') ?? 1;
		$offset = (($page * static::PER_PAGE) - static::PER_PAGE) ?? 0;

		list($practiceRequests, $practiceRequestCount) = AuxPaceClient::getPracticeRequestList(static::PER_PAGE, $offset);

		$pager = service('pager');
		$pager->setPath(route_to('practice_request_index'));

		return view('practice_requests/index', [
			'practiceRequests' => $practiceRequests,
			'pager' => $pager,
			'pagination' => [
				'page' => $page,
				'perPage' => static::PER_PAGE,
				'total' => $practiceRequestCount
			]
		]);
	}

	public function show(string $practiceCode)
	{
		try {
			list($practiceRequests) = AuxPaceClient::getPracticeRequestList(1, 0, $practiceCode);
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
			'databaseServerTemplates' => AuxPaceClient::getDatabaseServerTemplateList()
		]);
	}

	public function showNpiData(string $npi)
	{
		$data = NpiClient::getNpiData($npi);

		return $this->respond($data);
	}

	public function approve(string $practiceId, string $practiceCode)
	{
		try {
			list($practiceRequests) = AuxPaceClient::getPracticeRequestList(1, 0, $practiceCode);
			$databaseServerTemplates = AuxPaceClient::getDatabaseServerTemplateList();

			$databaseServerTemplate = current(array_filter($databaseServerTemplates, function($dst) {
				return (string) $dst['ID'] === $this->request->getPost('template');
			}));

			if (!$databaseServerTemplate) {
				session()->setFlashdata('error', "Error fetching database server template");
				return redirect()->back();
			}

			AuxPaceClient::approvePractice([
				'PracticeId' => $practiceId,
				'ServerId' => $this->request->getPost('server'),
				'ParentTenantId' => '0',
				'DatabaseServerId' => $databaseServerTemplate['server_id'],
				'DatabaseTemplateId' => $databaseServerTemplate['template_id']
			]);
		} catch (Exception $exception) {
			session()->setFlashdata('error', "<pre>{$exception->getMessage()}</pre>");
			return redirect()->back();
		}

		EmailNotifier::providerDeploymentSuccess($practiceRequests[0]);

		session()->setFlashdata('success', 'Practice deployed successfully');

		return redirect()->route('practice_request_approve_success_show', [
			base64_encode(json_encode($practiceRequests[0]))
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
