<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth routes
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

// Group untuk admin (akses admin saja)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('suratmasuk', 'Admin\SuratMasuk::index');
    $routes->get('suratmasuk/tambah', 'Admin\SuratMasuk::tambah');
    $routes->post('suratmasuk/store', 'Admin\SuratMasuk::store');
    $routes->get('suratmasuk/edit/(:num)', 'Admin\SuratMasuk::edit/$1'); // Tambahkan ini
    $routes->put('suratmasuk/update/(:num)', 'Admin\SuratMasuk::update/$1'); // Tambahkan ini (menggunakan PUT)
    $routes->get('suratmasuk/delete/(:num)', 'Admin\SuratMasuk::delete/$1');
    // Arsip Routes
    $routes->group('arsip', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Admin\ArsipController::index');
        $routes->get('tambah', 'Admin\ArsipController::create');
        $routes->post('store', 'Admin\ArsipController::store');
        $routes->get('edit/(:num)', 'Admin\ArsipController::edit/$1');
        $routes->post('update/(:num)', 'Admin\ArsipController::update/$1');
        $routes->get('delete/(:num)', 'Admin\ArsipController::delete/$1');
    });

    // Lokasi Routes
    $routes->group('lokasi', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Admin\LokasiController::index');
        $routes->get('tambah', 'Admin\LokasiController::create');
        $routes->post('store', 'Admin\LokasiController::store');
        $routes->get('edit/(:num)', 'Admin\LokasiController::edit/$1');
        $routes->put('update/(:num)', 'Admin\LokasiController::update/$1');
        $routes->get('delete/(:num)', 'Admin\LokasiController::delete/$1');
    });

    // Surat Keluar
    $routes->get('suratkeluar', 'Admin\SuratKeluar::index');
    $routes->get('suratkeluar/tambah', 'Admin\SuratKeluar::tambah');
    $routes->post('suratkeluar/store', 'Admin\SuratKeluar::store');
    $routes->get('suratkeluar/edit/(:num)', 'Admin\SuratKeluar::edit/$1'); // Tambahkan ini
    $routes->put('suratkeluar/update/(:num)', 'Admin\SuratKeluar::update/$1'); // Tambahkan ini (menggunakan PUT)
    $routes->get('suratkeluar/delete/(:num)', 'Admin\SuratKeluar::delete/$1');
});

// Group untuk pegawai (akses terbatas)
$routes->group('pegawai', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Pegawai\Dashboard::index');
    $routes->group('lokasi', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'Admin\LokasiController::index');
    });
});
