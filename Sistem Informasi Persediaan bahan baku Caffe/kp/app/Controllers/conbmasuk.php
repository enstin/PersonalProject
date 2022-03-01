<?php

namespace App\Controllers;

use App\Models\modbmasuk;
use mysqli;
use PDO;

class conbmasuk extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modbmasuk();
		$this->base_link = '/bmasuk';
	}
	public function view()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'table_data' => $this->model->tampil(),
			'table_histori' => $this->model->tampil_histori(),
			'link' => $this->base_link
		];
		$this->model->delete_dump();
		return view('/bmasuk/bmasuk', $data);
	}

	public function viewtrans()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'table_data' => $this->model->tampil_dump(),
			'data_brg' => $this->model->tampil_barang(),
			'link' => $this->base_link
		];
		return view('/bmasuk/draftbmasuk', $data);
	}
	public function gotrans($id)
	{

		//ambil data belanja yg disetujui
		$data_bel = $this->model->get_data_belanja($id);
		foreach ($data_bel as $data_belanja) {
			session()->set(['id_trasnbel' => $data_belanja['id_belanja']]);
			// define expired
			$var = $this->model->get_expired($data_belanja['id_barang']);
			$interval = '+' . $var[0]['lama_expired'] . 'day';
			$now = date('Y-m-d');
			$expired = date('Y-m-d', strtotime($interval, strtotime($now)));
			//  end expired
			//subtotal
			$sub_total = $data_belanja['jumlah'] * $data_belanja['harga'];
			$data = [
				'id_detbmasuk' => $data_belanja['id_detbel'],
				'id_bmasuk' => $data_belanja['id_belanja'],
				'id_barang' => $data_belanja['id_barang'],
				'ex_date' => $expired,
				'jumlah' => $data_belanja['jumlah'],
				'sisa' => $data_belanja['jumlah'],
				'keluar' => 0,
				'harga_asli' => $data_belanja['harga'],
				'sub_total' => $sub_total,
			];
			$this->model->insert_dump_detbmasuk($data);
		}
		// var_dump($data_bel);
		return redirect()->to('/bmasuk/draft');
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$sub_total = $jml * $id_brg[1];

		// define expired
		$var = $this->model->get_expired($id_brg[0]);
		foreach ($var as $p) {
		}
		$interval = '+' . $p['lama_expired'] . 'day';
		$now = date('m/d/Y');
		$expired = date('m/d/Y', strtotime($interval, strtotime($now)));
		//  end expired
		$det = "BRGM-" . date('ymdHis');
		$data = [
			'id_detbmasuk' => $det,
			'id_bmasuk' => $this->request->getVar('id_bmasuk'),
			'id_barang' => $id_brg[0],
			'ex_date' => $expired,
			'jumlah' => $this->request->getVar('jumlah'),
			'sisa'	=> $this->request->getVar('jumlah'),
			'keluar' => 0,
			'sub_total' => $sub_total
		];
		$this->model->insert_dump_detbmasuk($data);
		return redirect()->to('/bmasuk/draft');
		// return redirect()->to('/bmasuk/draftbmasuk');
	}
	public function simpan_draft($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_tanggal = date('d-m-Y');
		// dd($id_sekarang);
		$sum = $this->model->sum_sub_total_dump();
		foreach ($sum as $total) {
		}
		$dum = $this->model->tampil_dump();

		foreach ($dum as $jum) {
			$idbrg = $jum['id_barang'];
			$idbar = [
				'id_barang' => $idbrg
			];

			$jumlahdum = $this->model->tampiloperasi($idbrg);
			foreach ($jumlahdum as $jumdum) {
			}
			$jumlah = $jum['stok'] + $jumdum['total'];
			$jujuju = [
				'stok' => $jumlah,
			];
			$this->model->updatestok($jujuju, $idbar);
		}
		$data = [
			'id_bmasuk' => $id,
			'total' => $total['sub_total'],
		];
		// dd($data);
		$this->model->pindah_dump();
		$this->model->pindah_fifo();
		$this->model->insert_bmasuk($data);
		$id_belanja = [
			'id_belanja' => $id,
		];
		$status_belanja = [
			'status' => 'dimasukan',
		];
		$this->model->ubah_status($status_belanja, $id_belanja);
		return redirect()->to('/bmasuk');
	}
	public function ubah_draft($id)
	{
		$data = [
			'jumlah' => $this->request->getVar('jumlah'),
			'sisa' => $this->request->getVar('jumlah'),
			'harga_asli' => $this->request->getVar('harga_asli'),
		];
		$where = [
			'id_detbmasuk' => $id
		];

		$this->model->ubah_draft($data, $where);
		return redirect()->to('/bmasuk/draft');
	}
	public function hapus_draft($id)
	{
		$where = [
			'id_detbmasuk' => $id,
		];

		$this->model->hapus_draft($where);
		return redirect()->to('/bmasuk/draft');
	}
}
