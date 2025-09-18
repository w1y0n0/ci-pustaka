<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
// daftar buku
$routes->get('/buku', 'Buku::index');
// tambah buku
$routes->get('/buku/tambah', 'Buku::tambah');
$routes->get('/buku/form-add', 'Buku::form_add');
// simpan buku
$routes->post('/buku/simpan', 'Buku::simpan');
$routes->post('/buku/create-buku', 'Buku::create_buku');
// hapus buku
$routes->delete('/buku/(:num)', 'Buku::hapus/$1');
// ubah buku
$routes->get('/buku/ubah/(:any)', 'Buku::ubah/$1');
// update buku
$routes->post('/buku/update/(:any)', 'Buku::update/$1');
// detail buku
$routes->get('/buku/(:any)', 'Buku::detail/$1');

