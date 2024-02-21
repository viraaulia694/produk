<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//produk
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/tampil', 'Produk::ambilSemua');
$routes->post('/produk/simpan', 'Produk::simpan');
$routes->get('/produk/edit', 'Produk::edit');
$routes->post('/produk/update', 'Produk::update');
$routes->post('/produk/delete', 'Produk::delete');

