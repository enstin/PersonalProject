<?php

namespace App\Controllers;

use \App\Models\modreturpesan;
use mysqli;
use PDO;

class conreturpesan extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modreturpesan();
		$this->base_link = '/retpesan';
	}
	public function viewretur()
	{
		$data = [
			'title' => 'RETUR PEMESANAN',
			'table_data' => $this->model->tampilpemesanan(),
			'table_terima' => $this->model->tampil_terima_retur(),
			'link' => $this->base_link
		];

		return view('/retur_pesan/retur', $data);
	}
	public function viewaja($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_retpesan = $this->model->count_retesan($id_sekarang);
		if ($cek_id_retpesan > 0) {
			$max = $this->model->get_id_retesan($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_retpesan']);
			$no_belakang = $no[2] + 1;
			if ($no_belakang <= 9) {
				$set_id = "RPEM-" . $id_sekarang . "-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "RPEM-" . $id_sekarang . "-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "RPEM-" . $id_sekarang . "-" . $no_belakang;
			}
		} else {
			$set_id = "RPEM-" . $id_sekarang . "-001";
		}
		session()->set([
			'id_retpesan' => $set_id,
		]);
		session()->set([
			'id_pesan' => $id,
		]);
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'table_dump' => $this->model->tampildump(),
			'data_option' => $this->model->tampildetpemesanan($id),
			'link' => $this->base_link
		];
		return view('/retur_pesan/draft_retur', $data);
	}
	public function simpan_transaksi()
	{
		$id = session()->get('id_retpesan');
		$cekdump = $this->model->transaksiretur_2($id);
		if ($cekdump > 0) {
			$insertdata = $this->model->transaksiretur_1($id);
			// dd($insertdata);
			foreach ($insertdata as $masuk) {
				if ($masuk['convert'] == 'con1') {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_base' => $masuk['stok_base'] - $masuk['jumlah_retur']
					];
					$this->model->updatestok($data_stok, $id_detbarang);
				} elseif ($masuk['convert'] == 'con2') {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_base' => $masuk['stok_con1'] - $masuk['jumlah_retur']
					];
					$this->model->updatestok($data_stok, $id_detbarang);
				} elseif ($masuk['convert'] == 'con3') {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_base' => $masuk['stok_con1'] - $masuk['jumlah_retur']
					];
					$this->model->updatestok($data_stok, $id_detbarang);
				}
			};
			// dd($insertdata);
			$data = [
				'id_retpesan' => session()->get('id_retpesan'),
				'id_user' => session()->get('id_user'),
				'status' => 'sedang di retur'
			];
			$data_update = [
				'status' => 'sudah dilakukan retur'
			];
			$id_update = [
				'id_pesan' => session()->get('id_pesan')
			];
			$this->model->ubah_status_pesan($data_update, $id_update);
			$this->model->simpan_retpesan($data);
			$this->model->pindah_dump_retpesan();
			$this->model->delete_dump_retpesan();
			return redirect()->to('/retpesan');
		} else {
			$id_retpesan = session()->get('id_pesan');
			echo session()->setFlashdata('pesan', 'mohon isikan item yang akan diretur');
			return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
		}
	}
	public function viewterima($id)
	{
		session()->set([
			'id_retpesan' => $id,
		]);
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'table_data' => $this->model->transaksiretur($id),
			'link' => $this->base_link
		];
		return view('/retur_pesan/draft_retur_masuk', $data);
	}
	public function tambah_dump_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "DPEM-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$id_retpesan = session()->get('id_pesan');
		$id_retpesanex = explode("-", $id_retpesan);
		$id_retpesantrue = 'RPES-' . $id_retpesan[1];
		if ($id_brg[0] == NULL) {
			echo session()->setFlashdata('pesan', 'silahkan pilih barang yang ingin diretur terlbih dahulu');
			return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
		} else {
			$data = [
				'id_detretpesan' => $set_id_detail,
				'id_detpesan' => $id_brg[1],
				'id_retpesan' => session()->get('id_retpesan'),
				'jumlah' =>  $this->request->getVar('jml_ret'),
				'keterangan' => $this->request->getvar('ket'),
				'convert' => 'con1',
			];
			$cek = $this->model->cek_barang($id_brg[0]);
			if ($cek > 0) {
				echo session()->setFlashdata('pesan', 'Barang sudah pernah ditambahkan');
				return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
			} else {
				$cek_jumlah = $this->model->cek_jumlah($id_brg[1]);
				$jumlah_input = $this->request->getVar('jml_ret');
				// dd($cek_jumlah[0]['jumlah']);
				if ($jumlah_input > $cek_jumlah[0]['jumlah']) {
					echo session()->setFlashdata('pesan', 'Jumlah barang yang diretur tidak boleh melebihi jumlah pemesanan');
					return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
				} elseif ($jumlah_input < 1) {
					echo session()->setFlashdata('pesan', 'Jumlah barang yang diretur tidak boleh kurang dari 1');
					return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
				} else {
					echo session()->setFlashdata('pesan1', 'Barang berhasil ditambahkan');
					$this->model->tambah_dump_item($data);
					return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
				}
			}
		}
	}

	public function delete_dump_item($id)
	{
		$id_del = [
			'id_detretpesan' => $id
		];
		$this->model->hapus_dump_item($id_del);
		$id_retpesan = session()->get('id_pesan');
		return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
	}
	public function edit_dump_item($id)
	{
		$data = [
			'jumlah' => $this->request->getVar('jumlah_update')
		];
		$idd = [
			'id_detretpesan' => $id
		];

		$id_retpesan = session()->get('id_pesan');
		$cek_jumlah = $this->model->cek_jumlah_edit($id);
		$jumlah_input = $this->request->getVar('jumlah_update');
		// dd($cek_jumlah[0]['jumlah']);
		foreach ($cek_jumlah as $update) {
			if ($jumlah_input > $update['jumlah']) {
				echo session()->setFlashdata('pesan', 'Jumlah barang yang diretur tidak boleh melebihi jumlah pemesanan');
				return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
			} elseif ($jumlah_input < 1) {
				echo session()->setFlashdata('pesan', 'Jumlah barang yang diretur tidak boleh kurang dari 1');
				return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
			} else {
				$this->model->edit_dump_item($data, $idd);
				echo session()->setFlashdata('pesan1', 'Barang berhasil ditambahkan');
				return redirect()->to('/retpesan/draftretur/' . $id_retpesan);
			}
		}
		// dd($id);
	}


	public function terima_retur()
	{
		$id = session()->get('id_retpesan');
		$insertdata = $this->model->transaksiretur($id);
		foreach ($insertdata as $masuk) {
			if ($masuk['convert'] == 'con1') {
				$id_detbarang = [
					'id_detbarang' => $masuk['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_base'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_detbarang);
			} elseif ($masuk['convert'] == 'con2') {
				$id_detbarang = [
					'id_detbarang' => $masuk['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_detbarang);
			} elseif ($masuk['convert'] == 'con3') {
				$id_detbarang = [
					'id_detbarang' => $masuk['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $masuk['stok_con1'] + $masuk['jumlah_retur']
				];
				$this->model->updatestok($data_stok, $id_detbarang);
			}
		};
		$data_status = [
			'status' => 'sudah diterima'
		];
		$id_status = [
			'id_retpesan' => $id,
		];
		$this->model->updatestatus($data_status, $id_status);
		return redirect()->to('/retpesan');
		// dd($insertdata);
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
			$no = explode("-", $get_id['id_pemesanan']);
			$no_belakang = $no[2] + 1;
			$set_id = "BMS-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "BMS-" . $id_sekarang . "-1";
		}
		//end generate
		session()->set([
			'id_bmasuk' => $set_id,
		]);
		$id = session()->get('id_pesan');
		$insertdata = $this->model->transaksimasuk($id);
		foreach ($insertdata as $masuk) {
			$id_det = $masuk['id_detpesan'];
			$id_detexplode = explode("-", $id_det);
			$id_dettrue = 'DBM-' . $id_detexplode[1];
			$datadetbmasuk = [
				'id_detbmasuk' => $id_dettrue,
				'id_detbarang' => $masuk['id_detbarang'],
				'id_masuk' => $set_id,
				'jumlah' => $masuk['jumlah']
			];
			$this->model->prosesdetbmasuk($datadetbmasuk);
			if ($masuk['convert'] == 'con1') {
				if ($masuk['stok_base'] == 0) {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_base' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				} else {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_base' => $masuk['jumlah'] + $masuk['stok_base']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				}
			} elseif ($masuk['convert'] == 'con2') {
				if ($masuk['stok_con1'] == 0) {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_con1' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				} else {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_con1' => $masuk['jumlah'] + $masuk['stok_con1']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				}
			} elseif ($masuk['convert'] == 'con3') {
				if ($masuk['stok_con2'] == 0) {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_con2' => $masuk['jumlah']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				} else {
					$id_detbarang = [
						'id_detbarang' => $masuk['id_detbarang']
					];
					$data_stok = [
						'stok_con2' => $masuk['jumlah'] + $masuk['stok_con2']
					];
					$this->model->masukstok($data_stok, $id_detbarang);
				}
			}
		};
		$data = [
			'id_bmasuk' => $set_id,
			'id_user' => session()->get('id_user'),
		];
		$this->model->prosesbmasuk($data);
		$data_status = [
			'status' => 'sudah dimasukan',
		];
		$id_pesan = [
			'id_pesan' => $id,
		];
		$this->model->update_status_pemesanan($data_status, $id_pesan);
		return redirect()->to('/bmasuk');
	}
}
