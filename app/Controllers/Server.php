<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\XmlProcessor;
use CodeIgniter\API\ResponseTrait;
use Exception;
use SoapClient;

class Server extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		try {
			$soapClient = new SoapClient('http://stgmw.automedsys.net/AuxPaceService.asmx?WSDL');

			$serverListResponse =  $soapClient->__soapCall('PracticeServerList', [
				['limit' => '10', 'offset' => '0', 'sessionid' => session('sessionId')]
			]);

			$serverTemplateListResponse =  $soapClient->__soapCall('PracticeDatabaseServerTemplateList', [
				['limit' => '10', 'offset' => '0', 'sessionid' => session('sessionId')]
			]);
		} catch (Exception $exception) {
			die($exception->getMessage());
		}

		$serverListXmlprocessor = new XmlProcessor($serverListResponse->PracticeServerListResult->MiscField1);
		$serverTemplateListXmlprocessor = new XmlProcessor($serverTemplateListResponse->PracticeDatabaseServerTemplateListResult->MiscField1);

		$servers = $serverListXmlprocessor->toArray()->get()['diffgrdiffgram']['mydata']['PACEDataTable'];
		$serverTemplates = $serverTemplateListXmlprocessor->base64Decode()->gzDecode()->jsonToArray()->get();

		// return $this->respond($serverTemplates);

		return view('servers/index', [
			'servers' => $servers,
			'serverTemplates' => $serverTemplates
		]);
	}
}
