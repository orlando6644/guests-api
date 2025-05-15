<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('guests', 'GuestController::index');
    $routes->get('guests/(:num)', 'GuestController::show/$1');
    $routes->post('guests', 'GuestController::store');
    $routes->put('guests/(:num)', 'GuestController::update/$1');
});