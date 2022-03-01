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
			'bmasuk' => $this->model->hitungbmasuk(),
			'bkeluar' => $this->model->hitungbkeluar(),
			'belanja' => $this->model->hitungbkeluar()
		];
		return view('/dashboard/dashboard', $data);
	}
}
