<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AuxPaceClient;
use CodeIgniter\API\ResponseTrait;
use Exception;

class DeployedPractice extends BaseController
{
	use ResponseTrait;

	const COMPACT_TYPE = 2;

	public function __construct()
	{
		AuxPaceClient::__constructStatic();
	}

	public function indexFiltered(string $stamp)
	{
		try {
			list($practices) = AuxPaceClient::getPracticeDeployList(self::COMPACT_TYPE, $stamp);
		} catch (Exception $exception) {
			return $this->respond($exception->getMessage(), 400);
		}

		return $this->respond($practices);
	}
}
