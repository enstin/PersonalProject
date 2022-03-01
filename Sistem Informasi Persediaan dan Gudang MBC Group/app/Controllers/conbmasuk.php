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
	public function viewbmasuk()
	{
		$cekdata = $this->model->cekdata();
		foreach ($cekdata as $cekcok) {
			$data__id = $cekcok['id_detbarang'];
			$dataexplode = explode('-', $data__id);
			if ($dataexplode[6] == 'g1') {
				$id_kel = [
					'id_detbmasuk' => $cekcok['id_detbmasuk']
				];
				$this->model->hapus_item($id_kel);
			} else {
			}
		}
		$kondisibase = [
			'id_gudang' => 'g1',
			'id_user' => null
		];
		$this->model->hapus_base($kondisibase);
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_det = date('ymdHis'); //201120
		$set_id = "BMS-" . $id_det;
		//end generate
		session()->set([
			'id_masuk_g1' => $set_id,
		]);
		$dataa = [
			'id_bmasuk' => $set_id,
			'id_gudang' => 'g1'
		];
		$this->model->prosesbmasuk($dataa);
		$data = [
			'title' => 'BARANG MASUK',
			'table_data' => $this->model->tampilpemesanan(),
			'table_minta' => $this->model->tampilpermintaan(),
			'link' => $this->base_link
		];
		return view('/bmasuk/bmasuk', $data);
	}
	public function viewdetbmasuk($id)
	{
		session()->set([
			'id_pesan' => $id,
		]);
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'table_data' => $this->model->tampildetpemesanan($id),
			'link' => $this->base_link
		];
		return view('/bmasuk/draftbmasuk', $data);
	}
	public function viewmasukminta($id)
	{
		session()->set([
			'id_permintaan_g1' => $id,
		]);
		$data = [
			'title' => 'DRAFT PERMINTAAN MASUK',
			'table_data' => $this->model->tampilpermintaanselect($id),
			'link' => $this->base_link
		];
		return view('/bmasuk/draftbmasuk_minta', $data);
	}

	public function prosesmasuk_permintaan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id = "BM-" . $id_det;
		//end generate
		session()->set([
			'id_masuk_g1' => $set_id,
		]);
		$id = session()->get('id_permintaan_g1');
		$insertdata = $this->model->transaksimasuk_minta($id);
		foreach ($insertdata as $masuk) {
			$id_explode = explode('-', $masuk['id_detbarang']);
			$id_detbarang = $id_explode[0] . '-' . $id_explode[1] . '-' . $id_explode[2] . '-' . $id_explode[3] . '-' . $id_explode[4] . '-' . $id_explode[5] . '-g1';
			$id_det = $masuk['id_detpermintaan'];
			$id_detexplode = explode("-", $id_det);
			$id_dettrue = 'DBM-' . $id_detexplode[1];
			$datadetbmasuk = [
				'id_detbmasuk' => $id_dettrue,
				'id_detbarang' => $id_detbarang,
				'id_masuk' => $set_id,
				'jumlah' => $masuk['jumlah']
			];
			$this->model->prosesdetbmasuk($datadetbmasuk);
			$trans = $this->model->transaksibarang($id_detbarang);
			foreach ($trans as $barangcek) {
				if ($masuk['convert'] == 'con1') {
					if ($barangcek['stok_base'] == 0) {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_base' => $masuk['jumlah']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
					} else {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_base' => $masuk['jumlah'] + $barangcek['stok_base']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
						// dd('2');
						// die;
					}
				} elseif ($masuk['convert'] == 'con2') {
					if ($barangcek['stok_con1'] == 0) {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_con1' => $masuk['jumlah']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
					} else {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_con1' => $masuk['jumlah'] + $barangcek['stok_con1']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
					}
				} elseif ($masuk['convert'] == 'con3') {
					if ($barangcek['stok_con2'] == 0) {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_con2' => $masuk['jumlah']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
					} else {
						$id_detbarang = [
							'id_detbarang' => $id_detbarang
						];
						$data_stok = [
							'stok_con2' => $masuk['jumlah'] + $barangcek['stok_con2']
						];
						$this->model->masukstok($data_stok, $id_detbarang);
					}
				}
			}
		};
		$data = [
			'id_bmasuk' => $set_id,
			'id_user' => session()->get('id_user'),
			'id_gudang' => 'g1'
		];
		$this->model->prosesbmasuk($data);
		$data_status = [
			'status' => 'sudah dimasukan',
		];
		$id_pesan = [
			'id_permintaan' => $id,
		];
		$this->model->update_status_permintaan($data_status, $id_pesan);
		return redirect()->to('/bmasuk');
		// dd($data_stok);
	}
	public function prosesmasuk()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id = "DBM-" . $id_det;
		//end generate
		session()->set([
			'id_masuk_g1' => $set_id,
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
			// $id_detbarang = $masuk['id_detbarang'];
			// $konversi_stok = $this->model->panggilstok($id_detbarang);
			// foreach ($konversi_stok as $convert_stok) {
			// 	if ($convert_stok['stok_con2'] % $convert_stok['cr3'] > 0) {
			// 		$stok_con2_masuk = $convert_stok['stok_con2'] % $convert_stok['cr3'];
			// 		$stok_con1_masuk = ($convert_stok - $stok_con2_masuk) / $convert_stok['cr2'];
			// 		if ($stok_con1_masuk % $convert_stok['cr2'] > 0) {
			// 			$stok_base_masuk = $stok_con1_masuk % $convert_stok['cr2'];
			// 		}
			// 	}
			// 	$stok_base_update = $masuk['stok_base'] + $stok_base_masuk;
			// 	$stok_con1_update = $masuk['stok_con1'] + $stok_con1_masuk;
			// 	$stok_con2_update = $masuk['stok_con2'] + $stok_con2_masuk;
			// 	$data_update_stok_barang = [
			// 		'stok_base' => $stok_base_update,
			// 		'stok_con1' => $stok_con1_update,
			// 		'stok_con2' => $stok_con2_update,
			// 	];
			// 	$id_update_stok_barang = [
			// 		'id_detbarang' => $id_detbarang,
			// 	];
			// 	$this->model->masukstok($data_update_stok_barang, $id_update_stok_barang);
			// };
		};
		$data = [
			'id_bmasuk' => $set_id,
			'id_user' => session()->get('id_user'),
			'id_gudang' => 'g1'
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

	public function viewtrans()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'table_dump' => $this->model->tampildump(),
			'option_barang' => $this->model->tampiloption(),
			'link' => $this->base_link
		];
		return view('/bmasuk/tambah_draftbmasuk', $data);
	}

	public function prosesmasuk_non()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id = session()->get('id_masuk_g1');
		$insertdata = $this->model->transaksimasuk_non();
		foreach ($insertdata as $masuk) {
			$id_explode = explode('-', $masuk['id_detbarang']);
			$id_detbarang = $id_explode[0] . '-' . $id_explode[1] . '-' . $id_explode[2] . '-' . $id_explode[3] . '-' . $id_explode[4] . '-g2';
			$datadetbmasuk = [
				'id_detbmasuk' => $masuk['id_detbmasuk'],
				'id_detbarang' => $masuk['id_detbarang'],
				'id_masuk' => $id,
				'convert' => $masuk['convert'],
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
			'id_user' => session()->get('id_user'),
		];
		$idd = [
			'id_bmasuk' => session()->get('id_masuk_g1'),
		];
		// dd($stok_con1_masuk);
		$this->model->updatemasuk($data, $idd);
		return redirect()->to('/bmasuk');
	}

	public function tambah_dump_item()
	{
		$id_detbarang = $this->request->getVar('brg');
		$akeh = $this->request->getVar('satuan');
		$conval =  explode("|", $akeh);
		$convert = $conval[0];
		$stok_base = $conval[1];
		$stok_con1 = $conval[2];
		$stok_con2 = $conval[3];
		$maximal = $conval[4];
		$satuan = $conval[5];
		$jumlah = $this->request->getVar('jumlah');
		$cek_dump = $this->model->cek_dump($id_detbarang, $convert);
		if ($cek_dump > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah diinputkan dengan satuan tersebut');
			return redirect()->to('/bmasuk/tambah_draftbmasuk');
		} else {
			if ($convert == 'con1') {
				date_default_timezone_set('Asia/Jakarta');
				$id_det = date('ymdHis'); //201120
				$set_id_detail = "BDM-" . $id_det;
				$brg = $this->request->getVar('brg');
				$id_brg = explode("|", $brg);
				$data = [
					'id_detbmasuk' => $set_id_detail,
					'id_detbarang' => $id_brg[0],
					'id_masuk' => session()->get('id_masuk_g1'),
					'jumlah' => $jumlah,
					'convert' => $convert
				];
				$this->model->tambah_dump_item($data);
				return redirect()->to('/bmasuk/tambah_draftbmasuk');
			} elseif ($convert == 'con2') {
				date_default_timezone_set('Asia/Jakarta');
				$id_det = date('ymdHis'); //201120
				$set_id_detail = "BDM-" . $id_det;
				$brg = $this->request->getVar('brg');
				$id_brg = explode("|", $brg);
				$data = [
					'id_detbmasuk' => $set_id_detail,
					'id_detbarang' => $id_brg[0],
					'id_masuk' => session()->get('id_masuk_g1'),
					'jumlah' => $jumlah,
					'convert' => $convert
				];
				$this->model->tambah_dump_item($data);
				return redirect()->to('/bmasuk/tambah_draftbmasuk');
			} elseif ($convert == 'con3') {
				date_default_timezone_set('Asia/Jakarta');
				$id_det = date('ymdHis'); //201120
				$set_id_detail = "BDM-" . $id_det;
				$brg = $this->request->getVar('brg');
				$id_brg = explode("|", $brg);
				$data = [
					'id_detbmasuk' => $set_id_detail,
					'id_detbarang' => $id_brg[0],
					'id_masuk' => session()->get('id_masuk_g1'),
					'jumlah' => $jumlah,
					'convert' => $convert
				];
				$this->model->tambah_dump_item($data);
				return redirect()->to('/bmasuk/tambah_draftbmasuk');
			}
		}
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
			$idbrg = $jum['id_detbarang'];
			$idbar = [
				'id_detbarang' => $idbrg
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
			'id_gudang' => 'g1'
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
		$sub_total = $this->request->getVar('jumlah') * $this->request->getVar('harga_asli');
		$data = [
			'jumlah' => $this->request->getVar('jumlah'),
			'sisa' => $this->request->getVar('jumlah'),
			'harga_asli' => $this->request->getVar('harga_asli'),
			'sub_total' => $sub_total
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
	public function get_satuan()
	{
		$idbarang = $this->request->getPost("id");
		$opt = $this->model->optionsat($idbarang);
		foreach ($opt as $o) {
			if ($o['satuan1']) echo "<option value='con1|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|0|{$o['satuan1']}''>{$o['satuan1']}</option>";
			if ($o['satuan2']) echo "<option value='con2|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|{$o['cr2']}|{$o['satuan2']}''>{$o['satuan2']}</option>";
			if ($o['satuan3']) echo "<option value='con3|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|{$o['cr3']}|{$o['satuan3']}''>{$o['satuan3']}</option>";
		}
	}
	public function hapus_item($id)
	{
		$id_kel = [
			'id_detbmasuk' => $id
		];
		$this->model->hapus_item($id_kel);
		return redirect()->to('/bmasuk/tambah_draftbmasuk');
	}
	public function update_item($id)
	{
		$id_mas = [
			'id_detbmasuk' => $id
		];
		$data = [
			'jumlah' => $this->request->getVar('jumlah_update')
		];
		$this->model->dump_update_item($data, $id_mas);
		return redirect()->to('/bmasuk/tambah_draftbmasuk');
	}
}
