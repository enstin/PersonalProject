<?php

namespace App\Controllers;

use App\Models\modso;
use mysqli;
use PDO;

class conso extends BaseController
{

	protected $model;
	protected $base_link;

	public function __construct()
	{
		$this->model = new modso();
		$this->base_link = '/so';
		$this->judul = 'STOK OPNAME';
		$this->juduldraft = 'DRAFT STOK OPNAME';
	}
	public function view()
	{
		$data = [
			'title' => $this->judul,
			'table_data' => $this->model->view(),
			'link' => $this->base_link
		];
		return view('/so/so', $data);
	}
	public function tambahso()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data = [
			'title' => $this->juduldraft,
			'data_barang' => $this->model->data_barang(),
			'data_dump' => $this->model->tampil_dump(),
			'link' => $this->base_link
		];
		return view('/so/draftso', $data);
	}

	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_belanja = $this->model->count_data_so($id_sekarang);
		if ($cek_id_belanja > 0) {
			$max = $this->model->get_data_so($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_so']);
			$no_belakang = $no[2] + 1;
			$set_id = "SO-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "SO-" . $id_sekarang . "-1";
		}
		//end generate

		//generate id auto untuk detail
		$id_det = date('ymdHis'); //201120
		// dd($id_det);
		$set_id_detail = "BRGSO-" . $id_det;
		//end generate

		session()->set([
			'id_so' => $set_id,
		]);
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$selisih = $jml - $id_brg[3];
		$status = 'a';
		if ($selisih > 0) {
			$status = 'Lebih';
		} elseif ($selisih < 0) {
			$status = 'kurang';
		} else {
			$status = 'Sesuai';
		}
		$data = [
			'id_detso' => $set_id_detail,
			'id_barang' => $id_brg[0],
			'id_so' => session()->get('id_so'),
			'jml_stok' => $id_brg[3],
			'jml_so' => $this->request->getVar('jumlah'),
			'status' => $status,
			'selisih' => $selisih,
		];
		$this->model->insert_data($data);
		return redirect()->to('/so/tambah-so');
	}
	public function hapus_dump($id)
	{
		$data = [
			'id_detso' => $id
		];
		$this->model->delete_data_dump($data);
		return redirect()->to('/so/tambah-so');
	}
	public function simpan_draft()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_tanggal = date('m/d/Y');
		// dd($id_sekarang);

		$data = [
			'id_so' => session()->get('id_so'),
			'status' => 'belum',
		];
		$this->model->insert_so($data);
		$this->model->pindah_dump();
		$this->model->delete_dump();
		return redirect()->to($this->base_link);
	}
	public function detail_so($id)
	{
		$data = [
			'title' => $this->juduldraft,
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		return view('/so/detail_so_lihat', $data);
	}
}
