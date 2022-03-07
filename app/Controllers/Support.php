<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;

class Support extends BaseController
{
    use ResponseTrait;

	const PER_PAGE = 10;

	public function index()
	{
		$token = ClientAuthenticator::getToken();
		$client = new HTTPClient();
		$apiEndpointsConfig = config('ApiEndpoints');

		$filterRequestMap = [
			'emailAddress' => 'emailAddress',
			'firstName' => 'practice_name',
			'lastName' => 'address_line_1',
			'message' => 'message',
		];

		$filter = new ApiResourceFilter($filterRequestMap);

		$page = $this->request->getVar('page') ?? 1;

		$response = $client->request(
			'GET',
			"{$apiEndpointsConfig->baseUrl}/paceapi/v1/contactus",
			[
				'headers' => ['Authorization' => "Bearer {$token}"],
				'query' => array_merge($filter->getParams(), [
					'PageNumber' => $page,
					'PageSize' => static::PER_PAGE,
					'datefrom' => '2021-01-01'
				])
			]
		);

		$response = json_decode($response->getBody(), true);

		$pager = service('pager');
		$pager->setPath(route_to('contact_us'));
		$pager->makeLinks($page, static::PER_PAGE, $response['ResponseData']['TotalCount']);

		return view('support/index', [
			'prospectivePractices' => $response['ResponseData']['Items'],
			'pager' => $pager,
			'isFiltered' => $filter->isFiltered(),
			'filter' => $filter->getParams()
		]);
	}
}
