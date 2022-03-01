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

		session()->set([
			'log' => false
		]);
		return view('/login');
	}
	public function dashboard()
	{
		return view('/dashboard');
	}
	
	public function ceklogin()
	{
	    
		$iduser = [
			'user' => $this->request->getVar('username'),
		];
		$pwuser = [
			'password' => md5($this->request->getVar('password')),
		];
		$status = $this->model->ceklogin($iduser, $pwuser);
		$nama = $this->model->ceklog($iduser, $pwuser);
		foreach ($nama as $name) {
		}
		if ($status > 0) {
			session()->set([
				'log' => true,
				'user' => $name['user'],
				'namauser' => $name['nama'],
				'jabatan' => $name['jabatan'],
			]);
			if (session()->get('jabatan') == 'admin') {
				return redirect()->to('/dashboard');
			}else{
				return redirect()->to('/dashboard');
			}
		} else {
			echo session()->setFlashdata('pesan', 'WRONG USERNAME AND PASSWORD');
			return redirect()->to('/login');
		}
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}
}
