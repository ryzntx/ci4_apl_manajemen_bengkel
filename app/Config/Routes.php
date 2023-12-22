<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

// $routes->get('/beranda', 'BerandaController::index');

// $routes->get('/manajemen/barang', 'ManajemenBarangController::index');
