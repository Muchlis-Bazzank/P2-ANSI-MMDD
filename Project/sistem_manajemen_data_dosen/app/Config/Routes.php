<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dosen', 'Dosen::index');
$routes->get('/dosen/create', 'Dosen::create');
$routes->post('/dosen/store', 'Dosen::store');
$routes->get('/dosen/edit/(:num)', 'Dosen::edit/$1');
$routes->post('/dosen/update/(:num)', 'Dosen::update/$1');
$routes->get('/dosen/delete/(:num)', 'Dosen::delete/$1');
$routes->get('/dosen/(:num)', 'Dosen::show/$1');
$routes->get('/', function () {
    return redirect()->to('/dosen');
});
$routes->get('/dosen/(:any)', 'Dosen::show/$1');
$routes->get('/dosen/edit/(:any)', 'Dosen::edit/$1');
$routes->get('/dosen/delete/(:any)', 'Dosen::delete/$1');
$routes->get('/dosen/create', 'Dosen::create');
$routes->post('/dosen/store', 'Dosen::store');
$routes->post('/dosen/update/(:any)', 'Dosen::update/$1');
