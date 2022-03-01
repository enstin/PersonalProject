<?php

namespace App\Controllers;

use App\Models\modrbelanja;
use mysqli;
use PDO;

class conrbelanja extends BaseController
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
			'title' => 'DRAFT BELANJA',
			'barang' => $barang,
			'baranga' => $baranga,
			'jenis' => $jenis,
			'link' => '/BELANJA/DRAFTBELANJA',
		];
		return view('/belanja/rencana', $data);
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
