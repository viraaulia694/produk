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


// $routes->get('/', 'Home::index');

// $routes->get('/dashboard', 'Home::admin');
// $routes->get('/kasir', 'Home::kasir');

// // pelanggan
// $routes->get('/pelanggan', 'Pelanggan::index');
// $routes->get('/pelanggan/tampil', 'Pelanggan::ambilSemua');
// $routes->post('/pelanggan/simpan', 'Pelanggan::simpan');
// $routes->get('/pelanggan/edit', 'Pelanggan::edit');
// $routes->post('/pelanggan/update', 'Pelanggan::update');
// $routes->post('/pelanggan/delete', 'Pelanggan::delete');

// // penjualan
// $routes->get('/penjualan', 'Penjualan::index');
// $routes->get('/penjualan/tambah', 'Penjualan::index');
// $routes->post('/penjualan/simpan', 'Penjualan::simpan');
// $routes->get('/penjualan/tampil', 'Penjualan::tampil');
// $routes->get('/penjualan/delete/(:num)', 'Penjualan::delete/$1');
// $routes->post('/penjualan/edit', 'Penjualan::edit');
// $routes->get('/penjualan/pusheditpenjualan/(:num)', 'Penjualan::pushedit/$1');

// //produk
// $routes->get('/produk', 'Produk::index');
// $routes->get('/produk/tampil', 'Produk::ambilSemua');
// $routes->post('/produk/simpan', 'Produk::simpan');
// $routes->get('/produk/edit', 'Produk::edit');
// $routes->post('/produk/update', 'Produk::update');
// $routes->post('/produk/delete', 'Produk::delete');

// // detail transaksi
// $routes->get('/detailpenjualan', 'Detailpenjualan::index');

// // register
// $routes->get('/', 'Home::index');
// $routes->get('/daftar', 'Register::index');
// $routes->post('/register/process', 'Register::process');

// // login
// $routes->get('/login', 'Login::index');
// $routes->post('/login/process', 'Login::process');
// $routes->get('/produk', 'Produk::index');