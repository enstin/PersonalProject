<?php

namespace App\Controllers;

use \App\Models\modlaporan;
use mysqli;
use mysqli_result;
use PDO;

class conlaporan extends BaseController
{
	protected $modelbarang;
	// protected $db;
	public function __construct()
	{
		$this->modelbarang = new modlaporan();
	}
	public function viewkmasuk()
	{
		//02/04/2021 - 02/04/2021
		$interval = '-' . 7 . 'day';
		date_default_timezone_set('Asia/Jakarta');
		$tglskrg = date('m/d/Y');
		$tglsebelum = date('Y-m-d', strtotime($interval, strtotime($tglskrg)));
		$tglset = $tglsebelum . ' - ' . $tglskrg;
		session()->set(['tanggalmasuk' => $tglset]);

		$data = [
			'title' => 'LAPORAN KAYU MASUK',
			'link' => '/laporan/kmasuk',
		];
		return view('/laporan/kmasuk', $data);
	}
	public function viewkmasuktgl()
	{
		$tanggal = $this->request->getVar('tgl');
		session()->set(['tanggalmasuk' => $tanggal]);
		// dd($tanggal);
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel =$this->modelbarang->tampilkmasuktgl($awal, $akhir);
		// dd($tabel);
		$data = [
			'title' => 'LAPORAN KAYU MASUK',
			'tabel' => $tabel,
			'link' => '/laporan/kmasuk',
		];
		return view('/laporan/kmasuktgl', $data);
	}
	public function cetakkmasuk()
	{
		//select between
		$tanggal = session()->get('tanggalmasuk');
		$tgl = explode(" - ", $tanggal);
		$pecahawal = explode("/", $tgl[0]);
		$pecahakhir = explode("/", $tgl[1]);
		// dd($pecahakhir);
		$awal = $pecahawal[2] . "-" . $pecahawal[0] . "-" . $pecahawal[1];
		$akhir = $pecahakhir[2] . "-" . $pecahakhir[0] . "-" . $pecahakhir[1];
		$tabel = $this->modelbarang->tampilkmasuktgl($awal, $akhir);
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
		$judul = "Laporan Kayu Masuk";
		$awallap = $pecahawal[1] . "-" . $pecahawal[0] . "-" . $pecahawal[2];
		$akhirlap = $pecahakhir[1] . "-" . $pecahakhir[0] . "-" . $pecahakhir[2];
		$rangetgl = $awallap . " s/d " . $akhirlap;
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $tabel,
			'range' => $rangetgl,
			'link' => '/laporan/kmasuk',
		];
		return view('/laporan/berkaskmasuk', $data);
	}

}
