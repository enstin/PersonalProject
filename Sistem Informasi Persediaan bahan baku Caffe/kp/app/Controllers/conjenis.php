<?php

namespace App\Controllers;

use \App\Models\modjenis;
use mysqli;

class conjenis extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modjenis();
	}
	public function view()
	{
		$saksake = $this->model->tampiljenis();
		$data = [
			'title' => 'JENIS BARANG',
			'jenis' => $saksake,
			'link' => '/jenis-barang',
		];
		return view('/barang/data_jenis/jenis', $data);
	}
	public function insert()
	{
		$data = [
			'id_jenis' => $this->request->getVar('IDjenis'),
			'jenis' => $this->request->getVar('jenis'),

		];
		$this->model->insertdata($data);
		return redirect()->to('/jenis-barang');
	}
	public function delete($idjenis)
	{
		$data = [
			'id_jenis' => $idjenis
		];
		$this->model->deletedata($data);
		return redirect()->to('/jenis-barang');
	}
	public function edit($id)
	{
		// echo 'edittt';
		$id = [
			'id_jenis' => $id,
		];
		$data = [
			'jenis' => $this->request->getVar('jenis'),
		];
		$this->model->editdata($id, $data);
		return redirect()->to('/jenis-barang');
	}




	//--------------------------------------------------------------------

}
