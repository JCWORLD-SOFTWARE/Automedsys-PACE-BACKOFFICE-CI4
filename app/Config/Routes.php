<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth', 'as' => 'home']);

$routes->get('/auth/login', 'Login::showLoginPage', ['as' => 'login']);
$routes->get('/auth/logout', 'Login::logout', ['as' => 'logout']);
$routes->get('/auth/login/google/oauth2', 'Login::initiateGoogleOauth2', ['as' => 'initiate_google_oauth']);
$routes->get('/auth/login/google/oauth2/callback', 'Login::handleGoogleOauth2Callback', ['as' => 'google_oauth_callback']);

$routes->get('/servers', 'Server::index', ['filter' => 'auth', 'as' => 'server_index']);

$routes->get('/practice-requests', 'PracticeRequest::index', ['filter' => 'auth', 'as' => 'practice_request_index']);
$routes->get('/practice-requests/(:alphanum)', 'PracticeRequest::show/$1', ['filter' => 'auth', 'as' => 'practice_request_show']);
$routes->get('/practice-requests/validate-npi/(:alphanum)', 'PracticeRequest::showNpiData/$1', ['filter' => 'auth', 'as' => 'npi_validate']);
$routes->post('/practice-requests/approve/(:alphanum)', 'PracticeRequest::approve/$1', ['filter' => 'auth', 'as' => 'practice_request_approve']);
$routes->get('/practice-requests/approve/(:segment)/success', 'PracticeRequest::showApprovalSuccess/$1', ['filter' => 'auth', 'as' => 'practice_request_approve_success_show']);

$routes->get('/user-registrations', 'UserRegistration::index', ['filter' => 'auth', 'as' => 'user_registration_index']);
$routes->get('/user-registrations/create', 'UserRegistration::create', ['filter' => 'auth', 'as' => 'user_registration_create']);
$routes->post('/user-registrations/create', 'UserRegistration::store', ['filter' => 'auth', 'as' => 'user_registration_store']);
$routes->get('/user-registrations/show/(:segment)', 'UserRegistration::show/$1', ['filter' => 'auth', 'as' => 'user_registration_show']);
$routes->post('/user-registrations/resend-notification/(:segment)', 'UserRegistration::resendNotification/$1', ['filter' => 'auth', 'as' => 'user_registration_notification_resend']);
$routes->get('/user-registrations/delete/(:segment)', 'UserRegistration::delete/$1', ['filter' => 'auth', 'as' => 'user_registration_delete']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
