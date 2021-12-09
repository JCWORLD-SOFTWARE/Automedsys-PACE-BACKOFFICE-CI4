<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use CodeIgniter\API\ResponseTrait;

class DatabaseServerTemplate extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function index()
	{
		return view('database_server_templates/index', [
			'databaseServerTemplates' => AuxPaceClient::getDatabaseServerTemplateList()
		]);
	}
}
