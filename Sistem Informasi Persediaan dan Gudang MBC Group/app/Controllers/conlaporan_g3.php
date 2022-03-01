<?php

namespace App\Controllers;

use \App\Models\modlaporan_g3;
use mysqli;
use mysqli_result;
use PDO;

class conlaporan_g3 extends BaseController
{

	protected $modelbarang;
	// protected $db;
	public function __construct()
	{
		$this->modelbarang = new modlaporan_g3();
	}
	public function viewbarang()
	{
		$tabel = $this->modelbarang->tampilbarang();
		// dd($jenis);
		$data = [
			'title' => 'LAPORAN STOK BARANG',
			'tabel' => $tabel,
			'link' => '/lapstok',
		];
		return view('/laporan/barang', $data);
	}
	public function viewsohist()
	{
		$tabel = $this->modelbarang->tampilhistso();
		$data = [
			'title' => 'HISTORI STOK OPNAME',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_so', $data);
	}
	public function viewpbkeluarhist()
	{
		$tabel = $this->modelbarang->tampilhistpbkeluar();
		$data = [
			'title' => 'HISTORI PERMINTAAN BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_pbkeluar', $data);
	}
	public function viewpemesananhist()
	{
		$tabel = $this->modelbarang->tampilhistpemesanan();
		$data = [
			'title' => 'HISTORI pemesanan',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_pemesanan', $data);
	}
	public function viewpermintaanhist()
	{
		$tabel = $this->modelbarang->tampilhistpermintaan2();
		$data = [
			'title' => 'HISTORI permintaan',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_permintaan', $data);
	}
	public function viewpenyesuaianhist()
	{
		$tabel = $this->modelbarang->tampilhistpenyesuaian();
		$data = [
			'title' => 'HISTORI TINDAKAN PENYESUAIAN',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_penyesuaian', $data);
	}
	public function viewbmasuk()
	{
		//02/04/2021 - 02/04/2021
		$interval = '-' . 7 . 'day';
		date_default_timezone_set('Asia/Jakarta');
		$tglskrg = date('m/d/Y');
		$tglsebelum = date('Y-m-d', strtotime($interval, strtotime($tglskrg)));
		$tglset = $tglsebelum . ' - ' . $tglskrg;
		session()->set(['tanggalmasuk' => $tglset]);

		$data = [
			'title' => 'LAPORAN BARANG MASUK',
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/bmasuk', $data);
	}
	public function viewbmasukhist()
	{
		$tabel = $this->modelbarang->tampilhistmasuk();
		$data = [
			'title' => 'HISTORI BARANG MASUK',
			'tabel' => $tabel,
			'link' => '/laporan/histori/bmasuk',
		];
		return view('/laporan/histori_bmasuk', $data);
	}
	public function viewbkeluar()
	{
		$interval = '-' . '7' . 'day';
		date_default_timezone_set('Asia/Jakarta');
		$tglskrg = date('m/d/Y');
		$tglsebelum = date('m/d/Y', strtotime($interval, strtotime($tglskrg)));
		$tglset = $tglsebelum . ' - ' . $tglskrg;
		session()->set(['tanggalkeluar' => $tglset]);
		// dd(session()->get('tanggalkeluar'));
		$tabel = $this->modelbarang->tampilbkeluarg();
		// dd($jenis);
		$data = [
			'title' => 'LAPORAN BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/laporan/bkeluar',
		];
		return view('/laporan/bkeluar', $data);
	}
	public function viewbkeluarhist()
	{
		$tabel = $this->modelbarang->tampilhistkeluar();
		// dd($jenis);
		$data = [
			'title' => 'HISTORI BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/histbkeluar',
		];
		return view('/laporan/histori_bkeluar', $data);
	}
	public function viewbmasuktgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tampilbmasuktgl($awal, $akhir);
		$data = [
			'title' => 'LAPORAN BARANG MASUK',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/bmasuktgl', $data);
	}
	public function viewsohisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistso($awal, $akhir);
		$data = [
			'title' => 'LAPORAN STOK OPNAME',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_so', $data);
	}
	public function viewpbkeluarhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistpbkeluar($awal, $akhir);
		$data = [
			'title' => 'LAPORAN PERMINTAAN BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_pbkeluar', $data);
	}
	public function viewpemesananhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistpemesanan($awal, $akhir);
		$data = [
			'title' => 'LAPORAN pemesanan',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_pemesanan', $data);
	}
	public function viewpermintaanhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistpermintaan($awal, $akhir);
		$data = [
			'title' => 'LAPORAN permintaan',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_permintaan', $data);
	}
	public function viewpenyesuaianhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistpenyesuaian($awal, $akhir);
		$data = [
			'title' => 'HISTORI TINDAKAN PENYESUAIAN',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_penyesuaian', $data);
	}
	public function viewbmasukhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistmasuk($awal, $akhir);
		$data = [
			'title' => 'LAPORAN BARANG MASUK',
			'tabel' => $tabel,
			'link' => '/laporan/bmasuk',
		];
		return view('/laporan/histori_bmasuk', $data);
	}
	public function viewbkeluarhisttgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalkeluar' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tglhistkeluar($awal, $akhir);
		// dd($jenis);
		$data = [
			'title' => 'HISTORI BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/laporan/bkeluar',
		];
		return view('/laporan/histori_bkeluar', $data);
	}
	public function viewbkeluartgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalkeluar' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$varawal = $tgl[0];
		$varakhir = $tgl[1];
		$tabel = $this->modelbarang->tampilbkeluartgl($awal, $akhir);
		// dd($jenis);
		$data = [
			'title' => 'LAPORAN BARANG KELUAR',
			'tabel' => $tabel,
			'link' => '/laporan/bkeluar',
		];
		return view('/laporan/bkeluartgl', $data);
		// dd($tgl);
	}
	public function cetakbkeluar()
	{
		//select between
		$tanggal = session()->get('tanggalkeluar');
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tampilbkeluartgl($awal, $akhir);
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Keluar";
		$awallap = $pecahawal[1] . "-" . $pecahawal[0] . "-" . $pecahawal[2];
		$akhirlap = $pecahakhir[1] . "-" . $pecahakhir[0] . "-" . $pecahakhir[2];
		$rangetgl = $awallap . " s/d " . $akhirlap;
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $tabel,
			'range' => $rangetgl,
			'link' => '/laporan/bkeluar',
		];
		return view('/berkas/berkasbkeluar', $data);
	}
	public function cetakbmasuk()
	{
		//select between
		$tanggal = session()->get('tanggalmasuk');
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		// dd($pecahakhir);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tampilbmasuktgl($awal, $akhir);
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Masuk";
		$awallap = $pecahawal[1] . "-" . $pecahawal[0] . "-" . $pecahawal[2];
		$akhirlap = $pecahakhir[1] . "-" . $pecahakhir[0] . "-" . $pecahakhir[2];
		$rangetgl = $awallap . " s/d " . $akhirlap;
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $tabel,
			'range' => $rangetgl,
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkasbmasuk', $data);
	}
	public function cetakbarang()
	{
		//select between
		$tabel = $this->modelbarang->tampilbarang();
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Stok Barang";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $tabel,
			'link' => '/laporan/barang',
		];
		return view('/berkas/berkasbarang', $data);
	}
	public function historibmasuk($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Masuk";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histmasuk($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoribmasuk', $data);
	}
	public function historibkeluar($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Keluar";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histkeluar($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoribkeluar', $data);
	}
	public function historiso($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Keluar";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histso($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoriso', $data);
	}
	public function historipenyesuaian($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Barang Keluar";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histpenyesuaian($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoripenyesuaian', $data);
	}
	public function historipbkeluar($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan Permintaan Barang keluar";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histpbkeluar($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkaspbkeluar', $data);
	}
	public function historipemesanan($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan pemesanan";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histpemesanan($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoripemesanan', $data);
	}
	public function historipermintaan($id)
	{
		// konversi
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "Laporan permintaan";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->modelbarang->histpermintaan($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoripermintaan', $data);
	}
}
