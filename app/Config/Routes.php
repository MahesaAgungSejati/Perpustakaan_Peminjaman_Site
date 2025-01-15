<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BookController::getBooks');

$routes->get('/members', 'MemberController::index'); // Menampilkan daftar anggota
$routes->get('/members/create', 'MemberController::create'); // Menampilkan form tambah anggota
$routes->post('/members/store', 'MemberController::store'); // Menyimpan anggota baru
$routes->get('/members/edit/(:segment)', 'MemberController::edit/$1'); // Form edit anggota
$routes->post('/members/update/(:segment)', 'MemberController::update/$1'); // Proses update anggota
$routes->get('/members/delete/(:segment)', 'MemberController::delete/$1'); // Hapus anggota


$routes->get('/books', 'BookController::getBooks');
$routes->get('/books/create', 'BookController::create');
$routes->post('/books/store', 'BookController::store');
$routes->get('/books/edit/(:segment)', 'BookController::edit/$1');
$routes->post('/books/update/(:segment)', 'BookController::update/$1');
$routes->get('/books/delete/(:segment)', 'BookController::delete/$1');


$routes->get('/loans', 'LoanController::getLoans'); // Menampilkan daftar peminjaman
$routes->get('/loans/create', 'LoanController::create'); // Menampilkan form tambah peminjaman
$routes->post('/loans/store', 'LoanController::store'); // Memproses penyimpanan peminjaman
$routes->get('/loans/edit/(:num)', 'LoanController::edit/$1');
$routes->post('/loans/update/(:num)', 'LoanController::update/$1');
$routes->get('/loans/delete/(:num)', 'LoanController::delete/$1');



