<?php

namespace Config;

$routes = Services::routes();

// Default Routes
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('PublicController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // Aktifkan jika ingin autoload controller/method tanpa manual

// ------------------------------------------------------------
// ✅ AUTH ROUTES
// ------------------------------------------------------------
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');      // tampilkan form login
    $routes->post('attempt_login', 'Auth::attempt_login');     // proses form login
    $routes->get('register', 'Auth::register');
    $routes->post('store', 'Auth::store');
    $routes->get('logout', 'Auth::logout');

});

// ------------------------------------------------------------
// ✅ DOSEN ROUTES (butuh login role 'dosen')
// ------------------------------------------------------------
$routes->group('dosen', ['filter' => 'role:dosen'], function($routes) {
    $routes->get('dashboard', 'Dosen\DashboardController::index');
    $routes->get('profil', 'Dosen\ProfilController::index');
    $routes->post('profil/update', 'Dosen\ProfilController::update');
    $routes->get('profil/edit', 'Dosen\ProfilController::edit');
    $routes->post('profil/update', 'Dosen\ProfilController::update');
    $routes->get('lengkapi-profil', 'Dosen\LengkapiProfilController::form');
    $routes->post('lengkapi-profil/simpan', 'Dosen\LengkapiProfilController::simpan');
// Keahlian
    $routes->post('profil/keahlian/tambah', 'Dosen\ProfilController::tambahKeahlian');
    $routes->get('profil/keahlian/edit/(:num)', 'Dosen\ProfilController::editKeahlian/$1');
    $routes->post('profil/keahlian/update/(:num)', 'Dosen\ProfilController::updateKeahlian/$1');
    $routes->get('profil/keahlian/hapus/(:num)', 'Dosen\ProfilController::hapusKeahlian/$1');
// Jadwal
    $routes->post('profil/jadwal/tambah', 'Dosen\ProfilController::tambahJadwal');
    $routes->get('profil/jadwal/edit/(:num)', 'Dosen\ProfilController::editJadwal/$1');
    $routes->post('profil/jadwal/update/(:num)', 'Dosen\ProfilController::updateJadwal/$1');
    $routes->get('profil/jadwal/hapus/(:num)', 'Dosen\ProfilController::hapusJadwal/$1');
    // Dosen Ubah Password
    $routes->get('ubah-password', 'Dosen\AkunController::formPassword');
    $routes->post('ubah-password', 'Dosen\AkunController::updatePassword');
    // Portofolio
    $routes->get('portofolio', 'Dosen\PortofolioController::index');
    $routes->get('portofolio/create', 'Dosen\PortofolioController::create');
    $routes->post('portofolio/store', 'Dosen\PortofolioController::store');
    $routes->get('portofolio/edit/(:num)', 'Dosen\PortofolioController::edit/$1');
    $routes->post('portofolio/update/(:num)', 'Dosen\PortofolioController::update/$1');
    $routes->get('portofolio/delete/(:num)', 'Dosen\PortofolioController::delete/$1');
});

// ------------------------------------------------------------
// ✅ ADMIN ROUTES (butuh login role 'admin')
// ------------------------------------------------------------
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('dosen', 'Admin\DosenController::index');
    $routes->get('dosen/create', 'Admin\DosenController::create');
    $routes->post('dosen/store', 'Admin\DosenController::store');
    $routes->get('dosen/edit/(:num)', 'Admin\DosenController::edit/$1');
    $routes->post('dosen/update/(:num)', 'Admin\DosenController::update/$1');
    $routes->get('dosen/delete/(:num)', 'Admin\DosenController::delete/$1');
    //Evaluasi
    $routes->get('evaluasi', 'Admin\EvaluasiController::index');
    $routes->get('evaluasi/create', 'Admin\EvaluasiController::create');
    $routes->post('evaluasi/store', 'Admin\EvaluasiController::store');
    $routes->get('evaluasi/edit/(:num)', 'Admin\EvaluasiController::edit/$1');
    $routes->post('evaluasi/update/(:num)', 'Admin\EvaluasiController::update/$1');
    $routes->get('evaluasi/delete/(:num)', 'Admin\EvaluasiController::delete/$1');
    // Keahlian
    $routes->get('keahlian', 'Admin\KeahlianController::index');
    $routes->get('keahlian/create', 'Admin\KeahlianController::create');
    $routes->post('keahlian/store', 'Admin\KeahlianController::store');
    $routes->get('keahlian/edit/(:num)', 'Admin\KeahlianController::edit/$1');
    $routes->post('keahlian/update/(:num)', 'Admin\KeahlianController::update/$1');
    $routes->get('keahlian/delete/(:num)', 'Admin\KeahlianController::delete/$1');
    // Jadwal
    $routes->get('jadwal', 'Admin\JadwalController::index');
    $routes->get('jadwal/create', 'Admin\JadwalController::create');
    $routes->post('jadwal/store', 'Admin\JadwalController::store');
    $routes->get('jadwal/edit/(:num)', 'Admin\JadwalController::edit/$1');
    $routes->post('jadwal/update/(:num)', 'Admin\JadwalController::update/$1');
    $routes->get('jadwal/delete/(:num)', 'Admin\JadwalController::delete/$1');
    // Reset Password Dosen
    $routes->get('dosen/reset-password-form/(:num)', 'Admin\DosenController::resetPasswordForm/$1');
    $routes->post('dosen/reset-password/(:num)', 'Admin\DosenController::resetPassword/$1');
    // Portofolio
    $routes->get('portofolio', 'Admin\PortofolioController::index');

});

// ------------------------------------------------------------
// ✅ PUBLIC ROUTES (tidak perlu login)
// ------------------------------------------------------------
    $routes->get('/', 'PublicController::index');