<?php namespace Config;

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
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->add('register', 'Auth\Register::index');
$routes->match(['post'], 'register', 'Auth\Register::register');

$routes->add('maintenance', 'Maintenance::maintenance');

$routes->add('registration/successful', 'Auth\Regsucc::index');

$routes->add('login', 'Auth\Login::index');
$routes->match(['post'], 'login', 'Auth\Login::login');

$routes->add('ban/ip', 'Auth\Ban::index');

$routes->add('users/dashboard', 'Users\Dashboard::index');

$routes->add('logout', 'Auth\Logout::logout');

$routes->add('verify/id/(:alphanum)/(:num)', 'Auth\Verifyid::index/$1/$2');

$routes->add('forget/password', 'Auth\Forget::index');
$routes->match(['post'], 'forget/password', 'Auth\Forget::forget');

$routes->add('forget/password/(:alphanum)/(:num)', 'Auth\Changepass::password/$1/$2');

$routes->add('activation', 'Auth\Activation::index');
$routes->match(['post'], 'activation', 'Auth\Activation::activation');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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