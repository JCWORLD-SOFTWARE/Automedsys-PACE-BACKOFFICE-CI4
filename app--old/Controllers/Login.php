<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use GuzzleHttp\Client as HTTPClient;
use Config\Services;
use GuzzleHttp\Exception\BadResponseException;

class Login extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();
    }

    public function showLoginPage()
    {
        return view('auth/signin');
    }

    public function initiateGoogleOauth2()
    {
        $apiEndpoints = config('ApiEndpoints');
        $providerEndpoint = $apiEndpoints->baseUrl . '/emrapi/v1/identity/providers';

        try {
            $response = $this->client->request('GET', $providerEndpoint);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        $clientGrantUrl = $responseData->ResponseData[0]->ClientGrantUrls[0]->Url;
        $redirectUrl =  base_url(route_to('google_oauth_callback'));
        $authenticationUri = str_replace('{redirect_uri}', $redirectUrl, $clientGrantUrl);

        return redirect()->to($authenticationUri);
    }

    public function handleGoogleOauth2Callback()
    {
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . '/emrapi/v1/identity/oauthx/token';

        $state = explode('|', urldecode($this->request->getVar('state')));
        $identityProvider = $state[0];
        $clientId = $state[1];

        $data = [
            'AuthorizationCode' => $this->request->getVar('code'),
            'IdentityProvider' =>  $identityProvider,
            'ClientId' =>  $clientId,
            'TokenRequestType' => '0',
            'RedirectUrl' => base_url(route_to('google_oauth_callback')),
        ];

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
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
            'profilePicture' => $userInformation->Picture,
            'role' => $userInformation->Role,
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        Services::session()->remove([
            'firstName',
            'lastName',
            'sessionId',
            'email',
            'profilePicture',
            'role'
        ]);

        return redirect()->route('home');
    }
}
