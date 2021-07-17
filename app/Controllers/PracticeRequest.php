<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\XmlProcessor;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;
use SoapClient;

class PracticeRequest extends BaseController
{
	use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$page = $this->request->getVar('page') ?? 1;
		$offset = (($page * static::PER_PAGE) - static::PER_PAGE) ?? 0;

		try {
			$soapClient = new SoapClient('http://stgmw.automedsys.net/AuxPaceService.asmx?WSDL');

			$practiceRequestListResponse =  $soapClient->__soapCall('PracticeRequestList', [
				[
					'limit' => static::PER_PAGE,
					'offset' => $offset,
					'sessionid' => session('sessionId'),
					'PracticeCode' => ''
				]
			]);
		} catch (Exception $exception) {
			die($exception->getMessage());
		}

		if (property_exists($practiceRequestListResponse->PracticeRequestListResult, 'ErrorMessage')) {
			throw PageNotFoundException::forPageNotFound(
				$practiceRequestListResponse->PracticeRequestListResult->ErrorMessage
			);
		}

		$practiceRequestListXmlprocessor = new XmlProcessor($practiceRequestListResponse->PracticeRequestListResult->MiscField1);
		$practiceRequests = $practiceRequestListXmlprocessor->base64Decode()->gzDecode()->jsonToArray()->get();
		$practiceRequestCount = $practiceRequestListResponse->PracticeRequestListResult->MiscField2;

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
}
