<?php

namespace App\Services;

use App\Libraries\XmlProcessor;
use Exception;
use SoapClient;

class AuxPaceClient
{
	private static SoapClient $soapClient;

	public static function __constructStatic() {

		$apiEndpointsConfig = config('ApiEndpoints');

        $soapBaseUrl = $apiEndpointsConfig->soapBaseUrl;
		
		self::$soapClient =  new SoapClient("{$soapBaseUrl}");
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

		/*
			/paceapi/v1/databasetemplates  
		*/
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

		/*
		/paceapi/v1/paceaccount/practices/approve
			{
			"PracticeId": 0,
			"ServerId": 0,
			"DatabaseServerId": 0,
			"DatabaseTemplateId": 0
			}
		*/
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

		//	var_dump($approvePracticeResponse);
		//	exit;


		if (property_exists($approvePracticeResponse->ApprovePracticeResult, 'ErrorMessage')) {
			throw new Exception($approvePracticeResponse->ApprovePracticeResult->ErrorMessage);
		}

		//var_dump(json_decode($approvePracticeResponse->ApprovePracticeResult->MiscField1, true)[0]);
		//exit;
 		//echo "This is the Service Dump end";

 
		return json_decode($approvePracticeResponse->ApprovePracticeResult->MiscField1, true)[0];
	}

	public static function getPracticeDeployList(
		int $compact = 0,
		string $param = '',
		int $limit = 0,
		int $offset = 0
	) {
		$practiceDeployListResponse =  self::$soapClient->__soapCall('PracticeDeployList', [
			[
				'compact' => $compact,
				'param' => $param,
				'limit' => $limit,
				'offset' => $offset,
				'sessionid' => session('sessionId'),
			]
		]);

		if (property_exists($practiceDeployListResponse->PracticeDeployListResult, 'ErrorMessage')) {
			throw new Exception($practiceDeployListResponse->PracticeDeployListResult->ErrorMessage);
		}

		$practiceListXmlprocessor = new XmlProcessor($practiceDeployListResponse->PracticeDeployListResult->MiscField1);
		$rangeListXmlprocessor = new XmlProcessor($practiceDeployListResponse->PracticeDeployListResult->MiscField2);

		$practices = $practiceListXmlprocessor->jsonToArray()->get();
		$ranges = $rangeListXmlprocessor->jsonToArray()->get();

		return [$practices, $ranges];
	}
}
