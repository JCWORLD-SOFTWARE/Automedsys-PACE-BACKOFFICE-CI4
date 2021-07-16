<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Config\ApiEndpoints;
use GuzzleHttp\Client as HTTPClient;
use Config\Services;
use GuzzleHttp\Exception\BadResponseException;

class Login extends BaseController
{
    use ResponseTrait;

    public ApiEndpoints $apiEndpoints;
    public HTTPClient $client;

    public function __construct()
    {
        $this->apiEndpoints = new ApiEndpoints();
        $this->client = new HTTPClient();
    }

    public function showLoginPage()
    {
        return "Login Page";
    }

    public function showLoginSuccessPage()
    {
        return "Login Success Page";
    }

	public function initiateGoogleOauth2()
    {
        try {
            $response = $this->client->request(
                'GET',
                "{$this->apiEndpoints->baseUrl}/emrapi/v1/identity/providers"
            );
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        $provider = $responseData->ResponseData[0]->ClientGrantUrls[0];
        
        $authenticationUri = str_replace(
            '{redirect_uri}',
            'http://localhost:8888/automedsys-pace-admin/oauth',
            // base_url(route_to('google_oauth_callback')),
            $provider->Url
        );
        
        return redirect()->to($authenticationUri);
    }

	public function handleGoogleOauth2Callback()
    {
        $state = explode('|', urldecode($this->request->getVar('state')));
        $identityProvider = $state[0];
        $clientId = $state[1];

        $data = [
            'AuthorizationCode' => $this->request->getVar('code'),
            'IdentityProvider' =>  $identityProvider,
            'ClientId' =>  $clientId,
            'TokenRequestType' => '0',
            // 'RedirectUrl' => base_url(route_to('google_oauth_callback')),
            'RedirectUrl' => 'http://localhost:8888/automedsys-pace-admin/oauth',
        ];

        try {
            $response = $this->client->request(
                'POST',
                "{$this->apiEndpoints->baseUrl}/emrapi/v1/identity/oauthx/token",
                ['json' => $data]
            );
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        $userInformation = $responseData->ResponseData->UserInformation;

        Services::session()->set([
            'firstName' => $userInformation->FirstName,
            'lastName' => $userInformation->LastName,
            'sessionId' => $userInformation->MiscField1,
            'email' => $userInformation->Email,
            'picture' => $userInformation->Picture,
            'role' => $userInformation->Role,
        ]);

        return redirect()->route('login_success');
    }

    public function logout()
    {
        Services::session()->remove([
            'firstName',
            'lastName',
            'sessionId',
            'email',
            'picture',
            'role'
        ]);

        return redirect()->route('login_success');
    }
}
