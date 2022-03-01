<?php

namespace App\Controllers;

use App\Models\modbkeluar;
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
		$data = [
			'title' => $this->judul,
			'table_data' => $this->model->tampil(),
			'table_histori' => $this->model->tampil_histori(),
			'link' => $this->base_link
		];
		$this->model->delete_dump();
		return view('/bkeluar/bkeluar', $data);
	}

	public function viewtrans()
	{
		$data = [
			'title' => $this->judul,
			'table_data' => $this->model->tampil_dump(),
			'data_brg' => $this->model->tampil_barang(),
			'link' => $this->base_link
		];
		// dd($this->model->tampil_dump());
		return view('/bkeluar/draftbkeluar', $data);
	}
	public function gotrans($id)
	{
		//ambil data pbkeluar yg disetujui
		$data_kel = $this->model->get_data_pbkeluar($id);
		foreach ($data_kel as $data_pbkeluar) {
			session()->set(['id_trasnkel' => $data_pbkeluar['id_pbkeluar']]);
			$data = [
				'id_detbkeluar' => $data_pbkeluar['id_detpbkeluar'],
				'id_bkeluar' => $data_pbkeluar['id_pbkeluar'],
				'id_barang' => $data_pbkeluar['id_barang'],
				'jumlah' => $data_pbkeluar['jumlah'],
				'kekurangan' => $data_pbkeluar['kekurangan'],
			];
			$this->model->insert_dump_detbkeluar($data);
		}
		return redirect()->to('/bkeluar/draft');
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
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
		$det = "BRGK-" . date('ymdHis');
		$data = [
			'id_detbkeluar' => $det,
			'id_bkeluar' => $this->request->getVar('id_bkeluar'),
			'id_barang' => $id_brg[0],
			'jumlah' => $jumlah,
			'kekurangan' => $kekurangan,
		];
		$this->model->insert_dump_detbkeluar($data);
		return redirect()->to('/bkeluar/draft');
	}
	public function simpan_draft($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$data = [
			'id_bkeluar' => $id,
			'user' => session()->get('namauser')
		];

		$dum = $this->model->tampil_dump();
		foreach ($dum as $jum) {
			$idbrg = $jum['id_barang'];
			$idbar = [
				'id_barang' => $idbrg
			];
			$jumlahdum = $this->model->tampiloperasi($idbrg);
			foreach ($jumlahdum as $jumdum) {
				$jumlah = $jum['stok'] - $jumdum['total'];
				if ($jumlah <= 0) {
					$jujuju = [
						'stok' => 0,
						'kekurangan' => $jum['kekurangan']
					];
					$this->model->updatestok($jujuju, $idbar);
				} else {
					$jujuju = [
						'stok' => $jumlah,
						'kekurangan' => $jum['kekurangan']
					];
					$this->model->updatestok($jujuju, $idbar);
				}
			}
			$t = [
				'id_detbkeluar' => $jum['id_detbkeluar'],
				'id_bkeluar' => $jum['id_bkeluar'],
				'id_barang' => $jum['id_barang'],
				'jumlah' => $jum['jumlah'],
				'kekurangan' => $jum['kekurangan']
			];
			$this->model->pindah_dump2($t);
		}

		foreach ($dum as $dumkel) {
			$idbardumkel = $dumkel['id_barang'];
			$jmlbardumkel = $dumkel['jumlah'];
			$kondisi = [
				'id_barang' => $idbardumkel,
			];
			session()->set([
				'kebutuhankeluar' => $jmlbardumkel,
			]);
			$f = $this->model->tabelfifo($kondisi);
			$hitung = $this->model->tabelfifocount($kondisi);
			if ($jmlbardumkel > $f[0]['sisa']) {
				// dd($f);
				foreach ($f as $df) {
					if ($df['sisa'] < session()->get('kebutuhankeluar')) {
						// echo 'masih ada operasi' . '<br>';
						$update = [
							'sisa' => 0,
							'keluar' => $df['sisa'],
						];
						$idsu = [
							'id_barang' => $idbardumkel,
							'id_detbmasuk' => $df['id_detbmasuk'],
						];
						// echo 'ini kalau keluar masih ada nilai <br>';
						// var_dump($update, $idsu);
						// echo '<br>';
						session()->set([
							'kebutuhankeluar' => session()->get('kebutuhankeluar') - $df['sisa'],
						]);
						$this->model->updatefifo($update, $idsu);
						$this->model->updatebmasuk($update, $idsu);
					} else {
						$update = [
							'sisa' => $df['sisa'] - (session()->get('kebutuhankeluar')),
							'keluar' => (session()->get('kebutuhankeluar')),
						];
						$idsu = [
							'id_barang' => $idbardumkel,
							'id_detbmasuk' => $df['id_detbmasuk'],
						];
						// var_dump($update, $idsu);
						// echo 'masih selesai' . '<br>' . '<br>';
						$this->model->updatefifo($update, $idsu);
						$this->model->updatebmasuk($update, $idsu);
					}
				}
				// echo 'ini kalau keluar lebih besar <br>';
			} else {
				$ppp = $this->model->tabelfifokurang($kondisi);
				$update = [
					'sisay' => $ppp[0]['sisa'] - $jmlbardumkel,
					'keluar' => $jmlbardumkel,
				];
				$idsu = [
					'id_detbmasuk' => $ppp[0]['id_detbmasuk'],
					'id_barang' => $idbardumkel,
				];
				// $this->model->updatefifo($update, $idsu);
				// echo 'ini kalau keluar lebih kecil  <br>';
				// var_dump($update, $idsu);
				$this->model->updatefifo($update, $idsu);
				$this->model->updatebmasuk($update, $idsu);
			}
		}
		$this->model->insert_bkeluar($data);
		$this->model->deletefifo();
		$id_pbkeluar = [
			'id_pbkeluar' => $id,
		];
		$status_pbkeluar = [
			'status' => 'dimasukan',
		];
		$this->model->ubah_status($status_pbkeluar, $id_pbkeluar);

		return redirect()->to('/bkeluar');
	}
	public function ubah_draft()
	{
		$jml = $this->request->getVar('jumlah');
		$stok = $this->request->getVar('stok');
		if ($jml > $stok) {
			$kekurangan = $jml - $stok;
			$jumlah = $stok;
		} else {
			$kekurangan = 0;
			$jumlah = $jml;
		}
		$data = [
			'jumlah' => $jumlah,
			'kekurangan' => $kekurangan,

		];
		$where = [
			'id_detbkeluar' => $this->request->getVar('id_detbkeluar'),
		];

		$this->model->ubah_draft($data, $where);
		return redirect()->to('/bkeluar/draft');
	}
	public function hapus_draft($id)
	{
		$where = [
			'id_detbkeluar' => $id,
		];

		$this->model->hapus_draft($where);
		return redirect()->to('/bkeluar/draft');
	}
}
