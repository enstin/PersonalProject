<?php

namespace App\Controllers;

use \App\Models\modbarang;
use App\Models\modlogin;
use mysqli;
use PDO;

class Conlogin extends BaseController
{

	protected $model;
	// protected $db;
	public function __construct()
	{
		$this->model = new modlogin();
	}
	
	public function view()
	{
		session_destroy();
		session()->set([
			'log' => false
		]);
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
				'id_user' => $name['id_user'],
				'namauser' => $name['nama'],
				'jabatan' => $name['jabatan'],
				'gudang' => $name['id_gudang']
			]);
			if (session()->get('gudang') == 'g1') {
				if (session()->get('jabatan') == 'owner') {
					return redirect()->to('/dashboard');
				} elseif (session()->get('jabatan') == 'kepala_gudang') {
					return redirect()->to('/dashboard');
				} else {
					return redirect()->to('/dashboard');
				}
			} elseif (session()->get('gudang') == 'g2') {
				if (session()->get('jabatan') == 'kepala gudang') {
					return redirect()->to('/dashboard_g2');
				} else {
					return redirect()->to('/dashboard_g2');
				}
			} elseif (session()->get('gudang') == 'g3') {
				if (session()->get('jabatan') == 'kepala gudang') {
					return redirect()->to('/dashboard_g3');
				} else {
					return redirect()->to('/dashboard_g3');
				}
			} else {
				return redirect()->to('/');
			}
		} else {
			echo session()->setFlashdata('pesan', 'WRONG USERNAME AND PASSWORD');
			return redirect()->to('/');
		}
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}
