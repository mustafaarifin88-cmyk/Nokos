<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    $routes->get('profiltoko', 'Admin\ProfilToko::index');
    $routes->post('profiltoko/update', 'Admin\ProfilToko::update');
    
    $routes->get('produk', 'Admin\Produk::index');
    $routes->post('produk/store', 'Admin\Produk::store');
    $routes->post('produk/update/(:num)', 'Admin\Produk::update/$1');
    $routes->get('produk/delete/(:num)', 'Admin\Produk::delete/$1');
    
    $routes->get('layanan', 'Admin\Layanan::index');
    $routes->post('layanan/store', 'Admin\Layanan::store');
    
    $routes->get('user', 'Admin\User::index');
    $routes->post('user/store', 'Admin\User::store');
    $routes->post('user/update/(:num)', 'Admin\User::update/$1');
    $routes->get('user/delete/(:num)', 'Admin\User::delete/$1');
    
    $routes->get('pesanan', 'Admin\Pesanan::index');
    $routes->post('pesanan/updatestatus/(:num)', 'Admin\Pesanan::updateStatus/$1');
    
    $routes->get('rekening', 'Admin\Rekening::index');
    $routes->post('rekening/store', 'Admin\Rekening::store');
    $routes->post('rekening/update/(:num)', 'Admin\Rekening::update/$1');
    $routes->get('rekening/delete/(:num)', 'Admin\Rekening::delete/$1');
    
    $routes->get('profil', 'Admin\Profil::index');
    $routes->post('profil/update', 'Admin\Profil::update');
    
    $routes->get('laporan', 'Admin\Laporan::index');
    $routes->get('laporan/cetak', 'Admin\Laporan::cetak');
});

$routes->group('penjual', ['filter' => 'role:penjual'], static function ($routes) {
    $routes->get('dashboard', 'Penjual\Dashboard::index');
    
    $routes->get('produk', 'Penjual\Produk::index');
    $routes->post('produk/store', 'Penjual\Produk::store');
    $routes->post('produk/update/(:num)', 'Penjual\Produk::update/$1');
    $routes->get('produk/delete/(:num)', 'Penjual\Produk::delete/$1');
    
    $routes->get('layanan', 'Penjual\Layanan::index');
    $routes->post('layanan/store', 'Penjual\Layanan::store');
    
    $routes->get('pesanan', 'Penjual\Pesanan::index');
    $routes->post('pesanan/updatestatus/(:num)', 'Penjual\Pesanan::updateStatus/$1');
    
    $routes->get('profil', 'Penjual\Profil::index');
    $routes->post('profil/update', 'Penjual\Profil::update');
    
    $routes->get('laporan', 'Penjual\Laporan::index');
    $routes->get('laporan/cetak', 'Penjual\Laporan::cetak');
});

$routes->group('pembeli', ['filter' => 'role:pembeli'], static function ($routes) {
    $routes->get('dashboard', 'Pembeli\Dashboard::index');
    
    $routes->get('profil', 'Pembeli\Profil::index');
    $routes->post('profil/update', 'Pembeli\Profil::update');
    
    $routes->get('pembelian', 'Pembeli\Pembelian::index');
    $routes->post('pembelian/store', 'Pembeli\Pembelian::store');
    
    $routes->get('pesanan', 'Pembeli\Pesanan::index');
    $routes->get('pesanan/terima/(:num)', 'Pembeli\Pesanan::terima/$1');
    
    $routes->get('histori', 'Pembeli\Histori::index');
});