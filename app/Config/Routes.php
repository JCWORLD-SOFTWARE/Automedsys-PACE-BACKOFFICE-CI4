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

//$routes->get('/auth/login/google/oauth2', 'Login::initiateGoogleOauth2', ['as' => 'initiate_google_oauth']);

//$routes->get('/auth/login/google/oauth2/callback', 'Login::handleGoogleOauth2Callback', ['as' => 'google_oauth_callback']);



$routes->get('/auth/login/google/oauth2/callback', 'Login::handleGoogleOauth2Callback', ['as' => 'google_oauth_callback2']);
$routes->get('/oauth', 'Login::handleGoogleOauth2Callback', ['as' => 'google_oauth_callback']);


$routes->get('/servers', 'Server::index', ['filter' => 'auth', 'as' => 'server_index']);
$routes->get('/database-server-templates', 'DatabaseServerTemplate::index', ['filter' => 'auth', 'as' => 'database_server_template_index']);

$routes->get('/practice-requests/(:alphanum)', 'PracticeRequest::show/$1', ['filter' => 'auth', 'as' => 'practice_request_show']);
$routes->get('/practice-requests/validate-npi/(:alphanum)', 'PracticeRequest::showNpiData/$1', ['filter' => 'auth', 'as' => 'npi_validate']);
$routes->post('/practice-requests/approve/(:alphanum)', 'PracticeRequest::approve/$1', ['filter' => 'auth', 'as' => 'practice_request_approve']);
$routes->get('/practice-requests/approve/(:segment)/success', 'PracticeRequest::showApprovalSuccess/$1', ['filter' => 'auth', 'as' => 'practice_request_approve_success_show']);

$routes->get('/user-registrations', 'UserRegistration::index', ['filter' => 'auth', 'as' => 'user_registration_index']);
$routes->get('/user-registrations/filter', 'UserRegistration::indexfiltered', ['filter' => 'auth', 'as' => 'user_registration_index_filtered']);
$routes->get('/user-registrations/create', 'UserRegistration::create', ['filter' => 'auth', 'as' => 'user_registration_create']);
$routes->post('/user-registrations/create', 'UserRegistration::store', ['filter' => 'auth', 'as' => 'user_registration_store']);
$routes->get('/user-registrations/show/(:segment)', 'UserRegistration::show/$1', ['filter' => 'auth', 'as' => 'user_registration_show']);
$routes->get('/user-registrations/edit/(:segment)', 'UserRegistration::edit/$1', ['filter' => 'auth', 'as' => 'user_registration_edit']);
$routes->post('/user-registrations/edit/(:segment)', 'UserRegistration::update/$1', ['filter' => 'auth', 'as' => 'user_registration_update']);
$routes->post('/user-registrations/resend-notification/(:segment)', 'UserRegistration::resendNotification/$1', ['filter' => 'auth', 'as' => 'user_registration_notification_resend']);
$routes->get('/user-registrations/delete/(:segment)', 'UserRegistration::delete/$1', ['filter' => 'auth', 'as' => 'user_registration_delete']);
$routes->post('/user-registrations/verify-npi/(:segment) ', 'UserRegistration::verifyNPI/$1', ['filter' => 'auth', 'as' => 'user_registration_verify_npi']);
$routes->get('/practice-requests/validate-npi/(:segment)', 'UserRegistration::verifyNPI/$1', ['filter' => 'auth', 'as' => 'user_registration_verify_npi']);

$routes->get('/deployed-practices/filter/(:segment)', 'DeployedPractice::indexFiltered/$1', ['filter' => 'auth', 'as' => 'deployed_practice_index_filtered']);
$routes->get('/active-practices/active', 'DeployedPractice::indexActive', ['filter' => 'auth', 'as' => 'active_practice_index_active']);
$routes->get('/active-practices/suspended', 'DeployedPractice::indexSuspended', ['filter' => 'auth', 'as' => 'active_practice_index_suspended']);
$routes->get('/active-practices/show/(:segment)', 'DeployedPractice::show/$1', ['filter' => 'auth', 'as' => 'active_practice_show']);
$routes->get('/active-practices/edit/(:segment)', 'DeployedPractice::edit/$1', ['filter' => 'auth', 'as' => 'active_practice_edit']);
$routes->post('/active-practices/edit/(:segment)', 'DeployedPractice::update/$1', ['filter' => 'auth', 'as' => 'active_practice_update']);
$routes->get('/active-practices/suspend/(:segment)', 'DeployedPractice::suspend/$1', ['filter' => 'auth', 'as' => 'active_practice_suspend']);
$routes->get('/active-practices/reactivate/(:segment)', 'DeployedPractice::reactivate/$1', ['filter' => 'auth', 'as' => 'active_practice_reactivate']);
$routes->post('/active-practices/resend-notification/(:segment)', 'DeployedPractice::resendNotification/$1', ['filter' => 'auth', 'as' => 'active_practice_notification_resend']);

