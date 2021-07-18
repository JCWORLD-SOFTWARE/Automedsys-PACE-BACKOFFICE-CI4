<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use CodeIgniter\API\ResponseTrait;

class Server extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function index()
	{
		return view('servers/index', [
			'servers' => AuxPaceClient::getPracticeServerList(),
			'databaseServerTemplates' => AuxPaceClient::getDatabaseServerTemplateList()
		]);
	}
}
