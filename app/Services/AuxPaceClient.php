<?php

namespace App\Services;

use App\Libraries\XmlProcessor;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;
use SoapClient;

class AuxPaceClient
{
	public static function getPracticeRequestList(int $perPage = 10, int $offset = 0, string $practiceCode = '')
	{
		try {
			$soapClient = new SoapClient('http://stgmw.automedsys.net/AuxPaceService.asmx?WSDL');

			$practiceRequestListResponse =  $soapClient->__soapCall('PracticeRequestList', [
				[
					'limit' => $perPage,
					'offset' => $offset,
					'sessionid' => session('sessionId'),
					'PracticeCode' => $practiceCode
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

        return [$practiceRequests, $practiceRequestCount];
	}
}