$routes->get('/prospective-practices', 'ProspectivePractice::index', ['filter' => 'auth', 'as' => 'prospective_practice_index']);
$routes->get('/prospective-practices/show/(:segment)', 'ProspectivePractice::show/$1', ['filter' => 'auth', 'as' => 'prospective_practice_show']);
$routes->get('/prospective-practices/edit/(:segment)', 'ProspectivePractice::edit/$1', ['filter' => 'auth', 'as' => 'prospective_practice_edit']);
$routes->post('/prospective-practices/edit/(:segment)', 'ProspectivePractice::update/$1', ['filter' => 'auth', 'as' => 'prospective_practice_update']);
$routes->get('/prospective-practices/delete/(:segment)', 'ProspectivePractice::delete/$1', ['filter' => 'auth', 'as' => 'prospective_practice_delete']);

$routes->get('/organizations', 'Organization::index', ['filter' => 'auth', 'as' => 'organization_index']);
$routes->get('/organizations/create', 'Organization::create', ['filter' => 'auth', 'as' => 'organization_create']);
$routes->post('/organizations/create', 'Organization::store', ['filter' => 'auth', 'as' => 'organization_store']);
$routes->get('/organizations/show/(:segment)', 'Organization::show/$1', ['filter' => 'auth', 'as' => 'organization_show']);
$routes->get('/organizations/edit/(:segment)', 'Organization::edit/$1', ['filter' => 'auth', 'as' => 'organization_edit']);
$routes->post('/organizations/edit/(:segment)', 'Organization::update/$1', ['filter' => 'auth', 'as' => 'organization_update']);
$routes->get('/organizations/delete/(:segment)', 'Organization::delete/$1', ['filter' => 'auth', 'as' => 'organization_delete']);
$routes->post('/organizations/resend/(:segment)/notification', 'Organization::resendNotification/$1', ['filter' => 'auth', 'as' => 'organization_notification_resend']);

$routes->get('/organizations/(:segment)/applications', 'Application::index/$1', ['filter' => 'auth', 'as' => 'application_index']);
$routes->get('/organizations/(:segment)/applications/create', 'Application::create/$1', ['filter' => 'auth', 'as' => 'application_create']);
$routes->post('/organizations/(:segment)/applications/create', 'Application::store/$1', ['filter' => 'auth', 'as' => 'application_store']);
$routes->get('/organizations/(:segment)/applications/show/(:segment)', 'Application::show/$1/$2', ['filter' => 'auth', 'as' => 'application_show']);
$routes->get('/organizations/(:segment)/applications/edit/(:segment)', 'Application::edit/$1/$2', ['filter' => 'auth', 'as' => 'application_edit']);
$routes->post('/organizations/(:segment)/applications/edit/(:segment)', 'Application::update/$1/$2', ['filter' => 'auth', 'as' => 'application_update']);
$routes->get('/organizations/(:segment)/applications/delete/(:segment)', 'Application::delete/$1/$2', ['filter' => 'auth', 'as' => 'application_delete']);

$routes->post('/organizations/(:segment)/applications/(:segment)/scopes/create', 'ScopeAssignment::store/$1/$2', ['filter' => 'auth', 'as' => 'scope_assignment_store']);
$routes->get('/organizations/(:segment)/applications/(:segment)/scopes/(:segment)/delete', 'ScopeAssignment::delete/$1/$2/$3', ['filter' => 'auth', 'as' => 'scope_assignment_delete']);

$routes->get('/scopes', 'Scope::index', ['filter' => 'auth', 'as' => 'scope_index']);
$routes->get('/scopes/create', 'Scope::create', ['filter' => 'auth', 'as' => 'scope_create']);
$routes->post('/scopes/create', 'Scope::store', ['filter' => 'auth', 'as' => 'scope_store']);
$routes->get('/scopes/show/(:segment)', 'Scope::show/$1', ['filter' => 'auth', 'as' => 'scope_show']);
$routes->get('/scopes/edit/(:segment)', 'Scope::edit/$1', ['filter' => 'auth', 'as' => 'scope_edit']);
$routes->post('/scopes/update/(:segment)', 'Scope::update/$1', ['filter' => 'auth', 'as' => 'scope_update']);
$routes->get('/scopes/delete/(:segment)', 'Scope::delete/$1', ['filter' => 'auth', 'as' => 'scope_delete']);

$routes->get('/contact_us', 'Support::index', ['filter' => 'auth', 'as' => 'contact_us']);
$routes->post('/contact_us', 'Support::index', ['filter' => 'auth', 'as' => 'contact_us']);

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
