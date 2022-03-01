<?php

namespace App\Controllers;

use \App\Models\modreturminta;
use mysqli;
use PDO;

class conreturminta extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modreturminta();
		$this->base_link = '/retminta';
	}
	public function viewretur()
	{
		$data = [
			'title' => 'RETUR permintaan',
			'table_data' => $this->model->tampilpermintaan(),
			'table_terima' => $this->model->tampil_terima_retur(),
			'link' => $this->base_link
		];

		return view('/retur_minta/retur', $data);
	}
	public function viewaja($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_retminta = $this->model->count_retesan($id_sekarang);
		if ($cek_id_retminta > 0) {
			$max = $this->model->get_id_retesan($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_retminta']);
			$no_belakang = $no[2] + 1;
			$set_id = "RPEM-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "RPEM-" . $id_sekarang . "-1";
		}
		session()->set([
			'id_retminta' => $set_id,
		]);
		session()->set([
			'id_minta' => $id,
		]);
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'table_dump' => $this->model->tampildump(),
			'data_option' => $this->model->tampildetpermintaan($id),
			'link' => $this->base_link
		];
		return view('/retur_minta/draft_retur', $data);
	}
	public function viewterima($id)
	{
		session()->set([
			'id_retminta' => $id,
		]);
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'table_data' => $this->model->transaksiretur($id),
			'link' => $this->base_link
		];
		return view('/retur_minta/draft_retur_masuk', $data);
	}
	public function tambah_dump_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "DPEM-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$id_retminta = session()->get('id_minta');
		$id_retmintaex = explode("-", $id_retminta);
		$id_retmintatrue = 'RPES-' . $id_retminta[1];
		$data = [
			'id_detretminta' => $set_id_detail,
			'id_detminta' => $id_brg[1],
			'id_retminta' => session()->get('id_retminta'),
			'jumlah' =>  $this->request->getVar('jml_ret'),
			'convert' => 'con1',
		];
		$cek = $this->model->cek_barang($id_brg[0]);
		if ($cek > 0) {
			echo session()->setFlashdata('minta', 'Barang sudah pernah ditambahkan');
			return redirect()->to('/retminta/draftretur/' . $id_retminta);
		} else {
			$cek_jumlah = $this->model->cek_jumlah($id_brg[0]);
			$jumlah_input = $this->request->getVar('jml_ret');
			if ($jumlah_input > $cek_jumlah[0]['jumlah']) {
				echo session()->setFlashdata('minta', 'Jumlah barang yang diretur tidak boleh melebihi jumlah permintaan');
				return redirect()->to('/retminta/draftretur/' . $id_retminta);
			} else {
				echo session()->setFlashdata('minta1', 'Barang berhasil ditambahkan');
				$this->model->tambah_dump_item($data);
				return redirect()->to('/retminta/draftretur/' . $id_retminta);
			}
		}
	}

	public function delete_dump_item($id)
	{
		$id_del = [
			'id_detretminta' => $id
		];
		$this->model->hapus_dump_item($id_del);
		$id_retminta = session()->get('id_minta');
		return redirect()->to('/retminta/draftretur/' . $id_retminta);
	}
	public function edit_dump_item($id)
	{
		$data = [
			'jumlah' => $this->request->getVar('jumlah_update')
		];
		$id = [
			'id_detretminta' => $id
		];
		$this->model->edit_dump_item($data, $id);
		$id_retminta = session()->get('id_minta');
		return redirect()->to('/retminta/draftretur/' . $id_retminta);
	}

	public function simpan_transaksi()
	{
		$id = session()->get('id_minta');
		$insertdata = $this->model->transaksiretur($id);
		foreach ($insertdata as $masuk) {
			if ($masuk['convert'] == 'con1') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_base'] - $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			} elseif ($masuk['convert'] == 'con2') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] - $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			} elseif ($masuk['convert'] == 'con3') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] - $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			}
		};

		$data = [
			'id_retminta' => session()->get('id_retminta'),
			'id_user' => 'user1',
			'status' => 'sedang di retur'
		];
		$data_update = [
			'status' => 'sudah dilakukan retur'
		];
		$id_update = [
			'id_minta' => session()->get('id_minta')
		];
		$this->model->ubah_status_minta($data_update, $id_update);
		$this->model->simpan_retminta($data);
		$this->model->pindah_dump_retminta();
		$this->model->delete_dump_retminta();
		return redirect()->to('/retminta');
	}
	public function terima_retur()
	{
		$id = session()->get('id_retminta');
		$insertdata = $this->model->transaksiretur($id);
		foreach ($insertdata as $masuk) {
			if ($masuk['convert'] == 'con1') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_base'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			} elseif ($masuk['convert'] == 'con2') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			} elseif ($masuk['convert'] == 'con3') {
				$id_barang = [
					'id_barang' => $masuk['id_barang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_barang);
			}
		};
		$data_status = [
			'status' => 'sudah diterima'
		];
		$id_status = [
			'id_retminta' => $id,
		];
		$this->model->updatestatus($data_status, $id_status);
		return redirect()->to('/retminta');
	}








	public function prosesmasuk()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_bmasuk = $this->model->countbmasuk($id_sekarang);
		if ($cek_id_bmasuk > 0) {
			$max = $this->model->select_idbmasuk($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_permintaan']);
			$no_belakang = $no[2] + 1;
			$set_id = "BMS-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "BMS-" . $id_sekarang . "-1";
		}
		//end generate
		session()->set([
			'id_bmasuk' => $set_id,
		]);
		$id = session()->get('id_minta');
		$insertdata = $this->model->transaksimasuk($id);
		foreach ($insertdata as $masuk) {
			$id_det = $masuk['id_detminta'];
			$id_detexplode = explode("-", $id_det);
			$id_dettrue = 'DBM-' . $id_detexplode[1];
			$datadetbmasuk = [
				'id_detbmasuk' => $id_dettrue,
				'id_barang' => $masuk['id_barang'],
				'id_masuk' => $set_id,
				'jumlah' => $masuk['jumlah']
			];
			$this->model->prosesdetbmasuk($datadetbmasuk);
			if ($masuk['convert'] == 'con1') {
				if ($masuk['stok_base'] == 0) {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_base' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_barang);
				} else {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_base' => $masuk['jumlah'] + $masuk['stok_base']
					];
					$this->model->masukstok($data_stok, $id_barang);
				}
			} elseif ($masuk['convert'] == 'con2') {
				if ($masuk['stok_con1'] == 0) {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_con1' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_barang);
				} else {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_con1' => $masuk['jumlah'] + $masuk['stok_con1']
					];
					$this->model->masukstok($data_stok, $id_barang);
				}
			} elseif ($masuk['convert'] == 'con3') {
				if ($masuk['stok_con2'] == 0) {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_con2' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_barang);
				} else {
					$id_barang = [
						'id_barang' => $masuk['id_barang']
					];
					$data_stok = [
						'stok_con2' => $masuk['jumlah'] + $masuk['stok_con2']
					];
					$this->model->masukstok($data_stok, $id_barang);
				}
			}
		};
		$data = [
			'id_bmasuk' => $set_id,
			'id_user' => 'user1',
		];
		$this->model->prosesbmasuk($data);
		$data_status = [
			'status' => 'sudah dimasukan',
		];
		$id_minta = [
			'id_minta' => $id,
		];
		$this->model->update_status_permintaan($data_status, $id_minta);
		return redirect()->to('/bmasuk');
	}
}
