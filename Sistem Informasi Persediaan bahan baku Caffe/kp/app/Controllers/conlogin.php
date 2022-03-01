<?php

namespace App\Controllers;

use \App\Models\modbarang;
use App\Models\modlogin;
use mysqli;
use PDO;

class conlogin extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modlogin();
	}
	public function view()
	{
		return view('/login');
	}
	public function ceklogin()
	{
		$iduser = [
			'user' => $this->request->getVar('username'),
		];
		$pwuser = [
			'password' => $this->request->getVar('password'),
		];
		$status = $this->model->ceklogin($iduser, $pwuser);
		$nama = $this->model->ceklog($iduser, $pwuser);
		foreach ($nama as $name) {
		}
		if ($status > 0) {
			session()->set([
				'log' => true,
				'namauser' => $name['nama'],
				'jabatan' => $name['jabatan'],
			]);
			if (session()->get('jabatan') == 'Barista') {
				return redirect()->to('/pbkeluar');
			} elseif (session()->get('jabatan') == 'Staff Gudang') {
				return redirect()->to('/dashboard');
			}

			// echo 'berhasil';
		} else {
			// echo 'gagal';
			return redirect()->to('/');
		}
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}
