<?php

namespace App\Controllers;

use \App\Models\moddashboard;
use mysqli;
use PDO;

class condashboard extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new moddashboard();
	}
	public function view()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'permintaanbelum' => $this->model->permintaanbelum(),
			'masuk' => $this->model->itemmasuk(),
			'keluar' => $this->model->itemkeluar(),
			'perminggu' => $this->model->perminggu(),
			'perminggulalu' => $this->model->perminggulalu(),
			'pertahun' => $this->model->pertahun(),
			'pertahunlalu' => $this->model->pertahunlalu(),
		];

		return view('/dashboard/dashboard', $data);
	}
		public function view2()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'permintaanbelum' => $this->model->permintaanbelum_g2(),
			'masuk' => $this->model->itemmasuk_g2(),
			'keluar' => $this->model->itemkeluar_g2(),
			'perminggu' => $this->model->perminggu_g2(),
			'perminggulalu' => $this->model->perminggulalu_g2(),
			'pertahun' => $this->model->pertahun_g2(),
			'pertahunlalu' => $this->model->pertahunlalu_g2(),
		];

		return view('/dashboard/dashboard', $data);
	}
		public function view3()
	{
		$data = [
			'title' => 'BARANG MASUK',
			'permintaanbelum' => $this->model->permintaanbelum_g3(),
			'masuk' => $this->model->itemmasuk_g3(),
			'keluar' => $this->model->itemkeluar_g3(),
			'perminggu' => $this->model->perminggu_g3(),
			'perminggulalu' => $this->model->perminggulalu_g3(),
			'pertahun' => $this->model->pertahun_g3(),
			'pertahunlalu' => $this->model->pertahunlalu_g3(),
		];

		return view('/dashboard/dashboard', $data);
	}
}
