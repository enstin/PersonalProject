<?php

namespace Config;

use CodeIgniter\Commands\Utilities\Routes;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//login
$routes->get('/', 'conlogin::view');
$routes->post('/ceklogin', 'conlogin::ceklogin');
$routes->get('/logout', 'conlogin::logout');

$routes->group('', ['filter' => 'loginfilter'], function ($routes) {

	//dashboard
	$routes->get('/dashboard', 'condashboard::view');

	//barang
	$routes->get('/barang', 'conbarang::view');
	$routes->post('/barang/simpan', 'conbarang::insert');
	$routes->post('/barang/ubah/(:segment)', 'conbarang::ubah/$1');
	$routes->get('/barang/hapus/(:segment)', 'conbarang::hapus/$1');

	//jenis barang
	$routes->get('/jenis-barang', 'conjenis::view');
	$routes->post('/jenis-barang/simpan', 'conjenis::insert');
	$routes->get('/jenis-barang/hapus/(:segment)', 'conjenis::delete/$1');
	$routes->post('/jenis-barang/edit/(:segment)', 'conjenis::edit/$1');

	//belanja
	$routes->get('/belanja', 'conbelanja::view');
	$routes->get('/belanja/tambah-belanja', 'conbelanja::tambah_belanja');
	$routes->get('/belanja/hapuskurang/(:segment)', 'conbelanja::hapuskekurangan/$1');
	$routes->get('/belanja/setuju/(:segment)', 'conbelanja::setuju/$1');
	$routes->get('/belanja/hapus/(:segment)', 'conbelanja::hapus/$1');
	$routes->get('/belanja/lihat-acc/(:segment)', 'conbelanja::detail_belanja_acc/$1');
	$routes->get('/belanja/cetak/(:segment)', 'conbelanja::cetakbelanja/$1');
	$routes->get('/belanja/lihat/(:segment)', 'conbelanja::detail_belanja/$1');
	$routes->post('/belanja/tambah-item-detail', 'conbelanja::tambah_item_detail');
	$routes->get('/belanja/hapus-detail/(:segment)', 'conbelanja::hapus_detail/$1');
	$routes->get('/belanja/update-belanja/(:segment)', 'conbelanja::update_belanja/$1');
	$routes->post('/belanja/tambah-item', 'conbelanja::tambah_item');
	$routes->get('/belanja/simpan-draft', 'conbelanja::simpan_draft');
	$routes->get('/belanja/hapus-dump/(:segment)', 'conbelanja::hapus_dump/$1');

	//pbkeluar
	$routes->get('/pbkeluar', 'conpbkeluar::view');
	$routes->get('/pbkeluar/tambah-pbkeluar', 'conpbkeluar::tambah_pbkeluar');
	$routes->get('/pbkeluar/setuju/(:segment)', 'conpbkeluar::setuju/$1');
	$routes->get('/pbkeluar/hapus/(:segment)', 'conpbkeluar::hapus/$1');
	$routes->get('/pbkeluar/lihat-acc/(:segment)', 'conpbkeluar::detail_pbkeluar_acc/$1');
	$routes->get('/pbkeluar/lihat/(:segment)', 'conpbkeluar::detail_pbkeluar/$1');
	$routes->get('/pbkeluar/cetak/(:segment)', 'conpbkeluar::cetakbkeluar/$1');
	$routes->post('/pbkeluar/tambah-item-detail', 'conpbkeluar::tambah_item_detail');
	$routes->get('/pbkeluar/hapus-detail/(:segment)', 'conpbkeluar::hapus_detail/$1');
	$routes->get('/pbkeluar/update-pbkeluar/(:segment)', 'conpbkeluar::update_pbkeluar/$1');
	$routes->post('/pbkeluar/tambah-item', 'conpbkeluar::tambah_item');
	$routes->post('/pbkeluar/ubah-draft/(:segment)', 'conpbkeluar::updateitem/$1');
	$routes->post('/pbkeluar/ubah-draftrencana/(:segment)', 'conpbkeluar::updateitemrencana/$1');
	$routes->get('/pbkeluar/simpan-draft', 'conpbkeluar::simpan_draft');
	$routes->get('/pbkeluar/hapus-dump/(:segment)', 'conpbkeluar::hapus_dump/$1');

	//barang masuk
	$routes->get('/bmasuk', 'conbmasuk::view');
	$routes->get('/bmasuk/transaksi-barangmasuk/(:segment)', 'conbmasuk::gotrans/$1');
	$routes->get('/bmasuk/draft', 'conbmasuk::viewtrans');
	$routes->post('/bmasuk/tambah-item', 'conbmasuk::tambah_item');
	$routes->get('/bmasuk/simpan-draft/(:segment)', 'conbmasuk::simpan_draft/$1');
	$routes->post('/bmasuk/ubah-draft/(:segment)', 'conbmasuk::ubah_draft/$1');
	$routes->get('/bmasuk/hapus-draft/(:segment)', 'conbmasuk::hapus_draft/$1');

	//barang keluar
	$routes->get('/bkeluar', 'conbkeluar::view');
	$routes->get('/bkeluar/transaksi-barangkeluar/(:segment)', 'conbkeluar::gotrans/$1');
	$routes->get('/bkeluar/draft', 'conbkeluar::viewtrans');
	$routes->post('/bkeluar/tambah-item', 'conbkeluar::tambah_item');
	$routes->get('/bkeluar/simpan-draft/(:segment)', 'conbkeluar::simpan_draft/$1');
	$routes->post('/bkeluar/ubah-draft/(:segment)', 'conbkeluar::ubah_draft');
	$routes->get('/bkeluar/hapus-draft/(:segment)', 'conbkeluar::hapus_draft/$1');

	//stock opname
	$routes->get('/so', 'conso::view');
	$routes->get('/so/tambah-so', 'conso::tambahso');
	$routes->post('/so/tambah-item', 'conso::tambah_item');
	$routes->get('/so/hapus-dump/(:segment)', 'conso::hapus_dump/$1');
	$routes->get('/so/simpan-draft', 'conso::simpan_draft');
	$routes->get('/so/lihat/(:segment)', 'conso::detail_so/$1');

	//jurnal penyesuaian
	$routes->get('/jurnal', 'conpenyesuaian::view');
	$routes->get('/jurnal/transaksi-penyesuaian/(:segment)', 'conpenyesuaian::gotrans/$1');
	$routes->get('/jurnal/transaksi-detpenyesuaian/(:segment)', 'conpenyesuaian::godettrans/$1');
	$routes->post('/jurnal/transaksi-detpenyesuaian/tambahitem', 'conpenyesuaian::tambah_item');
	$routes->get('/jurnal/transaksi-detpenyesuaian/hapusitem/(:segment)', 'conpenyesuaian::hapus_draft/$1');
	$routes->get('/jurnal/transaksi-detpenyesuaian-clear/simpan-draft', 'conpenyesuaian::simpan_draft');
	$routes->get('/jurnal/simpan-draft', 'conpenyesuaian::updateso');
	$routes->get('/jurnal/transaksi-persetujuan/(:segment)', 'conpenyesuaian::gosetuju/$1');
	$routes->get('/jurnal/transaksi-detpersetujuan/(:segment)', 'conpenyesuaian::godetsetuju/$1');
	$routes->get('/jurnal/setujuikurang/(:segment)', 'conpenyesuaian::setujuikurang/$1');
	$routes->get('/jurnal/setujuiexpired/(:segment)', 'conpenyesuaian::setujuiexp/$1');
	$routes->get('/jurnal/setujuitambah/(:segment)', 'conpenyesuaian::setujuitambah/$1');
	$routes->get('/jurnal/setujuinone/(:segment)', 'conpenyesuaian::setujuinone/$1');
	$routes->get('/jurnal/tidak-setujui/(:segment)', 'conpenyesuaian::tidak/$1');
	$routes->get('/jurnal/transaksi-detpersetujuan-clear/selesai', 'conpenyesuaian::selesai_draft');
	$routes->get('/jurnal/selesai', 'conpenyesuaian::selesai_trans');
	$routes->get('/jurnal/cetak/(:segment)', 'conpenyesuaian::cetakpenyesuaian/$1');

	//laporan
	$routes->get('/laporan/barang', 'conlaporan::viewbarang');
	$routes->get('/laporan/bmasuk', 'conlaporan::viewbmasuk');
	$routes->get('/laporan/bkeluar', 'conlaporan::viewbkeluar');
	$routes->post('/laporan/bmasuktampil', 'conlaporan::viewbmasuktgl');
	$routes->post('/laporan/bkeluartampil', 'conlaporan::viewbkeluartgl');
	$routes->get('/laporan/barang/cetak', 'conlaporan::cetakbarang');
	$routes->get('/laporan/bkeluartampil/cetak', 'conlaporan::cetakbkeluar');
	$routes->get('/laporan/bmasuktampil/cetak', 'conlaporan::cetakbmasuk');
	$routes->get('/laporan/histori/bmasuk', 'conlaporan::viewbmasukhist');
	$routes->post('/laporan/histori/bmasuktgl', 'conlaporan::viewbmasukhisttgl');
	$routes->get('/laporan/histori/bmasuk/(:segment)', 'conlaporan::historibmasuk/$1');
	$routes->get('/laporan/histori/bkeluar', 'conlaporan::viewbkeluarhist');
	$routes->post('/laporan/histori/bkeluartgl', 'conlaporan::viewbkeluarhisttgl');
	$routes->get('/laporan/histori/bkeluar/(:segment)', 'conlaporan::historibkeluar/$1');
	$routes->get('/laporan/histori/so', 'conlaporan::viewsohist');
	$routes->post('/laporan/histori/sotgl', 'conlaporan::viewsohisttgl');
	$routes->get('/laporan/histori/so/(:segment)', 'conlaporan::historiso/$1');
	$routes->get('/laporan/histori/penyesuaian', 'conlaporan::viewpenyesuaianhist');
	$routes->post('/laporan/histori/penyesuaiantgl', 'conlaporan::viewpenyesuaianhisttgl');
	$routes->get('/laporan/histori/penyesuaian/(:segment)', 'conlaporan::historipenyesuaian/$1');

	$routes->get('/laporan/histori/belanja', 'conlaporan::viewbelanjahist');
	$routes->post('/laporan/histori/belanjatgl', 'conlaporan::viewbelanjahisttgl');
	$routes->get('/laporan/histori/belanja/(:segment)', 'conlaporan::historibelanja/$1');

	$routes->get('/laporan/histori/pbkeluar', 'conlaporan::viewpbkeluarhist');
	$routes->post('/laporan/histori/pbkeluartgl', 'conlaporan::viewpbkeluarhisttgl');
	$routes->get('/laporan/histori/pbkeluar/(:segment)', 'conlaporan::historipbkeluar/$1');
});











// $routes->get('/rbelanja', 'conrbelanja::view');
// $routes->get('/bmasuk/draftbmasuk', 'condraftbmasuk::view');
// $routes->get('/pbkeluar', 'conpbkeluar::view');
// $routes->get('/bkeluar', 'conbkeluar::view');
// $routes->get('/so', 'conso::view');
// $routes->get('/penyesuaianso', 'conpenyesuaianso::view');
// $routes->get('/persetujuanso', 'conpersetujuanso::view');
/**
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
