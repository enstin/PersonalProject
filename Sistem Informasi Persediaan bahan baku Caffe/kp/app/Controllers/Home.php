<?php namespace App\Controllers;
use \App\Models\dashboardmodel;
use mysqli;

class Home extends BaseController
{
	protected $awu;
	protected $db;
	public function __construct()
	{
		$this->awu=new dashboardmodel();
	}
	public function aaa()
	{
		return view('peler/a');
	}
	public function bbb()
	{
		return view('peler/b');
	}

	public function input()
	{
		$inp=array('input'=>$this->request->getVar('input1'));
		$this->awu->input_data($inp);
		$this->awu->input_data($inp);
		return view('/peler/form');
	}
	public function tampilpeler()
	{
		return view('/peler/form');
	}
	public function index(){
		
		return view('/barang/data_jenis/jenis');
	}
	public function ccc()
	{
		$entahla=$this->awu->kontol();
		$a=[
			'aa'=>$entahla
		];
		return view('peler/c',$a);
	}
	//--------------------------------------------------------------------

}
