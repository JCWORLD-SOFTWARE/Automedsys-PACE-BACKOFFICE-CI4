<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use App\Services\NpiClient;
use CodeIgniter\API\ResponseTrait;

class PracticeRequest extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

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
		
		return view('practice_requests/show', [
			'application' => $practiceRequests[0]
		]);
	}

	public function showNpiData(string $npi)
	{
		$data = NpiClient::getNpiData($npi);

		return $this->respond($data);
	}
}
