<?php

namespace App\Controllers;

use \App\Models\modbarang;
use mysqli;
use PDO;

class conbarang extends BaseController
{

	protected $modelbarang;
	// protected $db;
	public function __construct()
	{
		$this->modelbarang = new modbarang();
	}
	public function view()
	{
		$barang = $this->modelbarang->tampilbarang();
		$jenis = $this->modelbarang->tampiljenis();
		// dd($jenis);
		$data = [
			'title' => 'BARANG',
			'barang' => $barang,
			'jenis' => $jenis,
			'link' => '/barang',
		];
		return view('/barang/barang', $data);
	}
	public function hapus($idbarang)
	{
		$data = [
			'id_barang' => $idbarang
		];
		$this->modelbarang->deletedata($data);
		return redirect()->to('/barang');
	}
	public function ubah($idbarang)
	{
		$id = [
			'id_barang' => $idbarang
		];
		$data = [
			'nama' => $this->request->getVar('nama'),
			'id_jenis' => $this->request->getVar('jenis'),
			// 'stok' => 0,
			'harga' => $this->request->getVar('harga'),
			'lama_expired' => $this->request->getVar('expired'),
			// 'satuan' => $this->request->getVar('satuan'),
		];
		$this->modelbarang->updatedata($data, $id);
		return redirect()->to('/barang');
	}
	//--------------------------------------------------------------------
	public function insert()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_sekarang = $this->request->getVar('jenis');
		$cek_id_belanja = $this->modelbarang->count_data_barang($id_sekarang);
		if ($cek_id_belanja > 0) {
			$max = $this->modelbarang->get_data_barang($id_sekarang);
			foreach ($max as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_barang']);
			$no_belakang = $no[2] + 1;
			$set_id = "BRG-" . $id_sekarang . "-" . $no_belakang;
		} else {
			$set_id = "BRG-" . $id_sekarang . "-1";
		}
		session()->set([
			'id_barang' => $set_id
		]);
		$data = [
			'id_barang' => $set_id,
			'nama' => $this->request->getVar('nama'),
			'id_jenis' => $this->request->getVar('jenis'),
			'stok' => 0,
			'harga' => $this->request->getVar('harga'),
			'lama_expired' => $this->request->getVar('expired'),
			'satuan' => $this->request->getVar('satuan'),
		];
		// echo $set_id;
		$this->modelbarang->insertdata($data);
		return redirect()->to('/barang');
	}
}
