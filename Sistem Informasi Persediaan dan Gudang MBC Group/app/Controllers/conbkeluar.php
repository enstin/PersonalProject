<?php

namespace App\Controllers;

use App\Models\modbkeluar;
use CodeIgniter\HTTP\Request;
use Config\Database;
use mysqli;
use PDO;

class conbkeluar extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul;

	public function __construct()
	{
		$this->model = new modbkeluar();
		$this->base_link = '/bkeluar';
		$this->judul = 'BARANG KELUAR';
	}
	public function view()
	{
		$cekdata = $this->model->cekdata();
		foreach ($cekdata as $cekcok) {
			$data__id = $cekcok['id_detbarang'];
			$dataexplode = explode('-', $data__id);
			if ($dataexplode[6] == 'g1') {
				$id_kel = [
					'id_detbkeluar' => $cekcok['id_detbkeluar']
				];
				$this->model->hapus_item($id_kel);
			} else {
			}
		}
		$kondisibkluar = [
			'id_gudang' => 'g1',
			'id_user' => null
		];
		$this->model->hapus_bkeluar($kondisibkluar);
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_bkeluar = $this->model->countbkeluar($id_sekarang);
		if ($cek_id_bkeluar > 0) {
			$max = $this->model->select_idbkeluar($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_bkeluar']);
			$no_belakang = $no[2] + 1;
			$set_id = "BK-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "BK-" . $id_sekarang . "-1";
		}
		//end generate
		session()->set([
			'id_bkeluar_g1' => $set_id,
		]);
		$data = [
			'id_bkeluar' => $set_id,
			'id_gudang' => 'g1'
		];
		$this->model->prosesbkeluar($data);
		$data = [
			'title' => $this->judul,
			'table_histori' => $this->model->tampilhistori(),
			'link' => $this->base_link
		];
		// $this->model->delete_dump();
		return view('/bkeluar/bkeluar', $data);
	}
	public function viewdraft()
	{
		// dd(session()->get('id_bkeluar_g1'));
		$data = [
			'title' => $this->judul,
			'table_dump' => $this->model->tampildump(),
			'option_barang' => $this->model->tampiloption(),
			'link' => $this->base_link
		];
		return view('/bkeluar/draftbkeluar', $data);
	}

	public function proseskeluar()
	{
		$id 		= session()->get('id_detbkeluar');
		$id_bkeluar = session()->get('id_bkeluar_g1');
		$insertdata = $this->model->transaksikeluar($id);
		$databarang 	= [];

		foreach ($insertdata as $barang) {
			//Cek data barang di array
			if (!in_array($barang['id_detbarang'], $databarang)) {
				$databarang[$barang['id_detbarang']] 	= $this->model->getstokbarang($barang['id_barang'], $barang['id_brand']);
			}
		}
		$temp 	= $databarang;

		$sah 	= 1;



		foreach ($insertdata as $keluar) {
			$id_detbarang 	= $keluar['id_detbarang'];
			$konversi 		= $this->model->konversi($keluar['id_cr']);
			$stok 			= $databarang[$id_detbarang];
			if ($keluar['convert'] == 'con1') {
				// ================================================ CR 1 ===============================================
				$stok 	= $stok['stok_base'];
				if ($stok > $keluar['jumlah']) {
					$databarang[$id_detbarang]['stok_base'] -= $keluar['jumlah'];
					$this->updateStok($keluar['id_detbarang'], $stok - $keluar['jumlah'], 'stok_base');
				} else {
					$sah = 0;
					break;
				}
			} else if ($keluar['convert'] == 'con2') {
				// ================================================ CR 2 ===============================================
				$stok_rim 			= $stok['stok_con1'];
				$pass 				= false;
				if ((int)$stok_rim < (int)$keluar['jumlah']) {
					$stok_kardus 	= $stok['stok_base'];
					if ($stok_kardus) {
						//Cek apakah masih ada rim kalo ada cari kekurangannya di kardus
						// jumlahkeluar - stok rim || 10 - 4 = 6 <- kekurangan
						//Cari butuh berapa kardus
						$selisih 		= $keluar['jumlah'] - $stok_rim;
						$nilaiKonversi 	= $konversi['cr2'];
						$butuh 			= $this->hitungSelisih($selisih, (int)$nilaiKonversi);

						if ($butuh > $stok_kardus) {
							$sah = 0;
							break;
						} else {
							// ex : rubah dari kardus -> rim
							$stokUpdate 	= $butuh * $nilaiKonversi;
							$databarang[$id_detbarang]['stok_base'] -= $butuh;
							$databarang[$id_detbarang]['stok_con1'] += $stokUpdate;
							$stokAwalC1 	= $databarang[$id_detbarang]['stok_base'];
							$stokAwalC2 	= $databarang[$id_detbarang]['stok_con1'];
							$this->updateStok($keluar['id_detbarang'], $stokAwalC1, 'stok_base');
							$this->updateStok($keluar['id_detbarang'], $stokAwalC2, 'stok_con1');
							$pass = true;
						}
					}
				}
				if ($stok_rim >= $keluar['jumlah'] || $pass) {
					$stokRimUpdate 	= $databarang[$id_detbarang]['stok_con1'];

					$databarang[$id_detbarang]['stok_con1'] -= $keluar['jumlah'];
					$this->updateStok($keluar['id_detbarang'], $stokRimUpdate - $keluar['jumlah'], 'stok_con1');
					$pass 			= false;
				}
			} else if ($keluar['convert'] == 'con3') {
				// ================================================ CR 3 ===============================================
				$stok_lembar 		= $stok['stok_con2'];
				$pass = false;
				if ($stok_lembar < $keluar['jumlah']) {
					//konversi
					//Cek rim
					// 1 == 500
					$stok_rim 		= $stok['stok_con1'];
					$selisih 		= $keluar['jumlah'] - $stok_lembar;
					$nilaiKonversi 	= $konversi['cr3'];
					$butuh 			= $this->hitungSelisih($selisih, (int)$nilaiKonversi);
					if ($butuh < $stok_rim) {
						//konversi dari cr2 ke cr3
						// ex : rubah dari kardus -> rim
						$stokUpdate 	= $butuh * $nilaiKonversi;
						$databarang[$id_detbarang]['stok_con1'] -= $butuh;
						$databarang[$id_detbarang]['stok_con2'] += $stokUpdate;
						$stokAwalC1 	= $databarang[$id_detbarang]['stok_con1'];
						$stokAwalC2 	= $databarang[$id_detbarang]['stok_con2'];
						$this->updateStok($keluar['id_detbarang'], $stokAwalC1, 'stok_con1');
						$this->updateStok($keluar['id_detbarang'], $stokAwalC2, 'stok_con2');
						$pass = true;
					} else {
						//koversi dari cr1 ke cr2 ke cr3
						$stok_kardus 	= $stok['stok_base'];

						//Hitung konversi cr1 ke cr2
						$selisih 			= $butuh - $stok_rim;

						$butuhCr2 			= $this->hitungSelisih($selisih, (int)$konversi['cr2']);
						if ($butuhCr2 > $stok_kardus) {
							$sah = 0;
							break;
						} else {
							// ex : rubah dari kardus -> rim
							$stokUpdate 	= $butuhCr2 * (int)$konversi['cr2'];
							$databarang[$id_detbarang]['stok_base'] -= $butuhCr2;
							$databarang[$id_detbarang]['stok_con1'] += $stokUpdate;
							$stokAwalC1 	= $databarang[$id_detbarang]['stok_base'];
							$stokAwalC2 	= $databarang[$id_detbarang]['stok_con1'];
							$this->updateStok($keluar['id_detbarang'], $stokAwalC1, 'stok_base');
							$this->updateStok($keluar['id_detbarang'], $stokAwalC2, 'stok_con1');

							$stokUpdate 	= $stok_lembar + $butuh * $nilaiKonversi;
							$databarang[$id_detbarang]['stok_con1'] -= $butuh;
							$databarang[$id_detbarang]['stok_con2'] += $stokUpdate;
							$stokAwalC1 	= $databarang[$id_detbarang]['stok_con1'];
							$stokAwalC2 	= $databarang[$id_detbarang]['stok_con2'];
							$this->updateStok($keluar['id_detbarang'], $stokAwalC1, 'stok_con1');
							$this->updateStok($keluar['id_detbarang'], $stokAwalC2, 'stok_con2');
							$pass = true;
						}
					}
				}

				if ($stok_lembar >= $keluar['jumlah'] || $pass) {
					$stokLembarUpdate = $databarang[$id_detbarang]['stok_con2'];
					$databarang[$id_detbarang]['stok_con2'] -= $keluar['jumlah'];
					$this->updateStok($keluar['id_detbarang'], $stokLembarUpdate - $keluar['jumlah'], 'stok_con2');
					$pass 		= false;
				}
			}
		}

		$data_stok = [
			'stok_base' => 0,
			'stok_con1' => 0,
			'stok_con2' => 0
		];

		if (!$sah) {
			foreach ($temp as $key => $t) {
				$data_stok['stok_base'] = $t['stok_base'];
				$data_stok["stok_con1"] = $t['stok_con1'];
				$data_stok["stok_con2"] = $t['stok_con2'];

				$id_detbarang = [
					'id_detbarang' => $key
				];

				$this->model->keluarstok($data_stok, $id_detbarang);
			}
			echo session()->setFlashdata('pesan', 'TOTAL ITEM LEBIH DARI STOK SAAT INI');
			return redirect()->to('/bkeluar/draftbkeluar');
			//session salah
		} else {
			$dataup = [
				'id_user' => session()->get('id_user')
			];
			$idup = [
				'id_bkeluar' => session()->get('id_bkeluar_g1')
			];
			$this->model->updatebkeluar($dataup, $idup);
			$this->model->pindah_dump($id_bkeluar);
			return redirect()->to('/bkeluar');
		}
	}


	private function updateStok($id_detbarang, $stok_base, $stok)
	{
		$id_detbarang = [
			'id_detbarang' => $id_detbarang
		];
		$data_stok = [
			$stok => $stok_base
		];
		$this->model->keluarstok($data_stok, $id_detbarang);
	}

	private function hitungSelisih($butuh, $nilaiKonversi)
	{
		$hasilKonversi = 1;
		$loop = true;
		while ($loop) {
			if (($hasilKonversi * $nilaiKonversi) >= $butuh) {
				$loop = false;
			} else {
				$hasilKonversi++;
			}
		}
		return $hasilKonversi;
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
	// public function get_satuan()
	// {
	// 	$idbarang = $this->request->getPost("id");
	// 	$opt = $this->model->optionsat($idbarang);
	// 	foreach ($opt as $o) {
	// 		if ($o['satuan1']) echo "<option value='con1''>{$o['satuan1']}</option>";
	// 		if ($o['satuan2']) echo "<option value='con2''>{$o['satuan2']}</option>";
	// 		if ($o['satuan3']) echo "<option value='con3''>{$o['satuan3']}</option>";
	// 	}
	// }
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
		$tujuan = session()->get('tujuan');

		if ($cek_dump > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah diinputkan dengan satuan tersebut');
			return redirect()->to('/bkeluar/draftbkeluar');
		} else {
			if ($convert == 'con1') {
				if ($stok_base < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/bkeluar/draftbkeluar');
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			} elseif ($convert == 'con2') {
				if ($jumlah > $stok_con1 && $stok_base < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah <= $stok_con1) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $stok_con1 && $jumlah <= $stok_con1 + $maximal && $stok_base > 0) {

					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '1'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $stok_con1 + $maximal) {
					echo session()->setFlashdata('pesan', 'Mohon isikan sesuai aturan yang berlaku');
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			} elseif ($convert == 'con3') {
				if ($jumlah > $stok_con2 && $stok_base < 1 && $stok_con1 < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah <= $stok_con2) {

					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $stok_con2 && $stok_con1 > 0 && $jumlah <= $stok_con2 + $maximal) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $stok_con2 && $jumlah <= $stok_con2 + $maximal && $stok_con2 < 1 && $stok_base > 0) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $stok_con2 + $maximal) {
					echo session()->setFlashdata('pesan', 'Mohon isikan sesuai aturan yang berlaku');
					return redirect()->to('/bkeluar/draftbkeluar');
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DKEL-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detbkeluar' => $set_id_detail,
						'id_detbarang' => $id_brg[0],
						'id_bkeluar' => session()->get('id_bkeluar_g1'),
						'jumlah' => $jumlah,
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			}
			// dd($cek_dump);
		}
	}
	public function hapus_item($id)
	{
		$id_kel = [
			'id_detbkeluar' => $id
		];
		$this->model->hapus_item($id_kel);
		return redirect()->to('/bkeluar/draftbkeluar');
	}
	public function update_item($id)
	{
		$tabel = $this->model->tampilbkeluarwhere($id);
		$jumlah = $this->request->getVar('jumlah_update');
		// dd($tabel);
		foreach ($tabel as $detbkeluar) {
			if ($detbkeluar['convert'] == 'con1') {
				if ($detbkeluar['stok_base'] < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/bkeluar/draftbkeluar');
				} else {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update')
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			} elseif ($detbkeluar['convert'] == 'con2') {

				if ($jumlah <= $detbkeluar['stok_con1']) {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con1'] && $jumlah <= $detbkeluar['stok_con1'] + $detbkeluar['cr2'] && $detbkeluar['stok_base'] > 0) {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con1'] && $detbkeluar['stok_base'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detbkeluar['stok_con1'] . '+' .  $detbkeluar['cr2'] . '&&' . $detbkeluar['stok_base'] . '< 1');
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con1'] + $detbkeluar['cr2']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			} elseif ($detbkeluar['convert'] == 'con3') {

				if ($jumlah <= $detbkeluar['stok_con2']) {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con2'] && $detbkeluar['stok_con1'] > 0 && $jumlah <= $detbkeluar['stok_con2'] + $detbkeluar['cr3']) {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '2'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con2'] && $jumlah <= $detbkeluar['stok_con2'] + $detbkeluar['cr3'] && $detbkeluar['stok_con2'] < 1 && $detbkeluar['stok_base'] > 0) {

					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con2'] && $detbkeluar['stok_base'] < 1 && $detbkeluar['stok_con1'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detbkeluar['stok_con1'] . '+' . $detbkeluar['cr3'] . '&&' . $detbkeluar['stok_base'] . '< 1');
					return redirect()->to('/bkeluar/draftbkeluar');
				} elseif ($jumlah > $detbkeluar['stok_con2'] + $detbkeluar['cr3']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/bkeluar/draftbkeluar');
				} else {
					$id_mas = [
						'id_detbkeluar' => $id
					];
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$this->model->dump_update_item($data, $id_mas);
					return redirect()->to('/bkeluar/draftbkeluar');
				}
			}
		}
	}
}
