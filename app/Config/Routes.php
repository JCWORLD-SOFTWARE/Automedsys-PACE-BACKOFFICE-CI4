<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->setAutoRoute(true);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
