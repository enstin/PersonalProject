<?php

namespace App\Controllers;

use \App\Models\modmaster;
use Exception;
use mysqli;
use PDO;

class conmaster extends BaseController
{

	protected $modelmaster;
	// protected $db;
	public function __construct()
	{
		$this->modelmaster = new modmaster();
	}


	
	//============KAYU=================
	public function viewkayu()
	{
		$kayu = $this->modelmaster->tampilkayu();
		// dd($jenis);
		$data = [
			'title' => 'DATA kayu',
			'data_kayu' => $kayu,
			'link' => '/kayu',
		];
		return view('/barang/kayu', $data);
	}

	public function inputkayu()
	{
		$cek_kayu = $this->modelmaster->cekkayu($this->request->getVar('nama'));
		if($this->request->getVar('rp') < 1){
			echo session()->setFlashdata('pesan', 'Jumlah Reorder Point tidak boleh kurang dari 1');
				return redirect()->to('/kayu');
		}elseif($cek_kayu > 0){
			echo session()->setFlashdata('pesan', 'Nama data sudah pernah diinputkan');
					return redirect()->to('/kayu');
		}else{
			$count_kayu = $this->modelmaster->countkayu();
			if ($count_kayu > 0) {
				$ambilkayu = $this->modelmaster->ambilkayu();
				foreach ($ambilkayu as $get_id) {
				}
				// dd($get_id);
				$no = explode("-", $get_id['id_kayu']);
				$no_belakang = $no[1] + 1;
				$set_id = "KY-" . $no_belakang;
				if ($no_belakang <= 9) {
					$set_id = "KY-00" . $no_belakang;
				} elseif ($no_belakang > 9 && $no_belakang < 100) {
					$set_id = "KY-0" . $no_belakang;
				} elseif ($no_belakang > 99) {
					$set_id = "KY-" . $no_belakang;
				}
			} else {
				$set_id = "KY-001";
			}
			session()->set([
				'id_kayu' => $set_id
			]);
			$data = [
				'id_kayu' => session()->get('id_kayu'),
				'nama' => $this->request->getVar('nama'),
				'jenis' => $this->request->getVar('jenis'),
				'kwalitas' => $this->request->getVar('kwalitas'),
				'satuan' => $this->request->getVar('satuan'),
				'rp' => $this->request->getVar('rp'),
				'stok' => 0
			];
			// echo $set_id;
			$this->modelmaster->insertkayu($data);
			return redirect()->to('/kayu');
		}
	
	}

	public function hapuskayu($idkayu)
	{
		// dd($idkayu);
		try{
			$this->modelmaster->delete_kayu($idkayu);
		}catch(Exception $e){
			return $e->getMessage;
		}
		
		// dd();
		return redirect()->to('/kayu');
	}

	public function ubahkayu($idkayu)
	{
		$cek_kayu = $this->modelmaster->cekkayu($this->request->getVar('nama'));
		if($this->request->getVar('rp') < 1){
			echo session()->setFlashdata('pesan', 'Jumlah Reorder Point tidak boleh kurang dari 1');
				return redirect()->to('/kayu');
		}elseif($cek_kayu > 0){
			echo session()->setFlashdata('pesan', 'Nama data sudah pernah diinputkan');
					return redirect()->to('/kayu');
		}else{
		$id = [
			'id_kayu' => $idkayu
		];
		$data = [
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
			'kwalitas' => $this->request->getVar('kwalitas'),
			'satuan' => $this->request->getVar('satuan'),
			'rp' => $this->request->getVar('rp'),
		];
		$this->modelmaster->updatekayu($data, $id);
		return redirect()->to('/kayu');
	}
	}
	
	//--------------------------------------------------------------------

	//============PRODUK=================
	public function viewproduk()
	{
		$produk = $this->modelmaster->tampilproduk();
		// dd($jenis);
		$data = [
			'title' => 'DATA produk',
			'data_produk' => $produk,
			'link' => '/produk',
		];
		return view('/barang/produk', $data);
	}
	public function inputproduk()
	{
		$cek_produk = $this->modelmaster->cekproduk($this->request->getVar('nama'));
		if($this->request->getVar('harga') < 1){
			echo session()->setFlashdata('pesan', 'Harga tidak boleh kurang dari 1 rupiah');
				return redirect()->to('/produk');
		}elseif($cek_produk > 0){
			echo session()->setFlashdata('pesan', 'Nama data sudah pernah diinputkan');
					return redirect()->to('/produk');
		}else{
		$count_produk = $this->modelmaster->countproduk();
		if ($count_produk > 0) {
			$ambilproduk = $this->modelmaster->ambilproduk();
			foreach ($ambilproduk as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_produk']);
			$no_belakang = $no[1] + 1;
			$set_id = "PRD-" . $no_belakang;
			if ($no_belakang <= 9) {
				$set_id = "PRD-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "PRD-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "PRD-" . $no_belakang;
			}
		} else {
			$set_id = "PRD-001";
		}
		session()->set([
			'id_produk' => $set_id
		]);
		$data = [
			'id_produk' => $set_id,
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
			'keterangan' => $this->request->getVar('keterangan'),
			'harga' => $this->request->getVar('harga'),
			'stok' => 0
		];
		// echo $set_id;
		// dd($data);
		$this->modelmaster->insertproduk($data);
		return redirect()->to('/produk');
	}
	}

	public function hapusproduk($idproduk)
	{
		// dd($idproduk);
		$this->modelmaster->delete_produk($idproduk);
		return redirect()->to('/produk');
	}

	public function ubahproduk($idproduk)
	{
		$cek_produk = $this->modelmaster->cekproduk($this->request->getVar('nama'));
		if($this->request->getVar('harga') < 1){
			echo session()->setFlashdata('pesan', 'Harga tidak boleh kurang dari 1 rupiah');
				return redirect()->to('/produk');
		}elseif($cek_produk > 0){
			echo session()->setFlashdata('pesan', 'Nama data sudah pernah diinputkan');
					return redirect()->to('/produk');
		}else{
		$id = [
			'id_produk' => $idproduk
		];
		$data = [
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
			'keterangan' => $this->request->getVar('keterangan'),
			'harga' => $this->request->getVar('harga'),
			'stok' => 0
		];
		$this->modelmaster->updateproduk($data, $id);
		return redirect()->to('/produk');
	}
	}
	//--------------------------------------------------------------------

	//============user=================
	public function viewuser()
	{
		$user = $this->modelmaster->tampiluser();
		// dd($jenis);
		$data = [
			'title' => 'DATA user',
			'data_user' => $user,
			'link' => '/user',
		];
		return view('/barang/user', $data);
	}
	public function inputuser()
	{
		$data = [
			'user' => $this->request->getVar('user'),
			'password' => $this->request->getVar('password'),
			'nama' => $this->request->getVar('nama'),
			'no_telpon' => $this->request->getVar('telpon'),
			'jabatan' => $this->request->getVar('jabatan'),
		];
		$this->modelmaster->insertuser($data);
		return redirect()->to('/user');
	}

	public function hapususer($iduser)
	{
		// dd($iduser);
		$this->modelmaster->delete_user($iduser);
		return redirect()->to('/user');
	}

	public function ubahuser($iduser)
	{
		$id = [
			'user' => $iduser
		];
		$data = [
			'password' => $this->request->getVar('password'),
			'nama' => $this->request->getVar('nama'),
			'no_telpon' => $this->request->getVar('telpon'),
			'jabatan' => $this->request->getVar('jabatan'),
		];
		$this->modelmaster->updateuser($data, $id);
		return redirect()->to('/user');
	}
	//--------------------------------------------------------------------


}
