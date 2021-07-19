<?php

namespace App\Services;

use App\Libraries\XmlProcessor;
use Exception;
use SoapClient;

class AuxPaceClient
{
	private static SoapClient $soapClient;

	public static function __constructStatic()
	{
		self::$soapClient =  new SoapClient('http://stgmw.automedsys.net/AuxPaceService.asmx?WSDL');
	}

	public static function getPracticeRequestList(int $perPage = 10, int $offset = 0, string $practiceCode = '')
	{
		$practiceRequestListResponse =  self::$soapClient->__soapCall('PracticeRequestList', [
			[
				'limit' => $perPage,
				'offset' => $offset,
				'sessionid' => session('sessionId'),
				'PracticeCode' => $practiceCode
			]
		]);

		if (property_exists($practiceRequestListResponse->PracticeRequestListResult, 'ErrorMessage')) {
			throw new Exception($practiceRequestListResponse->PracticeRequestListResult->ErrorMessage);
		}

		$practiceRequestListXmlprocessor = new XmlProcessor($practiceRequestListResponse->PracticeRequestListResult->MiscField1);
		$practiceRequests = $practiceRequestListXmlprocessor->base64Decode()->gzDecode()->jsonToArray()->get();
		$practiceRequestCount = $practiceRequestListResponse->PracticeRequestListResult->MiscField2;

        return [$practiceRequests, $practiceRequestCount];
	}

	public static function getPracticeServerList(int $perPage = 10, int $offset = 0)
	{
		$practiceServerListResponse = self::$soapClient->__soapCall('PracticeServerList', [
			[
				'limit' => $perPage,
				'offset' => $offset,
				'sessionid' => session('sessionId')
			]
		]);

		if (property_exists($practiceServerListResponse->PracticeServerListResult, 'ErrorMessage')) {
			throw new Exception(
				$practiceServerListResponse->PracticeServerListResult->ErrorMessage
			);
		}

		$practiceServerListXmlprocessor = new XmlProcessor(
			$practiceServerListResponse->PracticeServerListResult->MiscField1
		);

		$servers = $practiceServerListXmlprocessor
			->toArray()
			->get()['diffgrdiffgram']['mydata']['PACEDataTable'];

        return (array) $servers;
	}

	public static function getDatabaseServerTemplateList(int $perPage = 10, int $offset = 0)
	{
		$databaseServerTemplateListResponse =  self::$soapClient
			->__soapCall('PracticeDatabaseServerTemplateList', [
			[
				'limit' => $perPage,
				'offset' => $offset,
				'sessionid' => session('sessionId')
			]
		]);

		if (property_exists($databaseServerTemplateListResponse
			->PracticeDatabaseServerTemplateListResult, 'ErrorMessage')) {
			throw new Exception($databaseServerTemplateListResponse
				->PracticeDatabaseServerTemplateListResult
				->ErrorMessage);
		}

		$databaseServerTemplateListXmlprocessor = new XmlProcessor(
			$databaseServerTemplateListResponse
				->PracticeDatabaseServerTemplateListResult
				->MiscField1
		);

		$databaseServerTemplates = $databaseServerTemplateListXmlprocessor
			->base64Decode()
			->gzDecode()
			->jsonToArray()
			->get();

        return (array) $databaseServerTemplates;
	}

	public static function approvePractice(array $options = [])
	{
		$approvePracticeResponse =  self::$soapClient->__soapCall('ApprovePractice', [
			[
				'PracticeId' => $options['PracticeId'],
				'ServerId' => $options['ServerId'],
				'ParentTenantId' => $options['ParentTenantId'],
				'DatabaseServerId' => $options['DatabaseServerId'],
				'DatabaseTemplateId' => $options['DatabaseTemplateId'],
				'AccessControl' => [
					'ChannelID' => '0',
					'SessionId' => session('sessionId'),
					'Action' => '0',
				]
			]
		]);

		if (property_exists($approvePracticeResponse->ApprovePracticeResult, 'ErrorMessage')) {
			throw new Exception($approvePracticeResponse->ApprovePracticeResult->ErrorMessage);
		}

		$approvePracticeXmlprocessor = new XmlProcessor(
			$approvePracticeResponse->ApprovePracticeResult->MiscField1
		);

		$approvePracticeData = $approvePracticeXmlprocessor
			->toArray()
			->get()['diffgrdiffgram']['mydata']['PACEDataTable'];

		return $approvePracticeData;
	}
}
