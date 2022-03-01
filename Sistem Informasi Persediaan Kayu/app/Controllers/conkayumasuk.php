<?php

namespace App\Controllers;

use App\Models\modkmasuk;
use CodeIgniter\HTTP\Request;
use Config\Database;
use mysqli;
use PDO;

class conkayumasuk extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul;

	public function __construct()
	{
		$this->model = new modkmasuk();
		$this->base_link = '/kmasuk';
		$this->judul = 'BARANG KELUAR';
	}
	public function view()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$set_id = date('ymdHis'); //20201120
		session()->set([
			'id_kayumasuk' => $set_id,
		]);
		$data = [
			'title' => $this->judul,
			'table_histori' => $this->model->tampilhistori(),
			'link' => $this->base_link
		];
		// $this->model->delete_dump();
		return view('/kmasuk/kmasuk', $data);
	}
	public function viewdraft()
	{	
		$data = [
			'title' => $this->judul,
			'table_dump' => $this->model->tampildump(),
			'option_barang' => $this->model->tampiloption(),
			'link' => $this->base_link
		];
		return view('/kmasuk/draftkmasuk', $data);
	}
	public function tambahitem()
	{
		$idkayumasuk=session()->get('id_kayumasuk');
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$set_id_detail = date('ymdHis'); //20201120
	if($this->request->getvar('jumlah')<1){
		echo session()->setFlashdata('pesan', 'Jumlah kayu yang diinputkan minimal 1');
		return redirect()->to('/draftkayumasuk');
	}else{

		$data = [
			'id_detkm' =>$set_id_detail,
			'id_km' =>  $idkayumasuk,
			'jumlah' => (int)$this->request->getvar('jumlah'),
			'id_kayu' => $this->request->getvar('brg'),
			'status' => '0'
		];
		
		// dd($data);
		$this->model->tambah_item($data);
		return redirect()->to('/draftkayumasuk');
	}
	}
	public function hapus($id)
	{
		$data = [
			'id_detkm' => $id,
		];
		$this->model->hapus_item($data);
		return redirect()->to('/draftkayumasuk');
	}
	public function edit($id)
	{
		$data = [
			'jumlah' => (int)$this->request->getvar('jumlah_update')
		];
		$idmasuk=[
			'id_detkm' => $id
		];
		$this->model->updatekayu_masuk($data,$idmasuk);
		return redirect()->to('/draftkayumasuk');
	}
	public function simpandraft()
	{
		$item=$this->model->tampildump();
		foreach($item as $masukan){
			$id_item=$masukan['id_kayu'];
			$jumlah=$masukan['jumlah'];
			$id_detail=$masukan['id_detkm'];
			$stok=$this->model->tampilseleksi($id_item);
			$dataupdate=[
				'stok' => (int)$jumlah + (int)$stok[0]['stok']
			];
			// dd($dataupdate);
			$dataid=[
				'id_kayu' => $id_item
			];
			$datastatus=[
				'status' => 1
			];
			$dataiddetail=[
				'id_detkm' => $id_detail
			];
			$this->model->ubahstok($dataupdate,$dataid);
			$this->model->ubahstatus($datastatus,$dataiddetail);
		}
		$datamasuk=[
			'id_km' => session()->get('id_kayumasuk'),
			'user' => session()->get('user')
		];
		$this->model->proseskayu_masuk($datamasuk);
		$this->model->delete_dump();
		return redirect()->to('/kayumasuk');
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
			'id_detkmasuk' => $id
		];
		$this->model->hapus_item($id_kel);
		return redirect()->to('/draftkayumasukkmasuk');
	}
	
}
