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
$routes->get('/', 'Conlogin::view');
$routes->post('/ceklogin', 'Conlogin::ceklogin');
$routes->get('/logout', 'Conlogin::logout');

$routes->group('', ['filter' => 'loginfilter'], function ($routes) {


	//dashboard
	$routes->get('/dashboard', 'condashboard::view');
	$routes->get('/dashboard_g2', 'condashboard::view2');
	$routes->get('/dashboard_g3', 'condashboard::view3');
	$routes->get('/db_owner', 'condashboard::view');
	$routes->get('/db_kgp', 'condashboard::view');
	$routes->get('/db_owner', 'condashboard::view');
	$routes->get('/db_admp', 'condashboard::view');
	$routes->get('/db_kgc1', 'condashboard::view');
	$routes->get('/db_admc1', 'condashboard::view');
	$routes->get('/db_kgc2', 'condashboard::view');
	$routes->get('/db_admc2', 'condashboard::view');


	//gudang 1
	//===========================MASTER DATA===================

	//brand
	$routes->get('/brand', 'conmaster::viewbrand');
	$routes->post('/brand/simpan', 'conmaster::inputbrand');
	$routes->post('/brand/ubah/(:segment)', 'conmaster::ubahbrand/$1');
	$routes->get('/brand/hapus/(:segment)', 'conmaster::hapusbrand/$1');

	//berat
	$routes->get('/berat', 'conmaster::viewberat');
	$routes->post('/berat/simpan', 'conmaster::inputberat');
	$routes->post('/berat/ubah/(:segment)', 'conmaster::ubahberat/$1');
	$routes->get('/berat/hapus/(:segment)', 'conmaster::hapusberat/$1');

	//ukuran
	$routes->get('/ukuran', 'conmaster::viewukuran');
	$routes->post('/ukuran/simpan', 'conmaster::inputukuran');
	$routes->post('/ukuran/ubah/(:segment)', 'conmaster::ubahukuran/$1');
	$routes->get('/ukuran/hapus/(:segment)', 'conmaster::hapusukuran/$1');

	//barang
	$routes->get('/barang', 'conmaster::viewbarang');
	$routes->get('/barang_keseluruhan', 'conmaster::viewbarang_keselurhan');
	$routes->get('/barang_g1', 'conmaster::viewbarang_g1');
	$routes->get('/barang_g2', 'conmaster::viewbarang_g2');
	$routes->get('/barang_g3', 'conmaster::viewbarang_g3');
	$routes->post('/barang/simpan', 'conmaster::inputbarang');
	$routes->post('/barang/ubah/(:segment)', 'conmaster::ubahbarang/$1');
	$routes->get('/barang/hapus/(:segment)', 'conmaster::hapusbarang/$1');

	//detail barang
	$routes->get('/detbarang/(:segment)', 'conmaster::viewdetbarang/$1');
	$routes->post('/detbarang/simpan', 'conmaster::inputdetbarang');
	$routes->get('/detbarang/hapus/(:segment)', 'conmaster::hapusdetbarang/$1');

	//user
	$routes->get('/user', 'conmaster::viewuser');
	$routes->post('/user/simpan', 'conmaster::inputuser');
	$routes->post('/user/ubah/(:segment)', 'conmaster::ubahuser/$1');
	$routes->get('/user/hapus/(:segment)', 'conmaster::hapususer/$1');

	//cr
	$routes->get('/cr', 'conmaster::viewcr');
	$routes->post('/cr/simpan', 'conmaster::inputcr');
	$routes->post('/cr/ubah/(:segment)', 'conmaster::ubahcr/$1');
	$routes->get('/cr/hapus/(:segment)', 'conmaster::hapuscr/$1');

	//supplier
	$routes->get('/supplier', 'conmaster::viewsupplier');
	$routes->post('/supplier/simpan', 'conmaster::inputsupplier');
	$routes->post('/supplier/ubah/(:segment)', 'conmaster::ubahsupplier/$1');
	$routes->get('/supplier/hapus/(:segment)', 'conmaster::hapussupplier/$1');

	//===========================================================================


	//===========================PEMESANAN===================
	$routes->post('/pemesanan/get_satuan', 'conpemesanan::get_satuan');
	//kepala gudang pusat
	$routes->get('/pemesanan', 'conpemesanan::viewpemesanan');
	$routes->get('/pemesanan/acc/(:segment)', 'conpemesanan::viewdraftpemesanan_acc/$1');
	$routes->get('/pemesanan', 'conpemesanan::viewpemesanan');
	$routes->get('/pemesanan/suplist', 'conpemesanan::viewsuplist');
	$routes->get('/pemesanan/go_tambah_pemesanan/(:segment)', 'conpemesanan::viewdraftpemesanan/$1');
	$routes->post('/pemesanan/go_tambah_pemesanan/tambah_item', 'conpemesanan::tambah_dump_item');
	$routes->get('/pemesanan/go_tambah_pemesanan/delete_item/(:segment)', 'conpemesanan::hapus_dump_item/$1');
	$routes->post('/pemesanan/go_tambah_pemesanan/update_item/(:segment)', 'conpemesanan::update_dump_item/$1');
	$routes->get('/pemesanan/simpandraft', 'conpemesanan::simpendraft');
	$routes->get('/pemesanan/cetakpo/(:segment)', 'conpemesanan::po/$1');




	$routes->get('/pemesanan/non-acc/(:segment)', 'conpemesanan::viewdraftpemesanan_nonacc_1/$1');
	$routes->get('/pemesanan/non-acc_view/(:segment)', 'conpemesanan::viewdraftpemesanan_nonacc/$1');
	$routes->post('/pemesanan/tambah_item_nonacc', 'conpemesanan::tambah_dump_item_nonacc');
	$routes->post('/pemesanan/non-acc_update/(:segment)', 'conpemesanan::update_dump_item_non/$1');
	$routes->get('/pemesanan/non-acc_delete/(:segment)', 'conpemesanan::hapus_dump_item_non/$1');
	$routes->get('/pemesanan/simpandraft_nonacc', 'conpemesanan::simpendraft_nonacc');
	$routes->get('/pemesanan/setujui/(:segment)', 'conpemesanan::setujui/$1');

	//pemilik
	$routes->get('/pemesanan/simpandraft', 'conpemesanan::simpendraft');
	//===========================================================================

	//===========================BARANG MASUK===================
	$routes->get('/bmasuk', 'conbmasuk::viewbmasuk');
	$routes->get('/bmasuk/draftbmasuk/(:segment)', 'conbmasuk::viewdetbmasuk/$1');
	$routes->get('/bmasuk/draftbmasuk_minta/(:segment)', 'conbmasuk::viewmasukminta/$1');
	$routes->get('/bmasuk/masuk', 'conbmasuk::prosesmasuk');
	$routes->get('/bmasuk/masuk_non', 'conbmasuk::prosesmasuk_non');
	$routes->get('/bmasuk/tambah_draftbmasuk', 'conbmasuk::viewtrans');
	$routes->post('/bmasuk/draftbmasuk/tambah-item', 'conbmasuk::tambah_dump_item');
	$routes->get('/bmasuk/draftbmasuk/hapus-item/(:segment)', 'conbmasuk::hapus_item/$1');
	$routes->post('/bmasuk/draftbmasuk/update-item/(:segment)', 'conbmasuk::update_item/$1');
	$routes->post('/bmasuk/draftbmasuk/get_satuan', 'conbmasuk::get_satuan');
	//===========================================================================

	//===========================RETUR PEMESANAN===================
	$routes->post('/pemesanan/get_satuan', 'conpemesanan::get_satuan');
	//kepala gudang pusat
	$routes->get('/retpesan', 'conreturpesan::viewretur');
	$routes->get('/retpesan/draftretur/(:segment)', 'conreturpesan::viewaja/$1');
	$routes->post('/retpesan/draftretur/tambah-item', 'conreturpesan::tambah_dump_item');
	$routes->get('/retpesan/draftretur/hapus-item/(:segment)', 'conreturpesan::delete_dump_item/$1');
	$routes->post('/retpesan/draftretur/edit-item/(:segment)', 'conreturpesan::edit_dump_item/$1');
	$routes->get('/retpesan/simpan', 'conreturpesan::simpan_transaksi');
	$routes->get('/retpesan/terima-retur/(:segment)', 'conreturpesan::viewterima/$1');
	$routes->get('/retpesan/proses-terima-retur', 'conreturpesan::terima_retur');

	//pemilik
	$routes->get('/pemesanan/simpandraft', 'conpemesanan::simpendraft');
	//===========================================================================


	//===========================RETUR PERMINTAAN===================
	$routes->post('/retminta/get_satuan', 'conreturminta::get_satuan');
	//kepala gudang pusat
	$routes->get('/retminta', 'conreturminta::viewretur');
	$routes->get('/retminta/draftretur/(:segment)', 'conreturminta::viewaja/$1');
	$routes->post('/retminta/draftretur/tambah-item', 'conreturminta::tambah_dump_item');
	$routes->get('/retminta/draftretur/hapus-item/(:segment)', 'conreturminta::delete_dump_item/$1');
	$routes->post('/retminta/draftretur/edit-item/(:segment)', 'conreturminta::edit_dump_item/$1');
	$routes->get('/retminta/simpan', 'conreturminta::simpan_transaksi');
	$routes->get('/retminta/terima-retur/(:segment)', 'conreturminta::viewterima/$1');
	$routes->get('/retminta/proses-terima-retur', 'conreturminta::terima_retur');

	//pemilik
	$routes->get('/pemesanan/simpandraft', 'conpemesanan::simpendraft');
	//===========================================================================

	//barang keluar
	$routes->get('/bkeluar', 'conbkeluar::view');
	$routes->get('/bkeluar/draftbkeluar_2', 'conbkeluar::viewdraft_2');
	$routes->get('/bkeluar/draftbkeluar', 'conbkeluar::viewdraft');
	$routes->get('/bkeluar/draftbkeluar/simpan', 'conbkeluar::proseskeluar');
	$routes->post('/bkeluar/draftbkeluar/tambah-item', 'conbkeluar::tambah_dump_item');
	$routes->get('/bkeluar/draftbkeluar/hapus-item/(:segment)', 'conbkeluar::hapus_item/$1');
	$routes->post('/bkeluar/draftbkeluar/update-item/(:segment)', 'conbkeluar::update_item/$1');
	$routes->post('/bkeluar/draftbkeluar/get_satuan', 'conbkeluar::get_satuan');


	//===========================PERMINTAAN===================
	$routes->post('/permintaan/get_satuan', 'conpermintaan::get_satuan');
	$routes->post('/permintaan_g2/get_satuan', 'conpermintaan_g2::get_satuan');
	$routes->post('/permintaan_g3/get_satuan', 'conpermintaan_g3::get_satuan');
	$routes->get('/permintaan/cetak/(:segment)', 'conpermintaan::sj/$1');
	//kepala gudang pusat
	$routes->get('/permintaan/lihat/(:segment)', 'conpermintaan::viewpermintaan_lihat/$1');
	$routes->get('/permintaan', 'conpermintaan::viewpermintaan');
	$routes->get('/permintaan/detail_acc/(:segment)', 'conpermintaan::viewdetail_dikirim/$1');
	$routes->get('/permintaan/detail_non/(:segment)', 'conpermintaan::viewdetail_diajukan/$1');
	$routes->get('/permintaan/detail_non_view/(:segment)', 'conpermintaan::viewdetail_diajukan_1/$1');
	$routes->get('/permintaan/non-acc_tambah', 'conpermintaan::viewdraftpermintaan_nonacc_tambah');
	$routes->post('/permintaan/non-acc/tambah_item_nonacc', 'conpermintaan::tambah_dump_item_nonacc');
	$routes->get('/permintaan', 'conpermintaan::viewpermintaan');
	$routes->get('/permintaan/gudlist', 'conpermintaan::viewgudlist');
	$routes->get('/permintaan/go_tambah_permintaan/(:segment)', 'conpermintaan::viewdraftpermintaan/$1');
	$routes->post('/permintaan/tambah_item', 'conpermintaan::tambah_dump_item');
	$routes->get('/permintaan/delete_item/(:segment)', 'conpermintaan::hapus_dump_item/$1');
	$routes->post('/permintaan/update_item/(:segment)', 'conpermintaan::update_dump_item/$1');
	$routes->get('/permintaan/simpandraft', 'conpermintaan::simpendraft');
	$routes->get('/permintaan/setujui/(:segment)', 'conpermintaan::setujui/$1');
	$routes->get('/permintaan/akan-kirim/(:segment)', 'conpermintaan::akan_dikirim/$1');
	$routes->get('/permintaan/kirim/(:segment)', 'conpermintaan::dikirim/$1');
	$routes->get('/permintaan/kirim_2/(:segment)', 'conpermintaan::dikirim_2/$1');
	$routes->get('/permintaan/kirim_3/(:segment)', 'conpermintaan::dikirim_3/$1');
	$routes->get('/bmasuk/draftbmasuk/(:segment)', 'conbmasuk::viewdetbmasuk/$1');
	$routes->get('/bmasuk/masuk', 'conbmasuk::prosesmasuk');
	$routes->get('/bmasuk/masuk_minta', 'conbmasuk::prosesmasuk_permintaan');
	$routes->get('/bmasuk/masuk_non', 'conbmasuk::prosesmasuk_non');
	$routes->post('/permintaan/tambah_item_non', 'conpermintaan::tambah_dump_item_non');
	$routes->get('/permintaan/delete_item_non/(:segment)', 'conpermintaan::hapus_dump_item_non/$1');
	$routes->post('/permintaan/update_item_non/(:segment)', 'conpermintaan::update_dump_item_non/$1');
	$routes->get('/permintaan/simpandraft_non', 'conpermintaan::simpendraft_detail');

	//===========================================================================


	//===========================PERMINTAAN===================
	$routes->post('/so/get_satuan', 'conso::get_satuan');
	//stock opname
	$routes->get('/so', 'conso::view');
	$routes->get('/so/tambah-so', 'conso::tambahso');
	$routes->post('/so/tambah-item', 'conso::tambah_item');
	$routes->get('/so/hapus-dump/(:segment)', 'conso::hapus_dump/$1');
	$routes->get('/so/simpan-draft', 'conso::simpan_draft');
	$routes->get('/so/lihat/(:segment)', 'conso::detail_so/$1');
	$routes->post('/so/edit-draft/(:segment)', 'conso::edit_draft/$1');
	//===========================================================================

	//jurnal penyesuaian
	$routes->get('/jurnal', 'conpenyesuaian::view');
	$routes->get('/jurnal/trans/(:segment)', 'conpenyesuaian::trans/$1');
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







	// $routes->group('', ['filter' => 'filter_g1'], function ($routes) {
	// 	$routes->group('', ['filter' => 'filter_owner'], function ($routes) {
	// 	});
	// 	$routes->group('', ['filter' => 'filter_kepala'], function ($routes) {
	// 	});
	// 	$routes->group('', ['filter' => 'filter_admin'], function ($routes) {
	// 	});
	// });
	// $routes->group('', ['filter' => 'filter_g2'], function ($routes) {
	// 	$routes->group('', ['filter' => 'filter_kepala'], function ($routes) {
	// 	});
	// 	$routes->group('', ['filter' => 'filter_admin'], function ($routes) {
	// 	});
	// });
	// $routes->group('', ['filter' => 'filter_g3'], function ($routes) {
	// 	$routes->group('', ['filter' => 'filter_kepala'], function ($routes) {
	// 	});
	// 	$routes->group('', ['filter' => 'filter_admin'], function ($routes) {
	// 	});
	// });
	//gudang 2
	//===========================MASTER DATA===================


	//===========================BARANG MASUK===================
	$routes->get('/bmasuk_g2', 'conbmasuk_g2::viewbmasuk');
	$routes->get('/bmasuk_g2/draftbmasuk_minta/(:segment)', 'conbmasuk_g2::viewdetbmasuk/$1');
	$routes->get('/bmasuk_g2/masuk', 'conbmasuk_g2::prosesmasuk');
	$routes->get('/bmasuk_g2/masuk_non', 'conbmasuk_g2::prosesmasuk_non');
	$routes->get('/bmasuk_g2/tambah_draftbmasuk', 'conbmasuk_g2::viewtrans');
	$routes->post('/bmasuk_g2/draftbmasuk/tambah-item', 'conbmasuk_g2::tambah_dump_item');
	$routes->get('/bmasuk_g2/draftbmasuk/hapus-item/(:segment)', 'conbmasuk_g2::hapus_item/$1');
	$routes->post('/bmasuk_g2/draftbmasuk/update-item/(:segment)', 'conbmasuk_g2::update_item/$1');
	$routes->post('/bmasuk_g2/draftbmasuk/get_satuan', 'conbmasuk_g2::get_satuan');
	//===========================================================================

	//===========================RETUR PERMINTAAN===================
	$routes->post('/retminta_g2/get_satuan', 'conreturminta_g2::get_satuan');
	//kepala gudang pusat
	$routes->get('/retminta_g2', 'conreturminta_g2::viewretur');
	$routes->get('/retminta_g2/draftretur/(:segment)', 'conreturminta_g2::viewaja/$1');
	$routes->post('/retminta_g2/draftretur/tambah-item', 'conreturminta_g2::tambah_dump_item');
	$routes->get('/retminta_g2/draftretur/hapus-item/(:segment)', 'conreturminta_g2::delete_dump_item/$1');
	$routes->post('/retminta_g2/draftretur/edit-item/(:segment)', 'conreturminta_g2::edit_dump_item/$1');
	$routes->get('/retminta_g2/simpan', 'conreturminta_g2::simpan_transaksi');
	$routes->get('/retminta_g2/terima-retur/(:segment)', 'conreturminta_g2::viewterima/$1');
	$routes->get('/retminta_g2/proses-terima-retur', 'conreturminta_g2::terima_retur');

	//pemilik
	$routes->get('/pemesanan_g2/simpandraft', 'conpemesanan_g2::simpendraft');
	//===========================================================================

	//barang keluar
	$routes->get('/bkeluar_g2', 'conbkeluar_g2::view');
	$routes->get('/bkeluar_g2/draftbkeluar_2', 'conbkeluar_g2::viewdraft_2');
	$routes->get('/bkeluar_g2/draftbkeluar', 'conbkeluar_g2::viewdraft');
	$routes->get('/bkeluar_g2/draftbkeluar/simpan', 'conbkeluar_g2::proseskeluar');
	$routes->post('/bkeluar_g2/draftbkeluar/tambah-item', 'conbkeluar_g2::tambah_dump_item');
	$routes->get('/bkeluar_g2/draftbkeluar/hapus-item/(:segment)', 'conbkeluar_g2::hapus_item/$1');
	$routes->post('/bkeluar_g2/draftbkeluar/update-item/(:segment)', 'conbkeluar_g2::update_item/$1');
	$routes->post('/bkeluar_g2/draftbkeluar/get_satuan', 'conbkeluar_g2::get_satuan');


	//===========================PERMINTAAN===================
	$routes->post('/permintaan_g2/get_satuan', 'conpermintaan_g2::get_satuan');
	//kepala gudang pusat
	$routes->post('/permintaan_g2/tambah_item', 'conpermintaan_g2::tambah_dump_item');
	$routes->get('/permintaan_g2/lihat/(:segment)', 'conpermintaan_g2::viewpermintaan_lihat/$1');
	$routes->get('/permintaan_g2', 'conpermintaan_g2::viewpermintaan');
	$routes->get('/permintaan_g2/detail_acc/(:segment)', 'conpermintaan_g2::viewdetail_dikirim/$1');
	$routes->get('/permintaan_g2/detail_non/(:segment)', 'conpermintaan_g2::viewdetail_diajukan/$1');
	$routes->get('/permintaan_g2/detail_non_view/(:segment)', 'conpermintaan_g2::viewdetail_diajukan_1/$1');
	$routes->post('/permintaan_g2/non-acc/tambah_item_nonacc', 'conpermintaan_g2::tambah_dump_item_nonacc');
	$routes->get('/permintaan_g2', 'conpermintaan_g2::viewpermintaan');
	$routes->get('/permintaan_g2/gudlist', 'conpermintaan_g2::viewgudlist');
	$routes->get('/permintaan_g2/go_tambah_permintaan', 'conpermintaan_g2::viewdraftpermintaan');
	$routes->post('/permintaan_g2/go_tambah_permintaan/tambah_item', 'conpermintaan_g2::tambah_dump_item');
	$routes->get('/permintaan_g2/go_tambah_permintaan/delete_item/(:segment)', 'conpermintaan_g2::hapus_dump_item/$1');
	$routes->post('/permintaan_g2/go_tambah_permintaan/update_item/(:segment)', 'conpermintaan_g2::update_dump_item/$1');
	$routes->get('/permintaan_g2/simpandraft', 'conpermintaan_g2::simpendraft');
	$routes->get('/permintaan_g2/simpandraft_nonacc', 'conpermintaan_g2::simpendraft_nonacc');
	$routes->get('/permintaan_g2/setujui/(:segment)', 'conpermintaan_g2::setujui/$1');
	$routes->get('/permintaan_g2/akan-kirim/(:segment)', 'conpermintaan_g2::akan_dikirim/$1');
	$routes->get('/permintaan_g2/kirim/(:segment)', 'conpermintaan_g2::dikirim/$1');
	$routes->get('/permintaan_g2/kirim_2/(:segment)', 'conpermintaan_g2::dikirim_2/$1');
	$routes->get('/permintaan_g2/kirim_3/(:segment)', 'conpermintaan_g2::dikirim_3/$1');
	$routes->post('/permintaan_g2/tambah_item_non', 'conpermintaan_g2::tambah_dump_item_non');
	$routes->get('/permintaan_g2/delete_item_non/(:segment)', 'conpermintaan_g2::hapus_dump_item_non/$1');
	$routes->post('/permintaan_g2/update_item_non/(:segment)', 'conpermintaan_g2::update_dump_item_non/$1');
	$routes->get('/permintaan_g2/simpandraft_non', 'conpermintaan_g2::simpendraft_detail');


	//===========================================================================


	//===========================PERMINTAAN===================
	$routes->post('/so_g2/get_satuan', 'conso_g2::get_satuan');
	//stock opname
	$routes->get('/so_g2', 'conso_g2::view');
	$routes->get('/so_g2/tambah-so', 'conso_g2::tambahso');
	$routes->post('/so_g2/tambah-item', 'conso_g2::tambah_item');
	$routes->get('/so_g2/hapus-dump/(:segment)', 'conso_g2::hapus_dump/$1');
	$routes->get('/so_g2/simpan-draft', 'conso_g2::simpan_draft');
	$routes->get('/so_g2/lihat/(:segment)', 'conso_g2::detail_so/$1');
	$routes->post('/so_g2/edit-draft/(:segment)', 'conso_g2::edit_draft/$1');
	//===========================================================================

	//jurnal penyesuaian
	$routes->get('/jurnal_g2', 'conpenyesuaian_g2::view');
	$routes->get('/jurnal_g2/trans/(:segment)', 'conpenyesuaian_g2::trans/$1');
	$routes->get('/jurnal_g2/transaksi-penyesuaian/(:segment)', 'conpenyesuaian_g2::gotrans/$1');
	$routes->get('/jurnal_g2/transaksi-detpenyesuaian/(:segment)', 'conpenyesuaian_g2::godettrans/$1');
	$routes->post('/jurnal_g2/transaksi-detpenyesuaian/tambahitem', 'conpenyesuaian_g2::tambah_item');
	$routes->get('/jurnal_g2/transaksi-detpenyesuaian/hapusitem/(:segment)', 'conpenyesuaian_g2::hapus_draft/$1');
	$routes->get('/jurnal_g2/transaksi-detpenyesuaian-clear/simpan-draft', 'conpenyesuaian_g2::simpan_draft');
	$routes->get('/jurnal_g2/simpan-draft', 'conpenyesuaian_g2::updateso');
	$routes->get('/jurnal_g2/transaksi-persetujuan/(:segment)', 'conpenyesuaian_g2::gosetuju/$1');
	$routes->get('/jurnal_g2/transaksi-detpersetujuan/(:segment)', 'conpenyesuaian_g2::godetsetuju/$1');
	$routes->get('/jurnal_g2/setujuikurang/(:segment)', 'conpenyesuaian_g2::setujuikurang/$1');
	$routes->get('/jurnal_g2/setujuiexpired/(:segment)', 'conpenyesuaian_g2::setujuiexp/$1');
	$routes->get('/jurnal_g2/setujuitambah/(:segment)', 'conpenyesuaian_g2::setujuitambah/$1');
	$routes->get('/jurnal_g2/setujuinone/(:segment)', 'conpenyesuaian_g2::setujuinone/$1');
	$routes->get('/jurnal_g2/tidak-setujui/(:segment)', 'conpenyesuaian_g2::tidak/$1');
	$routes->get('/jurnal_g2/transaksi-detpersetujuan-clear/selesai', 'conpenyesuaian_g2::selesai_draft');
	$routes->get('/jurnal_g2/selesai', 'conpenyesuaian_g2::selesai_trans');
	$routes->get('/jurnal_g2/cetak/(:segment)', 'conpenyesuaian_g2::cetakpenyesuaian/$1');





	//gudang 3


	//===========================BARANG MASUK===================
	$routes->get('/bmasuk_g3', 'conbmasuk_g3::viewbmasuk');
	$routes->get('/bmasuk_g3/draftbmasuk_minta/(:segment)', 'conbmasuk_g3::viewdetbmasuk/$1');
	$routes->get('/bmasuk_g3/masuk', 'conbmasuk_g3::prosesmasuk');
	$routes->get('/bmasuk_g3/masuk_non', 'conbmasuk_g3::prosesmasuk_non');
	$routes->get('/bmasuk_g3/tambah_draftbmasuk', 'conbmasuk_g3::viewtrans');
	$routes->post('/bmasuk_g3/draftbmasuk/tambah-item', 'conbmasuk_g3::tambah_dump_item');
	$routes->get('/bmasuk_g3/draftbmasuk/hapus-item/(:segment)', 'conbmasuk_g3::hapus_item/$1');
	$routes->post('/bmasuk_g3/draftbmasuk/update-item/(:segment)', 'conbmasuk_g3::update_item/$1');
	$routes->post('/bmasuk_g3/draftbmasuk/get_satuan', 'conbmasuk_g3::get_satuan');
	//===========================================================================

	//===========================RETUR PERMINTAAN===================
	$routes->post('/retminta_g3/get_satuan', 'conreturminta_g3::get_satuan');
	//kepala gudang pusat
	$routes->get('/retminta_g3', 'conreturminta_g3::viewretur');
	$routes->get('/retminta_g3/draftretur/(:segment)', 'conreturminta_g3::viewaja/$1');
	$routes->post('/retminta_g3/draftretur/tambah-item', 'conreturminta_g3::tambah_dump_item');
	$routes->get('/retminta_g3/draftretur/hapus-item/(:segment)', 'conreturminta_g3::delete_dump_item/$1');
	$routes->post('/retminta_g3/draftretur/edit-item/(:segment)', 'conreturminta_g3::edit_dump_item/$1');
	$routes->get('/retminta_g3/simpan', 'conreturminta_g3::simpan_transaksi');
	$routes->get('/retminta_g3/terima-retur/(:segment)', 'conreturminta_g3::viewterima/$1');
	$routes->get('/retminta_g3/proses-terima-retur', 'conreturminta_g3::terima_retur');

	//pemilik
	$routes->get('/pemesanan_g3/simpandraft', 'conpemesanan_g3::simpendraft');
	//===========================================================================

	//barang keluar
	$routes->get('/bkeluar_g3', 'conbkeluar_g3::view');
	$routes->get('/bkeluar_g3/draftbkeluar', 'conbkeluar_g3::viewdraft');
	$routes->get('/bkeluar_g3/draftbkeluar/simpan', 'conbkeluar_g3::proseskeluar');
	$routes->post('/bkeluar_g3/draftbkeluar/tambah-item', 'conbkeluar_g3::tambah_dump_item');
	$routes->get('/bkeluar_g3/draftbkeluar/hapus-item/(:segment)', 'conbkeluar_g3::hapus_item/$1');
	$routes->post('/bkeluar_g3/draftbkeluar/update-item/(:segment)', 'conbkeluar_g3::update_item/$1');
	$routes->post('/bkeluar_g3/draftbkeluar/get_satuan', 'conbkeluar_g3::get_satuan');


	//===========================PERMINTAAN===================
	$routes->post('/permintaan_g3/get_satuan', 'conpermintaan_g3::get_satuan');
	//kepala gudang pusat
	$routes->get('/permintaan_g3/lihat/(:segment)', 'conpermintaan_g3::viewpermintaan_lihat/$1');
	$routes->get('/permintaan_g3', 'conpermintaan_g3::viewpermintaan');
	$routes->post('/permintaan_g3/tambah_item', 'conpermintaan_g3::tambah_dump_item');
	$routes->get('/permintaan_g3/detail_acc/(:segment)', 'conpermintaan_g3::viewdetail_dikirim/$1');
	$routes->get('/permintaan_g3/detail_non/(:segment)', 'conpermintaan_g3::viewdetail_diajukan/$1');
	$routes->get('/permintaan_g3/non-acc/(:segment)', 'conpermintaan_g3::viewdraftpermintaan_nonacc/$1');
	$routes->get('/permintaan_g3/non-acc_tambah', 'conpermintaan_g3::viewdraftpermintaan_nonacc_tambah');
	$routes->post('/permintaan_g3/non-acc/tambah_item_nonacc', 'conpermintaan_g3::tambah_dump_item_nonacc');
	$routes->get('/permintaan_g3', 'conpermintaan_g3::viewpermintaan');
	$routes->get('/permintaan_g3/gudlist', 'conpermintaan_g3::viewgudlist');
	$routes->get('/permintaan_g3/go_tambah_permintaan', 'conpermintaan_g3::viewdraftpermintaan');
	$routes->post('/permintaan_g3/go_tambah_permintaan/tambah_item', 'conpermintaan_g3::tambah_dump_item');
	$routes->get('/permintaan_g3/go_tambah_permintaan/delete_item/(:segment)', 'conpermintaan_g3::hapus_dump_item/$1');
	$routes->post('/permintaan_g3/go_tambah_permintaan/update_item/(:segment)', 'conpermintaan_g3::update_dump_item/$1');
	$routes->get('/permintaan_g3/simpandraft', 'conpermintaan_g3::simpendraft');
	$routes->get('/permintaan_g3/simpandraft_nonacc', 'conpermintaan_g3::simpendraft_nonacc');
	$routes->get('/permintaan_g3/setujui/(:segment)', 'conpermintaan_g3::setujui/$1');
	$routes->get('/permintaan_g3/akan-kirim/(:segment)', 'conpermintaan_g3::akan_dikirim/$1');
	$routes->get('/permintaan_g3/kirim/(:segment)', 'conpermintaan_g3::dikirim/$1');
	$routes->get('/permintaan_g3/kirim_2/(:segment)', 'conpermintaan_g3::dikirim_2/$1');
	$routes->get('/permintaan_g3/kirim_3/(:segment)', 'conpermintaan_g3::dikirim_3/$1');
	$routes->get('/permintaan_g3/detail_non_view/(:segment)', 'conpermintaan_g3::viewdetail_diajukan_1/$1');
	$routes->post('/permintaan_g3/tambah_item_non', 'conpermintaan_g3::tambah_dump_item_non');
	$routes->get('/permintaan_g3/delete_item_non/(:segment)', 'conpermintaan_g3::hapus_dump_item_non/$1');
	$routes->post('/permintaan_g3/update_item_non/(:segment)', 'conpermintaan_g3::update_dump_item_non/$1');
	$routes->get('/permintaan_g3/simpandraft_non', 'conpermintaan_g3::simpendraft_detail');


	//===========================================================================


	//===========================PERMINTAAN===================
	$routes->post('/so_g3/get_satuan', 'conso_g3::get_satuan');
	//stock opname
	$routes->get('/so_g3', 'conso_g3::view');
	$routes->get('/so_g3/tambah-so', 'conso_g3::tambahso');
	$routes->post('/so_g3/tambah-item', 'conso_g3::tambah_item');
	$routes->get('/so_g3/hapus-dump/(:segment)', 'conso_g3::hapus_dump/$1');
	$routes->get('/so_g3/simpan-draft', 'conso_g3::simpan_draft');
	$routes->get('/so_g3/lihat/(:segment)', 'conso_g3::detail_so/$1');
	$routes->post('/so_g3/edit-draft/(:segment)', 'conso_g3::edit_draft/$1');
	//===========================================================================

	//jurnal penyesuaian
	$routes->get('/jurnal_g3', 'conpenyesuaian_g3::view');
	$routes->get('/jurnal_g3/trans/(:segment)', 'conpenyesuaian_g3::trans/$1');
	$routes->get('/jurnal_g3/transaksi-penyesuaian/(:segment)', 'conpenyesuaian_g3::gotrans/$1');
	$routes->get('/jurnal_g3/transaksi-detpenyesuaian/(:segment)', 'conpenyesuaian_g3::godettrans/$1');
	$routes->post('/jurnal_g3/transaksi-detpenyesuaian/tambahitem', 'conpenyesuaian_g3::tambah_item');
	$routes->get('/jurnal_g3/transaksi-detpenyesuaian/hapusitem/(:segment)', 'conpenyesuaian_g3::hapus_draft/$1');
	$routes->get('/jurnal_g3/transaksi-detpenyesuaian-clear/simpan-draft', 'conpenyesuaian_g3::simpan_draft');
	$routes->get('/jurnal_g3/simpan-draft', 'conpenyesuaian_g3::updateso');
	$routes->get('/jurnal_g3/transaksi-persetujuan/(:segment)', 'conpenyesuaian_g3::gosetuju/$1');
	$routes->get('/jurnal_g3/transaksi-detpersetujuan/(:segment)', 'conpenyesuaian_g3::godetsetuju/$1');
	$routes->get('/jurnal_g3/setujuikurang/(:segment)', 'conpenyesuaian_g3::setujuikurang/$1');
	$routes->get('/jurnal_g3/setujuiexpired/(:segment)', 'conpenyesuaian_g3::setujuiexp/$1');
	$routes->get('/jurnal_g3/setujuitambah/(:segment)', 'conpenyesuaian_g3::setujuitambah/$1');
	$routes->get('/jurnal_g3/setujuinone/(:segment)', 'conpenyesuaian_g3::setujuinone/$1');
	$routes->get('/jurnal_g3/tidak-setujui/(:segment)', 'conpenyesuaian_g3::tidak/$1');
	$routes->get('/jurnal_g3/transaksi-detpersetujuan-clear/selesai', 'conpenyesuaian_g3::selesai_draft');
	$routes->get('/jurnal_g3/selesai', 'conpenyesuaian_g3::selesai_trans');
	$routes->get('/jurnal_g3/cetak/(:segment)', 'conpenyesuaian_g3::cetakpenyesuaian/$1');



	//laporan
	$routes->get('/histbarang', 'conlaporan::viewbarang');
	$routes->get('/histbkeluar', 'conlaporan::viewbkeluarhist');
	$routes->post('/histbkeluartgl', 'conlaporan::viewbkeluarhisttgl');
	$routes->get('/histbkeluar/(:segment)', 'conlaporan::historibkeluar/$1');
	$routes->get('/histbmasuk', 'conlaporan::viewbmasukhist');
	$routes->post('/histbmasuktgl', 'conlaporan::viewbmasukhisttgl');
	$routes->get('/histbmasuk/(:segment)', 'conlaporan::historibmasuk/$1');

	$routes->get('/histpenyesuaian', 'conlaporan::viewpenyesuaianhist');
	$routes->post('/histpenyesuaiantgl', 'conlaporan::viewpenyesuaianhisttgl');
	$routes->get('/histpenyesuaian/(:segment)', 'conlaporan::historipenyesuaian/$1');

	$routes->get('/histpesan', 'conlaporan::viewpemesananhist');
	$routes->post('/histpesantgl', 'conlaporan::viewpemesananhisttgl');
	$routes->get('/histpesan/(:segment)', 'conlaporan::historipemesanan/$1');

	$routes->get('/histminta', 'conlaporan::viewpermintaanhist');
	$routes->post('/histmintatgl', 'conlaporan::viewpermintaanhisttgl');
	$routes->get('/histminta/(:segment)', 'conlaporan::historipermintaan/$1');

	$routes->get('/histso', 'conlaporan::viewsohist');
	$routes->post('/histsotgl', 'conlaporan::viewsohisttgl');
	$routes->get('/histso/(:segment)', 'conlaporan::historiso/$1');

	$routes->get('/lapbmasuk', 'conlaporan::viewbmasuk');
	$routes->get('/lapbkeluar', 'conlaporan::viewbkeluar');
	$routes->post('/lapbmasuktampil', 'conlaporan::viewbmasuktgl');
	$routes->post('/lapbkeluartampil', 'conlaporan::viewbkeluartgl');
	$routes->get('/laporan/barang/cetak', 'conlaporan::cetakbarang');
	$routes->get('/lapbkeluartampil/cetak', 'conlaporan::cetakbkeluar');
	$routes->get('/lapbmasuktampil/cetak', 'conlaporan::cetakbmasuk');



	//laporan g2
	$routes->get('/histbarang_g2', 'conlaporan_g2::viewbarang');
	$routes->get('/histbkeluar_g2', 'conlaporan_g2::viewbkeluarhist');
	$routes->post('/histbkeluartgl_g2', 'conlaporan_g2::viewbkeluarhisttgl');
	$routes->get('/histbkeluar_g2/(:segment)', 'conlaporan_g2::historibkeluar/$1');
	$routes->get('/histbmasuk_g2', 'conlaporan_g2::viewbmasukhist');
	$routes->post('/histbmasuktgl_g2', 'conlaporan_g2::viewbmasukhisttgl');
	$routes->get('/histbmasuk_g2/(:segment)', 'conlaporan_g2::historibmasuk/$1');

	$routes->get('/histpenyesuaian_g2', 'conlaporan_g2::viewpenyesuaianhist');
	$routes->post('/histpenyesuaiantgl_g2', 'conlaporan_g2::viewpenyesuaianhisttgl');
	$routes->get('/histpenyesuaian_g2/(:segment)', 'conlaporan_g2::historipenyesuaian/$1');

	$routes->get('/histpesan_g2', 'conlaporan_g2::viewpemesananhist');
	$routes->post('/histpesantgl_g2', 'conlaporan_g2::viewpemesananhisttgl');
	$routes->get('/histpesan_g2/(:segment)', 'conlaporan_g2::historipemesanan/$1');

	$routes->get('/histminta_g2', 'conlaporan_g2::viewpermintaanhist');
	$routes->post('/histmintatgl_g2', 'conlaporan_g2::viewpermintaanhisttgl');
	$routes->get('/histminta_g2/(:segment)', 'conlaporan_g2::historipermintaan/$1');

	$routes->get('/histso_g2', 'conlaporan_g2::viewsohist');
	$routes->post('/histsotgl_g2', 'conlaporan_g2::viewsohisttgl');
	$routes->get('/histso_g2/(:segment)', 'conlaporan_g2::historiso/$1');



	//laporan g3
	$routes->get('/histbarang_g3', 'conlaporan_g3::viewbarang');
	$routes->get('/histbkeluar_g3', 'conlaporan_g3::viewbkeluarhist');
	$routes->post('/histbkeluartgl_g3', 'conlaporan_g3::viewbkeluarhisttgl');
	$routes->get('/histbkeluar_g3/(:segment)', 'conlaporan_g3::historibkeluar/$1');
	$routes->get('/histbmasuk_g3', 'conlaporan_g3::viewbmasukhist');
	$routes->post('/histbmasuktgl_g3', 'conlaporan_g3::viewbmasukhisttgl');
	$routes->get('/histbmasuk_g3/(:segment)', 'conlaporan_g3::historibmasuk/$1');

	$routes->get('/histpenyesuaian_g3', 'conlaporan_g3::viewpenyesuaianhist');
	$routes->post('/histpenyesuaiantgl_g3', 'conlaporan_g3::viewpenyesuaianhisttgl');
	$routes->get('/histpenyesuaian_g3/(:segment)', 'conlaporan_g3::historipenyesuaian/$1');

	$routes->get('/histpesan_g3', 'conlaporan_g3::viewpemesananhist');
	$routes->post('/histpesantgl_g3', 'conlaporan_g3::viewpemesananhisttgl');
	$routes->get('/histpesan_g3/(:segment)', 'conlaporan_g3::historipemesanan/$1');

	$routes->get('/histminta_g3', 'conlaporan_g3::viewpermintaanhist');
	$routes->post('/histmintatgl_g3', 'conlaporan_g3::viewpermintaanhisttgl');
	$routes->get('/histminta_g3/(:segment)', 'conlaporan_g3::historipermintaan/$1');

	$routes->get('/histso_g3', 'conlaporan_g3::viewsohist');
	$routes->post('/histsotgl_g3', 'conlaporan_g3::viewsohisttgl');
	$routes->get('/histso_g3/(:segment)', 'conlaporan_g3::historiso/$1');
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
