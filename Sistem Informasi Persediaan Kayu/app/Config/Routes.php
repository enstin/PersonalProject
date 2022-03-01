<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->post('/berat/ubah/(:segment)', 'conmaster::ubahberat/$1');
$routes->get('/login', 'conlogin::view');
$routes->post('/ceklogin', 'conlogin::ceklogin');
$routes->get('/logout', 'conlogin::logout');
$routes->get('/dashboard', 'conlogin::dashboard');

//DATA KAYU
$routes->get('/kayu', 'conmaster::viewkayu');
$routes->post('/kayu/simpan', 'conmaster::inputkayu');
$routes->post('/kayu/ubah/(:segment)', 'conmaster::ubahkayu/$1');
$routes->get('/kayu/hapus/(:segment)', 'conmaster::hapuskayu/$1');
//DATA PRODUK
$routes->get('/produk', 'conmaster::viewproduk');
$routes->post('/produk/simpan', 'conmaster::inputproduk');
$routes->post('/produk/ubah/(:segment)', 'conmaster::ubahproduk/$1');
$routes->get('/produk/hapus/(:segment)', 'conmaster::hapusproduk/$1');
//DATA USER
$routes->get('/user', 'conmaster::viewuser');
$routes->post('/user/simpan', 'conmaster::inputuser');
$routes->post('/user/ubah/(:segment)', 'conmaster::ubahuser/$1');
$routes->get('/user/hapus/(:segment)', 'conmaster::hapususer/$1');
//KAYU masuk
$routes->get('/kayumasuk', 'conkayumasuk::view');
$routes->get('/draftkayumasuk', 'conkayumasuk::viewdraft');
$routes->post('/draftkayumasuk/tambahitem', 'conkayumasuk::tambahitem');
$routes->post('/draftkayumasuk/ubah/(:segment)', 'conkayumasuk::edit/$1');
$routes->get('/draftkayumasuk/hapus/(:segment)', 'conkayumasuk::hapus/$1');
$routes->get('/draftkayumasuk/simpan', 'conkayumasuk::simpandraft');
//KAYU keluar
$routes->get('/kayukeluar', 'conkayukeluar::view');
$routes->get('/draftkayukeluar', 'conkayukeluar::viewdraft');
$routes->post('/draftkayukeluar/tambahitem', 'conkayukeluar::tambahitem');
$routes->post('/draftkayukeluar/ubah/(:segment)', 'conkayukeluar::edit/$1');
$routes->get('/draftkayukeluar/hapus/(:segment)', 'conkayukeluar::hapus/$1');
$routes->get('/draftkayukeluar/simpan', 'conkayukeluar::simpandraft');

//LAPORAN

$routes->get('/lapkmasuk', 'conlaporan::viewkmasuk');
$routes->post('/lapkmasuktampil', 'conlaporan::viewkmasuktgl');
$routes->get('/lapkmasuktampil/cetak', 'conlaporan::cetakkmasuk');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
