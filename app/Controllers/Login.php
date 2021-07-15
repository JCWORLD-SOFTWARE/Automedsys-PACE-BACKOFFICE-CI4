<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use GuzzleHttp\Client as HTTPClient;
use Config\Services;
use Exception;

class Login extends BaseController
{
    use ResponseTrait;

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
        $client = new HTTPClient();
        $response = $client->request('GET', 'https://dev-api.automedsys.net/emrapi/v1/identity/providers');
        $responseData = json_decode($response->getBody());

        $provider = $responseData->ResponseData[0]->ClientGrantUrls[0];
        // $authenticationUri = str_replace('{redirect_uri}', base_url(route_to('google_oauth_callback')), $provider->Url);
        $authenticationUri = str_replace('{redirect_uri}', 'http://localhost:8888/automedsys-pace-admin/oauth', $provider->Url);
        
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

        $client = new HTTPClient();
        $response = $client->request(
            'POST',
            'https://dev-api.automedsys.net/emrapi/v1/identity/oauthx/token',
            ['json' => $data]
        );

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
