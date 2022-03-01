<?php

namespace App\Controllers;

use App\Models\modbelanja;
use mysqli;
use PDO;

class conbelanja extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul_belanja;
	protected $judul_belanja_disetujui;
	protected $judul_belanja_belum_disetujui;

	public function __construct()
	{
		$this->model = new modbelanja();
		$this->base_link = '/belanja';
		$this->judul_belanja = 'PERENCANAAN BELANJA';
		$this->judul_belanja_disetujui = 'DETAIL BELANJA DISETUJUI';
		$this->judul_belanja_belum_disetujui = 'DETAIL BELANJA';
	}
	public function view()
	{
		$data = [
			'title' => $this->judul_belanja,
			'table_data' => $this->model->tampil(),
			'link' => $this->base_link
		];
		return view('/belanja/belanja', $data);
	}
	public function detail_belanja_acc($id)
	{
		$data = [
			'title' => $this->judul_belanja_disetujui,
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];

		return view('/belanja/detail_belanja_acc', $data);
	}
	public function cetakbelanja($id)
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
		$judul = "DAFTAR BELANJA";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->model->tampil_cetak($id),
			'total' => $this->model->tampil_total($id),
		];
		return view('/berkas/berkasrencanabelanja', $data);
	}
	public function detail_belanja($id)
	{
		$data_detail = $this->model->tampil_detail($id);
		$id_det = $data_detail[0]['id_belanja'];
		$data = [
			'title' => $this->judul_belanja_belum_disetujui,
			'id_belanja' => $id_det,
			'data_barang' => $this->model->data_barang(),
			'data_belanja' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		return view('/belanja/detail_belanja_non_acc', $data);
	}
	public function tambah_item_detail()
	{
		$redirect_link = 'lihat/' . $this->request->getVar('id_belanja');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "BRGM-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$sub_total = $jml * $id_brg[1];
		$data = [
			'id_detbel' => $set_id_detail,
			'id_belanja' => $this->request->getVar('id_belanja'),
			'id_barang' => $id_brg[0],
			'jumlah' => $this->request->getVar('jumlah'),
			'urgensi' => $this->request->getVar('urgensi'),
			'sub_total' => $sub_total
		];
		$this->model->insert_data_detail($data);
		return redirect()->to($redirect_link);
	}
	public function hapus_detail($id)
	{
		$data = [
			'id_detbel' => $id,
		];
		$this->model->delete_data_detail($data);
		echo "<Script>history.go(-1);</script>";
	}
	public function tambah_belanja()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data = [
			'title' => $this->judul_belanja,
			'data_barang' => $this->model->data_barang(),
			'data_kurang' => $this->model->data_barang_kurang(),
			'data_dump' => $this->model->tampil_dump(),
			'link' => $this->base_link
		];
		return view('/belanja/draftrencana', $data);
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_belanja = $this->model->count_data_belanja($id_sekarang);
		if ($cek_id_belanja > 0) {
			$max = $this->model->get_data_belanja($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_belanja']);
			$no_belakang = $no[2] + 1;
			$set_id = "TRM-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "TRM-" . $id_sekarang . "-1";
		}
		//end generate

		//generate id auto untuk detail
		$id_det = date('ymdHis'); //201120
		// dd($id_det);
		$set_id_detail = "BRGM-" . $id_det;
		//end generate

		session()->set([
			'id_belanja' => $set_id,
		]);

		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$sub_total = $jml * $id_brg[1];
		$data = [
			'id_detbel' => $set_id_detail,
			'id_belanja' => session()->get('id_belanja'),
			'id_barang' => $id_brg[0],
			'jumlah' => $this->request->getVar('jumlah'),
			'urgensi' => $this->request->getVar('urgensi'),
			'sub_total' => $sub_total
		];
		$this->model->insert_data($data);
		return redirect()->to('/belanja/tambah-belanja');
	}
	public function simpan_draft()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_tanggal = date('d-m-Y');
		// dd($id_sekarang);
		$sum_dump = $this->model->sum_dump();
		$total = $sum_dump[0]['sub_total'];
		$jumlahitem = $this->model->count_data_dump();
		$data = [
			'id_belanja' => session()->get('id_belanja'),
			'total' => $total,
			'status' => 'belum',
			'item_belanja' => $jumlahitem,
		];
		$this->model->insert_belanja($data);
		$this->model->pindah_dump();
		$this->model->delete_dump();
		return redirect()->to($this->base_link);
	}
	public function update_belanja($id)
	{
		$id_belanja = [
			'id_belanja' => $id
		];
		$sum_detail = $this->model->sum_detail($id);;
		$data = [
			'total' => $sum_detail[0]['sub_total'],
		];
		$this->model->update_belanja($data, $id_belanja);
		return redirect()->to($this->base_link);
	}
	public function hapus_dump($id)
	{
		$data = [
			'id_detbel' => $id
		];
		$this->model->delete_data_dump($data);
		return redirect()->to('/belanja/tambah-belanja');
	}
	public function setuju($id)
	{
		$id_belanja = [
			'id_belanja' => $id
		];
		$data = [
			'status' => 'disetujui',
		];
		$this->model->setuju($data, $id_belanja);
		return redirect()->to($this->base_link);
	}
	public function hapus($id)
	{
		$data = [
			'id_belanja' => $id
		];
		$this->model->hapus($data);
		$this->model->hapus_detail($data);
		return redirect()->to($this->base_link);
	}
	public function hapuskekurangan($id)
	{
		$data = [
			'kekurangan' => 0
		];
		$idb = [
			'id_barang' => $id
		];
		$this->model->update_barang($data, $idb);
		return redirect()->to('/belanja/tambah-belanja');
	}

	//--------------------------------------------------------------------

}
