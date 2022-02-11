<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class ApiEndpoints extends BaseConfig
{
	/**
	 * --------------------------------------------------------------------------
	 * Base Url
	 * --------------------------------------------------------------------------
	 *
	 * autoMedSys endpoint base url
	 *
	 * @var string
	 */
	public $baseUrl = '';

	public $soapBaseUrl;

	//public $soapBaseUrl;

	public $loginUrl;

	public $fromUrl;


	/**
	 * --------------------------------------------------------------------------
	 * Client Credentials
	 * --------------------------------------------------------------------------
	 *
	 * Client credentials
	 *
	 * @var string
	 */
	public $clientCredentials = [
		'username' => '',
		'password' => ''
	];
}
