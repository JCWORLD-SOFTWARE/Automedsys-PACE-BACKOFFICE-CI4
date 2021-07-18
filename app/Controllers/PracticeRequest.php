<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\XmlProcessor;
use App\Services\AuxPaceClient;
use App\Services\NpiClient;
use CodeIgniter\API\ResponseTrait;
use Exception;
use SoapClient;

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
		list($practiceRequests) = AuxPaceClient::getPracticeRequestList(1, 0, $practiceCode);

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

	public function approve(string $practiceId)
	{
		try {
			AuxPaceClient::approvePractice([
				'PracticeId' => $practiceId,
				'ServerId' => '1',
				'ParentTenantId' => '0',
				'DatabaseServerId' => '1',
				'DatabaseTemplateId' => '1'
			]);
		} catch(Exception $exception) {
			die($exception->getMessage());
		}

		// echo json_encode($approvePracticeResponse);

		// $serverListXmlProcessor = new XmlProcessor($approvePracticeResponse->ApprovePracticeResult->MiscField1);
		// $approvePractice = $serverListXmlProcessor->toArray()->get()['diffgrdiffgram']['mydata']['PACEDataTable'];

		// return $this->respond($approvePractice);
	}
}
