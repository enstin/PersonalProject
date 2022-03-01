<?php

namespace App\Controllers;

use App\Models\modkkeluar;
use CodeIgniter\HTTP\Request;
use Config\Database;
use mysqli;
use PDO;

class conkayukeluar extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul;

	public function __construct()
	{
		$this->model = new modkkeluar();
		$this->base_link = '/kkeluar';
		$this->judul = 'BARANG KELUAR';
	}
	public function view()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$set_id = date('ymdHis'); //20201120
		session()->set([
			'id_kayukeluar' => $set_id,
		]);
		$data = [
			'title' => $this->judul,
			'table_histori' => $this->model->tampilhistori(),
			'link' => $this->base_link
		];
		// $this->model->delete_dump();
		return view('/kkeluar/kkeluar', $data);
	}
	public function viewdraft()
	{	
		$data = [
			'title' => $this->judul,
			'table_dump' => $this->model->tampildump(),
			'option_barang' => $this->model->tampiloption(),
			'link' => $this->base_link
		];
		return view('/kkeluar/draftkkeluar', $data);
	}
	public function tambahitem()
	{
		$idkayukeluar=session()->get('id_kayukeluar');
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$set_id_detail = date('ymdHis'); //20201120
		$jumlah=(int)$this->request->getvar('jumlah');
			$stok=$this->model->tampilseleksi($this->request->getvar('brg'));
			$cek=(int)$stok[0]['stok'] - (int)$jumlah;
			if($cek<0){
				echo session()->setFlashdata('pesan', 'Jumlah yang dikeluarkan melebihi stok saat ini');
				return redirect()->to('/draftkayukeluar');
			}elseif($jumlah<1){
				echo session()->setFlashdata('pesan', 'Jumlah kayu yang diinputkan minimal 1');
				return redirect()->to('/draftkayukeluar');
			}else{
		$data = [
			'id_detkk' => $idkayukeluar,
			'id_kk' => $set_id_detail,
			'jumlah' => (int)$this->request->getvar('jumlah'),
			'id_kayu' => $this->request->getvar('brg'),
			'status' => '0'
		];
		
		// dd($data);
		$this->model->tambah_item($data);
	}
		return redirect()->to('/draftkayukeluar');
	}
	public function hapus($id)
	{
		$data = [
			'id_detkk' => $id,
		];
		$this->model->hapus_item($data);
		return redirect()->to('/draftkayukeluar');
	}
	public function edit($id)
	{
		$data = [
			'jumlah' => (int)$this->request->getvar('jumlah_update')
		];
		$idkeluar=[
			'id_detkk' => $id
		];
		$this->model->updatekayu_keluar($data,$idkeluar);
		return redirect()->to('/draftkayukeluar');
	}
	public function simpandraft()
	{
		$item=$this->model->tampildump();
		foreach($item as $keluaran){
			$id_item=$keluaran['id_kayu'];
			$id_detail=$keluaran['id_detkk'];
			$jumlah=$keluaran['jumlah'];
			$stok=$this->model->tampilseleksi($id_item);
			$cek=(int)$stok[0]['stok'] - (int)$jumlah;
			if($cek<0){
				echo session()->setFlashdata('pesan', 'WRONG USERNAME AND PASSWORD');
				return redirect()->to('/draftkayukeluar');
			}else{
				$dataupdate=[
					'stok' => (int)$stok[0]['stok'] - (int)$jumlah
				];
				// dd($dataupdate);
				$dataid=[
					'id_kayu' => $id_item
				];
				$datastatus=[
					'status' => 1
				];
				$dataiddetail=[
					'id_detkk' => $id_detail
				];
				$this->model->ubahstok($dataupdate,$dataid);
				$this->model->ubahstatus($datastatus,$dataiddetail);
			}
			$datakeluar=[
				'id_kk' => session()->get('id_kayukeluar'),
				'user' => session()->get('user')
			];
			$this->model->proseskayu_keluar($datakeluar);
			$this->model->delete_dump();
			return redirect()->to('/kayukeluar');
			}
			
	}

	public function get_satuan()
	{
		$idbarang = $this->request->getPost("id");
		$opt = $this->model->optionsat($idbarang);
		foreach ($opt as $o) {
		
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
	
	public function hapus_item($id)
	{
		$id_kel = [
			'id_detkkeluar' => $id
		];
		$this->model->hapus_item($id_kel);
		return redirect()->to('/draftkayukeluarkkeluar');
	}
	
}
