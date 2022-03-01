<?php

namespace App\Controllers;

use App\Models\modso;
use mysqli;
use PDO;

class conso extends BaseController
{

	protected $model;
	protected $base_link;

	public function __construct()
	{

		$this->model = new modso();
		$this->base_link = '/so';
		$this->judul = 'STOK OPNAME';
		$this->juduldraft = 'DRAFT STOK OPNAME';
	}
	public function view()
	{
		$cekdata = $this->model->cekdata();
		foreach ($cekdata as $cekcok) {
			$data__id = $cekcok['id_detbarang'];
			$dataexplode = explode('-', $data__id);
			if ($dataexplode[6] == 'g1') {
				$id_kel = [
					'id_detso' => $cekcok['id_detso']
				];
				$this->model->hapus_item($id_kel);
			} else {
			}
		};
		$kondisibase = [
			'id_gudang' => 'g1',
			'id_user' => ''
		];
		$this->model->hapus_base($kondisibase);
		// dd($a);
		// $this->model->hapusbase1();
		date_default_timezone_set('Asia/Jakarta');
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_belanja = $this->model->count_data_so($id_sekarang);
		if ($cek_id_belanja > 0) {
			$max = $this->model->get_data_so($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_so']);
			$no_belakang = $no[2] + 1;
			if ($no_belakang <= 9) {
				$set_id = "SO-" . $id_sekarang . "-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "SO-" . $id_sekarang . "-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "SO-" . $id_sekarang . "-" . $no_belakang;
			}
		} else {
			$set_id = "SO-" . $id_sekarang . "-001";
		}
		//end generate
		session()->set([
			'id_so_g1' => $set_id,
		]);
		$dataa = [
			'id_so' => $set_id,
			'id_gudang' => 'g1',
			'status' => 'ditambah'
		];
		$this->model->prosesso($dataa);
		$data = [
			'title' => $this->judul,
			'table_data' => $this->model->view(),
			'link' => $this->base_link
		];
		return view('/so/so', $data);
	}
	public function tambahso()
	{

		$data = [
			'title' => $this->juduldraft,
			'option_barang' => $this->model->optionsatuan(),
			'data_dump' => $this->model->tampil_dump(),
			'link' => $this->base_link
		];
		return view('/so/draftso', $data);
	}

	public function get_satuan()
	{
		$idbarang = $this->request->getPost("id");
		$opt = $this->model->optionsat($idbarang);
		foreach ($opt as $o) {
			if ($o['satuan1']) echo "<option value='con1|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|0|{$o['satuan1']}''>{$o['satuan1']}</option>";
			if ($o['satuan2']) echo "<option value='con2|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|{$o['cr2']}|{$o['satuan2']}''>{$o['satuan2']}</option>";
			if ($o['satuan3']) echo "<option value='con3|{$o['stok_base']}|{$o['stok_con1']}|{$o['stok_con2']}|{$o['cr3']}|{$o['satuan3']}''>{$o['satuan3']}</option>";
		}
	}

	public function tambah_item()
	{
		$id_detbarang = $this->request->getVar('brg');
		$akeh = $this->request->getVar('satuan');
		$conval =  explode("|", $akeh);
		$convert = $conval[0];
		// dd($conval);
		$stok_base = $conval[1];
		$stok_con1 = $conval[2];
		$stok_con2 = $conval[3];
		$maximal = $conval[4];
		$satuan = $conval[5];
		$jumlah = $this->request->getVar('jumlah');
		$cek_dump = $this->model->cek_dump($id_detbarang, $convert);
		if ($cek_dump > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah diinputkan dengan satuan tersebut');
			return redirect()->to('/so/tambah-so');
		} else {
			if ($convert == 'con1') {
				$selisih = $jumlah - $stok_base;
				$jml_stok = $stok_base;
			} elseif ($convert == 'con2') {
				$selisih = $jumlah - $stok_con1;
				$jml_stok = $stok_con1;
			} else {
				$selisih = $jumlah - $stok_con2;
				$jml_stok = $stok_con2;
			}
			$status = 'a';
			if ($selisih > 0) {
				$status = 'Lebih';
			} elseif ($selisih < 0) {
				$status = 'kurang';
			} else {
				$status = 'Sesuai';
			}
			//generate id auto untuk detail
			$id_det = date('ymdHis'); //201120
			// dd($id_det);
			$set_id_detail = "DSO-" . $id_det;
			//end generate
			$data = [
				'id_detso' => $set_id_detail,
				'id_so' => session()->get('id_so_g1'),
				'id_detbarang' => $id_detbarang,
				'jumlah_sistem' => $jml_stok,
				'jumlah_riil' => $jumlah,
				'selisih' => $selisih,
				'status' => $status,
				'convert' => $convert
			];
			$this->model->insert_data($data);
			return redirect()->to('/so/tambah-so');
		}
	}

	public function edit_draft($id)
	{
		$dump_where = $this->model->tampil_dump_where($id);
		$jumlah = $this->request->getVar('jumlah');
		foreach ($dump_where as $convert) {
			$conversi = $convert['convert'];
			$stok_base = $convert['stok_base'];
			$stok_con1 = $convert['stok_con1'];
			$stok_con2 = $convert['stok_con2'];
		}
		if ($conversi == 'con1') {
			$selisih = $stok_base - $jumlah;
		} elseif ($conversi == 'con2') {
			$selisih = $stok_con1 - $jumlah;
		} else {
			$selisih = $stok_con2 - $jumlah;
		}
		if ($selisih < 0) {
			$status = 'Lebih';
		} elseif ($selisih > 0) {
			$status = 'kurang';
		} else {
			$status = 'Sesuai';
		}
		$data = [
			'jumlah_riil' => $jumlah,
			'selisih' => $selisih,
			'status' => $status,
		];
		$id_detso = [
			'id_detso' => $id
		];
		$this->model->update_dumpde($data, $id_detso);
		return redirect()->to('/so/tambah-so');
	}
	public function hapus_dump($id)
	{
		$data = [
			'id_detso' => $id
		];
		$this->model->delete_data_dump($data);
		return redirect()->to('/so/tambah-so');
	}

	public function simpan_draft()
	{

		$couuunt = $this->model->countdump2();
		if ($couuunt > 0) {
			$status = $this->model->cekstatussimpan();
			if ($status > 0) {
				$data = [
					'id_user' => session()->get('id_user'),
					'status' => 'belum'
				];
			} else {
				$data = [
					'id_user' => session()->get('id_user'),
					'status' => 'sesuai'
				];
			}
			$id = [
				'id_so' => session()->get('id_so_g1'),
			];
			$id_so = session()->get('id_so_g1');
			$this->model->updateso($data, $id);
			$cekhapus=$this->model->tampil_detail_where($id_so);
// 			foreach($cekhapus as $hapuskan){
// 			    $id_hapuskan=[
// 			        'id_detso' => $hapuskan['id_detso']
// 			        ];
// 			    $this->model->delete_data_detail($id_hapuskan);
// 			}
			$this->model->pindah_dump($id_so);
			return redirect()->to($this->base_link);
		} else {
			session()->setFlashdata('pesan', 'Data transaksi tidak boleh kosong');
			return redirect()->to('/so/tambah-so');
		}
	}
	public function detail_so($id)
	{
		$data = [
			'title' => $this->juduldraft,
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		return view('/so/detail_so_lihat', $data);
	}
}
