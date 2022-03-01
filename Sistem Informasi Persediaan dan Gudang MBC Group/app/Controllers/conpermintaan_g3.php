<?php

namespace App\Controllers;

use App\Models\modpermintaan_g3;
use mysqli;
use PDO;

class conpermintaan_g3 extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul_permintaan;
	protected $judul_permintaan_disetujui;
	protected $judul_permintaan_belum_disetujui;

	public function __construct()
	{
		$this->model = new modpermintaan_g3();
		$this->base_link = '/permintaan_g3';
		$this->judul_permintaan = 'permintaan';
		$this->judul_permintaan_disetujui = 'DETAIL permintaan TERSETUJUI';
		$this->judul_permintaan_belum_disetujui = 'DETAIL permintaan';
	}

	public function viewpermintaan()
	{
		$cektabel = $this->model->selectdelete();
		foreach ($cektabel as $kosong) {
			$id_kosong = $kosong['id_permintaan'];
			$this->model->delete_dump_minta($id_kosong);
		}
		foreach ($cektabel as $kosong) {
			$id_kosong = $kosong['id_permintaan'];
			$this->model->delete_minta($id_kosong);
		}
		$cektabel_lihat = $this->model->tampilpermintaan_delete_lihat();
		foreach ($cektabel_lihat as $delete_lihat) {
			$id_delete = $delete_lihat['id_permintaan'];
			$this->model->delete_dump_minta($id_delete);
		}

		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_minta = $this->model->count_data_permintaan($id_sekarang);
		if ($cek_id_minta > 0) {
			$max = $this->model->get_data_permintaan($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_permintaan']);
			$no_belakang = $no[2] + 1;
			if ($no_belakang <= 9) {
				$set_id = "PER-" . $id_sekarang . "-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "PER-" . $id_sekarang . "-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "PER-" . $id_sekarang . "-" . $no_belakang;
			}
		} else {
			$set_id = "PER-" . $id_sekarang . "-001";
		}
		//end generate
		session()->set([
			'id_permintaan_g3' => $set_id,
		]);
		session()->set([
			'tujuan' => 'g1',
		]);
		$data_insert = [
			'id_permintaan' => session()->get('id_permintaan_g3'),
			'id_user' => session()->get('id_user'),
			'asal' => 'g3',
			'tujuan' => session()->get('tujuan'),
			// 'status' => 'belum disetujui-g1',
			'status' => 'kosong',
		];
		// dd($data);
		$id_segment = session()->get('id_permintaan_g3');
		$this->model->simpan_draft_permintaan($data_insert);

		$data = [
			'title' => $this->judul_permintaan,
			'table_data' => $this->model->tampilpermintaan_nonacc_tambah(),
			'table_terima' => $this->model->tampilpermintaan_nonacc_terima(),
			'table_request' => $this->model->tampilpermintaan_nonacc_request(),
			'link' => $this->base_link
		];
		return view('/permintaan/permintaan', $data);
	}
	public function viewdraftpermintaan()
	{
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildumpdetpermintaan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link
		];
		return view('/permintaan/draftpermintaan', $data);
	}
	public function viewdraftpermintaanpil()
	{
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildumpdetpermintaan(),
			'option_barangseleksi' => $this->model->optionsatuanexcept(session()->get('id_detbarang')),
			'option_barangbukanseleksi' => $this->model->optionsatuanwhere(session()->get('id_detbarang')),
			'link' => $this->base_link

		];
		return view('/permintaan/draftpermintaanpil', $data);
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
		$tujuan = session()->get('tujuan');
		if ($cek_dump > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah diinputkan dengan satuan tersebut');
			return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
		} else {
			if ($convert == 'con1') {
				if ($stok_base < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			} elseif ($convert == 'con2') {
				if ($jumlah > $stok_con1 + $maximal) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah <= $stok_con1) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $stok_con1 && $jumlah <= $stok_con1 + $maximal && $stok_base > 0) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $stok_con1 && $stok_base < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			} elseif ($convert == 'con3') {
				if ($jumlah > $stok_con2 + $maximal) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah <= $stok_con2) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $stok_con2 && $stok_con1 > 0 && $jumlah <= $stok_con2 + $maximal) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $stok_con2 && $jumlah <= $stok_con2 + $maximal && $stok_con2 < 1 && $stok_base > 0) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $stok_con2 && $stok_base < 1 && $stok_con1 < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			}
			// dd($cek_dump);
		}
	}
	public function hapus_dump_item($id)
	{
		$data = [
			'id_detpermintaan' => $id,
		];
		$this->model->hapus_dump_item($data);
		$tujuan = session()->get('tujuan');
		return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
	}
	public function update_dump_item($id)
	{
		$tabel = $this->model->tampilpermintaanwhere($id);
		$jumlah = $this->request->getVar('jumlah_update');
		$tujuan = session()->get('tujuan');
		// dd($tabel);
		foreach ($tabel as $detpermintaan) {
			if ($detpermintaan['convert'] == 'con1') {
				if ($detpermintaan['stok_base'] < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} else {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			} elseif ($detpermintaan['convert'] == 'con2') {
				if ($jumlah > $detpermintaan['stok_con1'] + $detpermintaan['cr2']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah <= $detpermintaan['stok_con1']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $detpermintaan['stok_con1'] && $jumlah <= $detpermintaan['stok_con1'] + $detpermintaan['cr2'] && $detpermintaan['stok_base'] > 0) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $detpermintaan['stok_con1'] && $detpermintaan['stok_base'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detpermintaan['stok_con1'] . '+' .  $detpermintaan['cr2'] . '&&' . $detpermintaan['stok_base'] . '< 1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			} elseif ($detpermintaan['convert'] == 'con3') {
				if ($jumlah > $detpermintaan['stok_con2'] + $detpermintaan['cr3']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah <= $detpermintaan['stok_con2']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $detpermintaan['stok_con1'] > 0 && $jumlah <= $detpermintaan['stok_con2'] + $detpermintaan['cr3']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $jumlah <= $detpermintaan['stok_con2'] + $detpermintaan['cr3'] && $detpermintaan['stok_con2'] < 1 && $detpermintaan['stok_base'] > 0) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $detpermintaan['stok_base'] < 1 && $detpermintaan['stok_con1'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detpermintaan['stok_con1'] . '+' . $detpermintaan['cr3'] . '&&' . $detpermintaan['stok_base'] . '< 1');
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				} else {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
				}
			}
		}
	}

	public function simpendraft()
	{
		$id_permintaan = session()->get('id_permintaan_g3');
		$data = [
			'status' => 'Diajukan-g3',
		];
		$id = [
			'id_permintaan' => session()->get('id_permintaan_g3'),
		];
		$iddd = session()->get('id_permintaan_g3');
		$cekdumpisi = $this->model->cek_dumpisi($iddd);
		if ($cekdumpisi > 0) {
			$permintaan 		= $this->model->getAllPermitaan($id_permintaan);
			$detailbarang 		= [];
			foreach ($permintaan as $p) {
				$id_detbarang 	= $p['id_detbarang'];
				$tempBarang 	= $this->model->getbarang($id_detbarang);

				if (!in_array($id_detbarang, $detailbarang)) $detailbarang[$id_detbarang] = $tempBarang;
			}

			$sah = 0;
			foreach ($permintaan as $p) {
				$id_detbarang 	= $p['id_detbarang'];
				$idkonversi 	= $detailbarang[$id_detbarang]['id_cr'];
				$convert		= $p['convert'];
				$jumlah 		= $p['jumlah']; // Jumlah permintaan dari gudang
				$konversi 		= $this->model->getCr($idkonversi);

				$stok_base 		= $detailbarang[$id_detbarang]['stok_base']; // Stok barang digudang
				$stok_con1 		= $detailbarang[$id_detbarang]['stok_con1'];
				$stok_con2 		= $detailbarang[$id_detbarang]['stok_con2'];

				if ($convert == "con1") {
					if ($jumlah > $stok_base) {
						$sah = 1;
						break;
					}
					$detailbarang[$id_detbarang]['stok_base'] -= $jumlah;
				} else if ($convert == "con2") {
					if ($stok_con1 < $jumlah) {
						//Cek stok base
						$selisih 			= $jumlah - $stok_con1;
						$nilaiKonversi 		= $konversi['cr2'];
						$butuh 				= $this->hitungSelisih($selisih, $nilaiKonversi);
						if ($butuh > $stok_base) {
							echo 'barang salah';
							$sah = 1;
							break;
						} else {
							$stokUpdate 	= $butuh * $nilaiKonversi;
							$detailbarang[$id_detbarang]['stok_base'] -= $butuh;
							$detailbarang[$id_detbarang]['stok_con1'] += $stokUpdate - $jumlah;
						}
					} else 	$detailbarang[$id_detbarang]['stok_con1'] -= $jumlah;
				} else {
					if ($stok_con2 < $jumlah) {
						//cek selisih ke cr2 
						//Cek stok base
						$selisih 			= $jumlah - $stok_con1;
						$nilaiKonversi 		= $konversi['cr3'];
						$butuh 				= $this->hitungSelisih($selisih, $nilaiKonversi);
						if ($butuh > $stok_con1) {
							// cek stok stok_base
							$nilaiKonversiCon1 	= $konversi['cr2'];
							$butuhCon1 			= $this->hitungSelisih($selisih, $nilaiKonversi);

							if ($butuhCon1 <= $stok_base) {
								$stokUpdateCon1 	= $butuh * $nilaiKonversiCon1;
								$detailbarang[$id_detbarang]['stok_con1'] += $stokUpdateCon1;
								$detailbarang[$id_detbarang]['stok_base'] -= $butuhCon1;

								$stokUpdate = $butuh * $nilaiKonversi;
								$detailbarang[$id_detbarang]['stok_con2'] += $stokUpdate - $jumlah;
								$detailbarang[$id_detbarang]['stok_con1'] -= $butuh;
							} else {
								$sah = 1;
								break;
							}
						} else $detailbarang[$id_detbarang]['stok_con2'] -= $jumlah;
					}
				}
			}


			if ($sah) {
				echo session()->setFlashdata('pesan', 'Total barang ada yang melebihi stok saat ini di gudang tujuan');
				return redirect()->to('/permintaan_g2/go_tambah_permintaan/');
				//Jika tidak memenuhi stok
			} else {
				$this->model->update_status($data, $id);
				$this->model->delete_permintaan_nonacc($id_permintaan);
				$this->model->pindah_dump_minta($id_permintaan);
				$this->model->delete_dump_minta($id_permintaan);
				return redirect()->to('/permintaan_g3');
			}
		} else {
			echo session()->setFlashdata('pesan', 'silahkan isikan barang terlebih dahulu');
			return redirect()->to('/permintaan_g3/go_tambah_permintaan/');
		}
	}
public function viewpermintaan_lihat($id)
	{
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->lihatpermintaan($id),
			'link' => $this->base_link
		];
		return view('/permintaan/draftpermintaan_lihat', $data);
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


	public function viewdraftpermintaan_nonacc($id_permintaan)
	{
		session()->set([
			'id_permintaan' => $id_permintaan,
		]);
		$this->model->pindah_dump_nonacc($id_permintaan);
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildumpdetpermintaan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link

		];
		return view('/permintaan/detail_permintaan_non_acc', $data);
	}
	public function viewdraftpermintaan_nonacc_tambah()
	{
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildumpdetpermintaan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link

		];
		return view('/permintaan/detail_permintaan_non_acc', $data);
	}
	public function simpendraft_nonacc()
	{
		$id_permintaan = session()->get('id_permintaan_g3');
		// dd($id_permintaan);
		$this->model->delete_permintaan_nonacc($id_permintaan);
		$data = [
			'id_permintaan' => session()->get('id_permintaan_g3'),
			'id_user' => session()->get('id_user'),
			'asal' => 'g3',
			'tujuan' => session()->get('tujuan'),
			'status' => 'belum disetujui-g3',
		];
		// dd($data);
		$this->model->pindah_dump_pesan();
		$this->model->delete_dump_pesan();
		return redirect()->to('/permintaan_g3');
	}

	//pemilik
	public function setujui($id)
	{
		$id_pesan = [
			'id_permintaan' => $id
		];
		$data = [
			'status' => 'Diajukan-g3',
		];
		$this->model->update_status($data, $id_pesan);
		return redirect()->to('/permintaan_g3');
	}
	public function akan_dikirim($id)
	{
		$id_pesan = [
			'id_permintaan' => $id
		];
		$data = [
			'status' => 'akan dikirim-g3',
		];
		$this->model->update_status($data, $id_pesan);
		return redirect()->to('/permintaan_g3');
	}
	public function dikirim($id)
	{
		session()->set([
			'id_kirim' => $id,
		]);

		$insertdata = $this->model->kirim($id);
		foreach ($insertdata as $keluar) {
			if ($keluar['convert'] == 'con1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['stok_con1'] + $keluar['cr2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con2' => $keluar['stok_con2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '1-2') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['cr2'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '2') {

				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			}
		};
		// dd($insertdata);
		return redirect()->to('/permintaan_g3/kirim_2/' . $id);
	}
	public function dikirim_2($id)
	{

		$insertdata = $this->model->kirim_2($id);
		foreach ($insertdata as $ubah) {
			if ($ubah['pengurangan'] == '1' && ($ubah['stok_con1'] > 0)) {
				$dataupdate = [
					'pengurangan' => '0'
				];
				$idupdate = [
					'id_detpermintaan' => $ubah['id_detpermintaan']
				];
				$this->model->ubahdetpermintaan($dataupdate, $idupdate);
			} else {
			}
		};
		foreach ($insertdata as $keluar) {
			if ($keluar['convert'] == 'con1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['stok_con1'] + $keluar['cr2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con2' => $keluar['stok_con2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '1-2') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['cr2'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '2') {

				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			}
		};
		$insertdata2 = $this->model->kirim_3($id);
		foreach ($insertdata2 as $ubah) {
			if ($ubah['pengurangan'] == '1-2' && ($ubah['stok_con1'] > 0)) {
				$dataupdate = [
					'pengurangan' => '2'
				];
				$idupdate = [
					'id_detpermintaan' => $ubah['id_detpermintaan']
				];
				$this->model->ubahdetpermintaan($dataupdate, $idupdate);
			} else {
			}
		};

		// dd($insertdata);
		return redirect()->to('/permintaan_g3/kirim_3/' . $id);
	}
	public function dikirim_3($id)
	{
		$id_pesan = [
			'id_permintaan' => $id
		];
		$data = [
			'status' => 'dikirim-g3',
		];
		$this->model->update_status($data, $id_pesan);

		$insertdata = $this->model->kirim_3($id);
		foreach ($insertdata as $keluar) {
			if ($keluar['convert'] == 'con1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con2' && $keluar['pengurangan'] == '1') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['stok_con1'] + $keluar['cr2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '0') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con2' => $keluar['stok_con2'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '1-2') {
				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_base' => $keluar['stok_base'] - 1,
					'stok_con1' => $keluar['cr2'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			} elseif ($keluar['convert'] == 'con3' && $keluar['pengurangan'] == '2') {

				$id_detbarang = [
					'id_detbarang' => $keluar['id_detbarang']
				];
				$data_stok = [
					'stok_con1' => $keluar['stok_con1'] - 1,
					'stok_con2' => $keluar['stok_con2'] + $keluar['cr3'] - $keluar['jumlah']
				];
				$this->model->keluarstok($data_stok, $id_detbarang);
			}
		};
		// dd($insertdata);
		return redirect()->to('/permintaan_g3');
	}



	//AJAX
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
	public function viewdetail_diajukan_1($id)
	{
		session()->set([
			'status' => 'Diajukan',
		]);
		session()->set([
			'id_permintaan_delete' => $id,
		]);
		session()->set([
			'id_permintaan_g3' => $id,
		]);
		$this->model->pindah_dump_nonacc($id);
		return redirect()->to('/permintaan_g3/detail_non/' . $id);
	}
	public function viewdetail_diajukan($id)
	{
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildumpdetpermintaan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link
		];
		return view('/permintaan/detail_permintaan', $data);
	}
	public function viewdetail_dikirim($id)
	{
		session()->set([
			'status' => 'Dikirim',
		]);
		$data = [
			'title' => 'DRAFT permintaan',
			'table_dump' => $this->model->tampildetpermintaan_dikirim($id),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link
		];
		return view('/permintaan/detail_permintaan', $data);
	}

	public function tambah_dump_item_non()
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
		$permintaan = session()->get('id_permintaan_g3');
		if ($cek_dump > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah diinputkan dengan satuan tersebut');
			return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
		} else {
			if ($convert == 'con1') {
				if ($stok_base < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			} elseif ($convert == 'con2') {
				if ($jumlah > $stok_con1 + $maximal) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah <= $stok_con1) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $stok_con1 && $jumlah <= $stok_con1 + $maximal && $stok_base > 0) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $stok_con1 && $stok_base < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			} elseif ($convert == 'con3') {
				if ($jumlah > $stok_con2 + $maximal) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah <= $stok_con2) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '0'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $stok_con2 && $stok_con1 > 0 && $jumlah <= $stok_con2 + $maximal) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $stok_con2 && $jumlah <= $stok_con2 + $maximal && $stok_con2 < 1 && $stok_base > 0) {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $stok_con2 && $stok_base < 1 && $stok_con1 < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $stok_con1 . '+' . $maximal . '&&' . $stok_base . '< 1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} else {
					date_default_timezone_set('Asia/Jakarta');
					$id_det = date('ymdHis'); //201120
					$set_id_detail = "DPER-" . $id_det;
					$brg = $this->request->getVar('brg');
					$id_brg = explode("|", $brg);
					$data = [
						'id_detpermintaan' => $set_id_detail,
						'id_permintaan' => session()->get('id_permintaan_g3'),
						'id_detbarang' => $id_brg[0],
						'jumlah' => $this->request->getVar('jumlah'),
						'convert' => $convert,
						'pengurangan' => '1-2'
					];
					$this->model->tambah_dump_item($data);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			}
			// dd($cek_dump);
		}
	}
	public function hapus_dump_item_non($id)
	{
		$data = [
			'id_detpermintaan' => $id,
		];
		$this->model->hapus_dump_item($data);
		$permintaan = session()->get('id_permintaan_g3');
		return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
	}
	public function update_dump_item_non($id)
	{
		$permintaan = session()->get('id_permintaan_g3');
		$tabel = $this->model->tampilpermintaanwhere($id);
		$jumlah = $this->request->getVar('jumlah_update');
		$tujuan = session()->get('tujuan');
		// dd($tabel);
		foreach ($tabel as $detpermintaan) {
			if ($detpermintaan['convert'] == 'con1') {
				if ($detpermintaan['stok_base'] < $jumlah) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} else {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			} elseif ($detpermintaan['convert'] == 'con2') {
				if ($jumlah > $detpermintaan['stok_con1'] + $detpermintaan['cr2']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah <= $detpermintaan['stok_con1']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $detpermintaan['stok_con1'] && $jumlah <= $detpermintaan['stok_con1'] + $detpermintaan['cr2'] && $detpermintaan['stok_base'] > 0) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $detpermintaan['stok_con1'] && $detpermintaan['stok_base'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detpermintaan['stok_con1'] . '+' .  $detpermintaan['cr2'] . '&&' . $detpermintaan['stok_base'] . '< 1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			} elseif ($detpermintaan['convert'] == 'con3') {
				if ($jumlah > $detpermintaan['stok_con2'] + $detpermintaan['cr3']) {
					echo session()->setFlashdata('pesan', 'Stok barang tidak mencukupi1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah <= $detpermintaan['stok_con2']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '0'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $detpermintaan['stok_con1'] > 0 && $jumlah <= $detpermintaan['stok_con2'] + $detpermintaan['cr3']) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $jumlah <= $detpermintaan['stok_con2'] + $detpermintaan['cr3'] && $detpermintaan['stok_con2'] < 1 && $detpermintaan['stok_base'] > 0) {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} elseif ($jumlah > $detpermintaan['stok_con2'] && $detpermintaan['stok_base'] < 1 && $detpermintaan['stok_con1'] < 1) {
					echo session()->setFlashdata('pesan', $jumlah . ' >' . $detpermintaan['stok_con1'] . '+' . $detpermintaan['cr3'] . '&&' . $detpermintaan['stok_base'] . '< 1');
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				} else {
					$data = [
						'jumlah' => $this->request->getVar('jumlah_update'),
						'pengurangan' => '1-2'
					];
					$id = [
						'id_detpermintaan' => $id,
					];
					$this->model->update_dump_item($data, $id);
					return redirect()->to('/permintaan_g3/detail_non/' . $permintaan);
				}
			}
		}
	}
	public function simpendraft_detail()
	{
		$id_permintaan = session()->get('id_permintaan_g3');
		$data = [
			'status' => 'Diajukan-g3',
		];
		$id = [
			'id_permintaan' => session()->get('id_permintaan_g3'),
		];
		// dd($data);
		$this->model->delete_permintaan_nonacc($id_permintaan);
		$this->model->pindah_dump_minta($id_permintaan);
		$this->model->delete_dump_minta($id_permintaan);
		$this->model->update_status($data, $id);
		return redirect()->to('/permintaan_g3');
	}
}
