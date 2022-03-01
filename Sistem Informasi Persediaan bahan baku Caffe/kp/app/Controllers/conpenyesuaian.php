<?php

namespace App\Controllers;

use App\Models\modpenyesuaianso;
use mysqli;
use PDO;

class conpenyesuaian extends BaseController
{

	protected $model;
	protected $base_link;


	public function __construct()
	{
		$this->model = new modpenyesuaianso();
		$this->base_link = '/jurnal';
		$this->judul = 'JURNAL PENYESUAIAN';
		$this->juduldraft = 'DRAFT JURNAL PENYESUAIAN';
	}
	public function view()
	{
		$data = [
			'title' => $this->judul,
			'tb_sesuai' => $this->model->tampil_soset(),
			'tb_so' => $this->model->tampil_so(),
			'link' => $this->base_link
		];
		return view('/penyesuaian/jurnal', $data);
	}
	public function gotrans($id)
	{
		$idso = $this->model->tampil_idso($id);
		session()->set(['id_so' => $idso[0]['id_so']]);
		$data = [
			'title' => 'DRAFT JURNAL PENYESUAIAN',
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/draftpenyesuaian', $data);
	}
	public function godettrans($id)
	{
		$datadet = $this->model->tampil_iddetdetail($id);
		foreach ($datadet as $dataa) {
			session()->set(['id_detso' => $dataa['id_detso']]);
		}

		$data = [
			'title' => 'DETAIL DRAFT JURNAL PENYESUAIAN',
			'table_data' => $this->model->tampil_detdetail($id),
			'table_dump' => $this->model->tampil_dump(),
			'data_id' => $this->model->tampil_iddetdetail($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/detdraftpenyelesaian', $data);
		// dd();
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id auto untuk detail
		$tgl = date('d-m-Y');
		$id_det = date('ymdHis'); //201120
		// dd($id_det);
		$set_id_detail = "tdk-" . $id_det;
		//end generate
		$stat = "belum";
		$data = [
			'id_penyesuaian' => $set_id_detail,
			'id_detso' => $this->request->getVar('id_detail'),
			'tindakan' => $this->request->getVar('tindakan'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan'),
			'status' => $stat,
			'tanggal' => $tgl
		];
		$path = "/jurnal/transaksi-detpenyesuaian/" . $this->request->getVar('id_detail');
		// dd($data);
		$this->model->insert_dump($data);
		return redirect()->to($path);
	}
	public function hapus_draft($id)
	{
		$where = [
			'id_penyesuaian' => $id,
		];
		$this->model->hapus_draft($where);
		$d = session()->get('id_detso');
		$pathh = "/jurnal/transaksi-detpenyesuaian/" . $d;
		return redirect()->to($pathh);
	}
	public function simpan_draft()
	{
		// echo 'hhhhhhh';
		$this->model->pindah_dump();
		$this->model->delete_dump();
		$d = session()->get('id_so');
		$pathh = "/jurnal/transaksi-penyesuaian/" . $d;
		// dd($pathh);
		return redirect()->to($pathh);
	}
	public function selesai_draft()
	{
		$d = session()->get('id_so');
		$pathh = "/jurnal/transaksi-persetujuan/" . $d;
		// dd($pathh);
		return redirect()->to($pathh);
	}
	public function selesai_trans()
	{
		return redirect()->to('/jurnal');
	}
	public function updateso()
	{
		$d = session()->get('id_so');
		$id_so = [
			'id_so' => $d
		];
		$status = 'disesuaikan';
		$data = [
			'status' => $status,
		];
		$this->model->update_so($data, $id_so);
		return redirect()->to($this->base_link);
	}
	//persetujuan

	public function gosetuju($id)
	{
		$idso = $this->model->tampil_idso($id);
		foreach ($idso as $dataa) {
			session()->set(['id_so' => $dataa['id_so']]);
		}

		$data = [
			'title' => 'DRAFT JURNAL PERSETUJUAN',
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		// dd($this->model->tampil_detail($id));
		return view('/penyesuaian/draftpersetujuan', $data);
	}
	public function godetsetuju($id)
	{
		$iddetso = $this->model->tampil_penyesuaian($id);
		foreach ($iddetso as $dataa) {
			session()->set(['id_detso' => $dataa['id_detso']]);
		}
		$data = [
			'title' => 'DRAFT PERSETUJUAN',
			'table_data' => $this->model->tampil_detdetail($id),
			'table_penyesuaian' => $this->model->tampil_penyesuaian($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/detdraftpersetujuan', $data);
	}
	public function setujuitambah($id)
	{
		$id_penyesuaian = [
			'id_penyesuaian' => $id
		];
		$status = 'disetujui-ditambah';
		$data = [
			'status' => $status,
		];
		$stok_skrg = $this->model->tampil_stok($id);
		$jml = $this->model->tampil_stok_sesuai($id);
		foreach ($stok_skrg as $nilai) {
			$stok_barang = $nilai['stok'];
		}
		foreach ($jml as $jumlahsesuai) {
			$jumlahproses = $jumlahsesuai['jumlah'];
		}
		// dd($stok_barang);
		$jml_update = $stok_barang + $jumlahproses;
		$id_barang = $this->model->tampil_id_barang($id);
		// dd($id_barang);
		foreach ($id_barang as $nomer) {
			$id_b = $nomer['id_barang'];
		}
		$id_be = [
			'id_barang' => $id_b,
		];
		$jml_brg = [
			'stok' => $jml_update,
		];
		// dd($id_brg);
		$this->model->updatestok($jml_brg, $id_be);
		$this->model->update_penyesuaian($data, $id_penyesuaian);
		$d = session()->get('id_detso');
		$pathh = "/jurnal/transaksi-detpersetujuan/" . $d;
		return redirect()->to($pathh);
	}
	public function setujuikurang($id)
	{
		$id_penyesuaian = [
			'id_penyesuaian' => $id
		];
		$status = 'disetujui-dikurang';
		$data = [
			'status' => $status,
		];
		$stok_skrg = $this->model->tampil_stok($id);
		// dd($stok_skrg);
		$jml = $this->model->tampil_stok_sesuai($id);
		foreach ($stok_skrg as $nilai) {
			$stok_barang = $nilai['stok'];
		}
		foreach ($jml as $jumlahsesuai) {
			$jumlahproses = $jumlahsesuai['jumlah'];
		}
		// dd($stok_barang);
		$jml_update = $stok_barang - $jumlahproses;
		$id_barang = $this->model->tampil_id_barang($id);
		// dd($id_barang);
		foreach ($id_barang as $nomer) {
			$id_b = $nomer['id_barang'];
		}
		$id_be = [
			'id_barang' => $id_b,
		];
		$jml_brg = [
			'stok' => $jml_update,
		];
		// dd($id_brg);
		$this->model->updatestok($jml_brg, $id_be);
		$this->model->update_penyesuaian($data, $id_penyesuaian);
		$d = session()->get('id_detso');
		$pathh = "/jurnal/transaksi-detpersetujuan/" . $d;
		return redirect()->to($pathh);
	}
	public function setujuiexp($id)
	{
		$id_penyesuaian = [
			'id_penyesuaian' => $id
		];
		$status = 'disetujui-expired';
		$data = [
			'status' => $status,
		];
		$stok_skrg = $this->model->tampil_stok($id);
		// dd($stok_skrg);
		$jml = $this->model->tampil_stok_sesuai($id);
		foreach ($stok_skrg as $nilai) {
			$stok_barang = $nilai['stok'];
		}
		foreach ($jml as $jumlahsesuai) {
			$jumlahproses = $jumlahsesuai['jumlah'];
		}
		// dd($stok_barang);
		$jml_update = $stok_barang - $jumlahproses;
		$id_barang = $this->model->tampil_id_barang($id);
		// dd($id_barang);
		foreach ($id_barang as $nomer) {
			$id_b = $nomer['id_barang'];
		}
		$id_be = [
			'id_barang' => $id_b,
		];
		$jml_brg = [
			'stok' => $jml_update,
		];
		// dd($id_brg);
		$this->model->updatestok($jml_brg, $id_be);
		$this->model->update_penyesuaian($data, $id_penyesuaian);
		$d = session()->get('id_detso');
		$pathh = "/jurnal/transaksi-detpersetujuan/" . $d;
		return redirect()->to($pathh);
	}
	public function tidak($id)
	{
		$id_penyesuaian = [
			'id_penyesuaian' => $id
		];
		$status = 'tidak disetujui';
		$data = [
			'status' => $status,
		];
		$this->model->update_penyesuaian($data, $id_penyesuaian);
		return redirect()->to($this->base_link);
	}
	public function setujuinone($id)
	{
		$id_penyesuaian = [
			'id_penyesuaian' => $id
		];
		$status = 'Tidak dilakukan tindakan';
		$data = [
			'status' => $status,
		];
		$this->model->update_penyesuaian($data, $id_penyesuaian);
		$d = session()->get('id_detso');
		$pathh = "/jurnal/transaksi-detpersetujuan/" . $d;
		return redirect()->to($pathh);
	}
	public function cetakpenyesuaian($id)
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
		$judul = "DAFTAR PENYESUAIAN STOK OPNAME";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->model->cetakpenyesuaian($id),
		];
		return view('/berkas/berkaspenyesuaian', $data);
	}
}
