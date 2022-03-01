<?php

namespace App\Controllers;

use App\Models\modpbkeluar;
use mysqli;
use PDO;

class conpbkeluar extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul;
	protected $judul_disetujui;
	protected $judul_belum_disetujui;

	public function __construct()
	{
		$this->model = new modpbkeluar();
		$this->base_link = '/pbkeluar';
		$this->judul = 'PERMINTAAN BARANG KELUAR';
		$this->judul_disetujui = 'DETAIL PERMINTAAN BARANG KELUAR DISETUJUI';
		$this->judul_belum_disetujui = 'DETAIL PERMINTAAN BARANG KELUAR';
	}
	public function view()
	{
		$data = [
			'title' => $this->judul,
			'table_data' => $this->model->tampil(),
			'kondisi' => $this->model->kondisi(),
			'link' => $this->base_link
		];
		return view('/pbkeluar/pbkeluar', $data);
	}
	public function detail_pbkeluar_acc($id)
	{
		$data = [
			'title' => $this->judul_disetujui,
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];

		return view('/pbkeluar/detail_pbkeluar_acc', $data);
	}
	public function detail_pbkeluar($id)
	{
		$data_detail = $this->model->tampil_detail($id);
		$id_det = $data_detail[0]['id_pbkeluar'];
		$data = [
			'title' => $this->judul_belum_disetujui,
			'id_pbkeluar' => $id_det,
			'data_barang' => $this->model->data_barang(),
			'data_pbkeluar' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		session()->set([
			'id_pbkeluar' => $id,
		]);
		return view('/pbkeluar/detail_pbkeluar_non_acc', $data);
	}
	public function tambah_item_detail()
	{
		$redirect_link = 'lihat/' . $this->request->getVar('id_pbkeluar');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "BRGK-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$stok = $id_brg[3];

		if ($jml > $stok) {
			$kekurangan = $jml - $stok;
			$jumlah = $stok;
		} else {
			$kekurangan = 0;
			$jumlah = $jml;
		}

		$data = [
			'id_detpbkeluar' => $set_id_detail,
			'id_pbkeluar' => $this->request->getVar('id_pbkeluar'),
			'id_barang' => $id_brg[0],
			'jumlah' => $jumlah,
			'Kekurangan' => $kekurangan
		];
		$this->model->insert_data_detail($data);
		return redirect()->to($redirect_link);
	}
	public function hapus_detail($id)
	{
		$data = [
			'id_detpbkeluar' => $id,
		];
		$this->model->delete_data_detail($data);
		echo "<Script>history.go(-1);</script>";
	}
	public function tambah_pbkeluar()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data = [
			'title' => $this->judul,
			'data_barang' => $this->model->data_barang(),
			'data_dump' => $this->model->tampil_dump(),
			'link' => $this->base_link
		];
		return view('/pbkeluar/draftrencana', $data);
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id pbkeluar
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_pbkeluar = $this->model->count_data_pbkeluar($id_sekarang);
		if ($cek_id_pbkeluar > 0) {
			$max = $this->model->get_data_pbkeluar($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_pbkeluar']);
			$no_belakang = $no[2] + 1;
			$set_id = "TRK-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "TRK-" . $id_sekarang . "-1";
		}
		//end generate

		//generate id auto untuk detail
		$id_det = date('ymdHis'); //201120
		// dd($id_det);
		$set_id_detail = "BRGK-" . $id_det;
		//end generate

		session()->set([
			'id_pbkeluar' => $set_id,
		]);

		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$stok = $id_brg[3];
		if ($jml > $stok) {
			$kekurangan = $jml - $stok;
			$jumlah = $stok;
		} else {
			$kekurangan = 0;
			$jumlah = $jml;
		}
		$data = [
			'id_detpbkeluar' => $set_id_detail,
			'id_pbkeluar' => session()->get('id_pbkeluar'),
			'id_barang' => $id_brg[0],
			'jumlah' => $jumlah,
			'Kekurangan' => $kekurangan
		];
		$this->model->insert_data_dump($data);
		return redirect()->to('/pbkeluar/tambah-pbkeluar');
	}
	public function simpan_draft()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_tanggal = date('d-m-Y');
		$data = [
			'id_pbkeluar' => session()->get('id_pbkeluar'),
			'user' => session()->get('namauser'),
			'status' => 'belum',
		];
		// dd($data);
		$this->model->insert_pbkeluar($data);
		$this->model->pindah_dump();
		$this->model->delete_dump();
		return redirect()->to($this->base_link);
	}
	public function update_pbkeluar($id)
	{
		return redirect()->to($this->base_link);
	}
	public function hapus_dump($id)
	{
		$data = [
			'id_detpbkeluar' => $id
		];
		$this->model->delete_data_dump($data);
		return redirect()->to('/pbkeluar/tambah-pbkeluar');
	}
	public function setuju($id)
	{
		$id_pbkeluar = [
			'id_pbkeluar' => $id
		];
		$data = [
			'status' => 'disetujui',
		];
		$this->model->setuju($data, $id_pbkeluar);
		return redirect()->to($this->base_link);
	}
	public function hapus($id)
	{
		$data = [
			'id_pbkeluar' => $id
		];
		$this->model->hapus($data);
		$this->model->hapus_detail($data);
		return redirect()->to($this->base_link);
	}
	public function updateitem($id)
	{
		$idbrg = $this->request->getVar('idbrg');
		$barang = $this->model->tampil_jum_barang($idbrg);
		$jml = $this->request->getVar('jumlah');
		foreach ($barang as $barr) {
			$stok = $barr['stok'];
		}

		// dd($jml);
		if ($jml > $stok) {
			$kekurangan = $jml - $stok;
			$jumlah = $stok;
		} else {
			$kekurangan = 0;
			$jumlah = $jml;
		}
		$data = [
			'jumlah' => $jumlah,
			'kekurangan' => $kekurangan
		];
		$where = [
			'id_detpbkeluar' => $id,
		];
		$this->model->updateitem($data, $where);
		$path = '/pbkeluar/lihat/' . session()->get('id_pbkeluar');
		return redirect()->to($path);
	}
	public function updateitemrencana($id)
	{
		$idbrg = $this->request->getVar('idbrg');
		$barang = $this->model->tampil_jum_barang($idbrg);
		$jml = $this->request->getVar('jumlah');
		foreach ($barang as $barr) {
			$stok = $barr['stok'];
		}

		// dd($jml);
		if ($jml > $stok) {
			$kekurangan = $jml - $stok;
			$jumlah = $stok;
		} else {
			$kekurangan = 0;
			$jumlah = $jml;
		}
		$data = [
			'jumlah' => $jumlah,
			'kekurangan' => $kekurangan
		];
		$where = [
			'id_detpbkeluar' => $id,
		];
		$this->model->updateitemrencana($data, $where);
		$path = '/pbkeluar/tambah-pbkeluar';
		return redirect()->to($path);
	}
	//--------------------------------------------------------------------
	public function cetakbkeluar($id)
	{
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
		$judul = "DAFTAR BARANG KELUAR";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->model->tampil_detail($id),
			'link' => $this->base_link,
			'user' => session()->get('namauser')
		];
		return view('/berkas/berkaspbkeluar', $data);
	}
}
