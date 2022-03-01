<?php

namespace App\Controllers;

use App\Models\modrbelanja;
use mysqli;
use PDO;

class condraftbmasuk extends BaseController
{

	protected $modelbarang;
	// protected $db;
	public function __construct()
	{
		$this->modelbarang = new modrbelanja();
	}
	public function view()
	{
		$barang = $this->modelbarang->tampilbarang();
		$baranga = $this->modelbarang->tampilbarang();
		$jenis = $this->modelbarang->tampiljenis();
		$data = [
			'title' => 'DRAFT BARANG MASUK',
			'barang' => $barang,
			'baranga' => $baranga,
			'jenis' => $jenis,
			'link' => '/bmasuk/draftbmasuk',
		];
		return view('/bmasuk/draftbmasuk', $data);
	}
	public function insert()
	{
		$data = [
			'barang' => $this->request->getVar('barang'),
		];
		$this->model->insertdata($data);
		return redirect()->to('/barang/barang');
	}
	public function delete($idbarang)
	{
		$data = [
			'id_barang' => $idbarang
		];
		$this->model->deletedata($data);
		return redirect()->to('/barang');
	}
	//--------------------------------------------------------------------

}
