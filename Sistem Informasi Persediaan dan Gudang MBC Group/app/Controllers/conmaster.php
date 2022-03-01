<?php

namespace App\Controllers;

use \App\Models\modmaster;
use mysqli;
use PDO;

class conmaster extends BaseController
{

	protected $modelmaster;
	// protected $db;
	public function __construct()
	{
		$this->modelmaster = new modmaster();
	}


	//============BRAND=================
	public function viewbrand()
	{
		$brand = $this->modelmaster->tampilbrand();
		// dd($jenis);
		$data = [
			'title' => 'DATA BRAND',
			'data_brand' => $brand,
			'link' => '/brand',
		];
		return view('/barang/data_sub/brand', $data);
	}
	public function hapusbrand($idbrand)
	{
		$id = [
			'id_brand' => $idbrand
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updatebrand($data, $id);
		return redirect()->to('/brand');
	}
	public function ubahbrand($idbrand)
	{
		$id = [
			'id_brand' => $idbrand
		];
		$data = [
			'brand' => $this->request->getVar('brand'),
		];
		$this->modelmaster->updatebrand($data, $id);
		return redirect()->to('/brand');
	}
	public function inputbrand()
	{
		$count_brand = $this->modelmaster->countbrand();
		if ($count_brand > 0) {
			$ambilbrand = $this->modelmaster->ambilbrand();
			foreach ($ambilbrand as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_brand']);
			$no_belakang = $no[1] + 1;
			if ($no_belakang <= 9) {
				$set_id = "BRD-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "BRD-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "BRD-" . $no_belakang;
			}
		} else {
			$set_id = "BRD-001";
		}
		session()->set([
			'id_brand' => $set_id
		]);
		$data = [
			'id_brand' => session()->get('id_brand'),
			'brand' => $this->request->getVar('brand'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertbrand($data);
		return redirect()->to('/brand');
	}
	//--------------------------------------------------------------------

	//============BERAT=================
	public function viewberat()
	{
		$berat = $this->modelmaster->tampilberat();
		// dd($jenis);
		$data = [
			'title' => 'DATA BERAT',
			'data_berat' => $berat,
			'link' => '/berat',
		];
		return view('/barang/data_sub/berat', $data);
	}

	public function hapusberat($idberat)
	{
		$id = [
			'id_berat' => $idberat
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updateberat($data, $id);
		return redirect()->to('/berat');
	}

	public function ubahberat($idberat)
	{
		$id = [
			'id_berat' => $idberat
		];
		$data = [
			'berat' => $this->request->getVar('berat') . ' gr',
		];
		$this->modelmaster->updateberat($data, $id);
		return redirect()->to('/berat');
	}

	public function inputberat()
	{
		$count_berat = $this->modelmaster->countberat();
		if ($count_berat > 0) {
			$ambilberat = $this->modelmaster->ambilberat();
			foreach ($ambilberat as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_berat']);
			$no_belakang = $no[1] + 1;
			if ($no_belakang <= 9) {
				$set_id = "BRT-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "BRT-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "BRT-" . $no_belakang;
			}
		} else {
			$set_id = "BRT-001";
		}
		session()->set([
			'id_berat' => $set_id
		]);
		$data = [
			'id_berat' => session()->get('id_berat'),
			'berat' => $this->request->getVar('berat') . ' ' . 'gr',
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertberat($data);
		return redirect()->to('/berat');
	}
	//--------------------------------------------------------------------


	//============UKURAN=================
	public function viewukuran()
	{
		$ukuran = $this->modelmaster->tampilukuran();
		// dd($jenis);
		$data = [
			'title' => 'DATA UKURAN',
			'data_ukuran' => $ukuran,
			'link' => '/ukuran',
		];
		return view('/barang/data_sub/ukuran', $data);
	}

	public function hapusukuran($idukuran)
	{

		$id = [
			'id_ukuran' => $idukuran
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updateukuran($data, $id);
		return redirect()->to('/ukuran');
	}

	public function ubahukuran($idukuran)
	{
		$id = [
			'id_ukuran' => $idukuran
		];
		$data = [
			'ukuran' => $this->request->getVar('ukuran'),
		];
		$this->modelmaster->updateukuran($data, $id);
		return redirect()->to('/ukuran');
	}

	public function inputukuran()
	{
		$count_ukuran = $this->modelmaster->countukuran();
		if ($count_ukuran > 0) {
			$ambilukuran = $this->modelmaster->ambilukuran();
			foreach ($ambilukuran as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_ukuran']);
			$no_belakang = $no[1] + 1;
			if ($no_belakang <= 9) {
				$set_id = "UKR-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "UKR-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "UKR-" . $no_belakang;
			}
		} else {
			$set_id = "UKR-001";
		}
		session()->set([
			'id_ukuran' => $set_id
		]);
		$data = [
			'id_ukuran' => session()->get('id_ukuran'),
			'ukuran' => $this->request->getVar('ukuran'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertukuran($data);
		return redirect()->to('/ukuran');
	}
	//--------------------------------------------------------------------

	//============BARANG=================
	public function viewbarang()
	{
		$barang = $this->modelmaster->tampilbarang();
		// dd($jenis);
		$data = [
			'title' => 'DATA BARANG',
			'data_barang' => $barang,
			'link' => '/barang',
		];
		return view('/barang/barang', $data);
	}
	public function viewbarang_g1()
	{
		$barang = $this->modelmaster->tampilbarang_g1();

		$data = [
			'title' => 'DATA BARANG',
			'data_barang' => $barang,
			'link' => '/barang',
		];
		return view('/barang/barang_stok', $data);
	}
	public function viewbarang_g2()
	{
		$barang = $this->modelmaster->tampilbarang_g2();

		$data = [
			'title' => 'DATA BARANG',
			'data_barang' => $barang,
			'link' => '/barang',
		];
		return view('/barang/barang_stok', $data);
	}
	public function viewbarang_g3()
	{
		$barang = $this->modelmaster->tampilbarang_g3();

		$data = [
			'title' => 'DATA BARANG',
			'data_barang' => $barang,
			'link' => '/barang',
		];
		return view('/barang/barang_stok', $data);
	}
	public function viewdetbarang($id)
	{
		session()->set([
			'id_barang' => $id
		]);
		$barang = $this->modelmaster->tampildetbarang($id);
		$brand = $this->modelmaster->optionubrand();
		$berat = $this->modelmaster->optionuberat();
		$ukuran = $this->modelmaster->optionukuran();
		$cr = $this->modelmaster->optioncr();
		// dd($jenis);
		$data = [
			'title' => 'DATA DETAIL BARANG',
			'data_barang' => $barang,
			'data_brand' => $brand,
			'data_berat' => $berat,
			'data_ukuran' => $ukuran,
			'data_cr' => $cr,
			'link' => '/detbarang',
		];
		return view('/barang/detail_barang', $data);
	}

	public function hapusbarang($idbarang)
	{
		$id = [
			'id_barang' => $idbarang
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updatebarang($data, $id);
		return redirect()->to('/barang');
	}
	public function hapusdetbarang($idbarang)
	{
		$id_explode = explode('-', $idbarang);
		$id_detbarang_g1 = $idbarang;
		$id_detbarang_g2 = $id_explode[0] . '-' . $id_explode[1] . '-' . $id_explode[2] . '-' . $id_explode[3] . '-' . $id_explode[4] . '-' . $id_explode[5] . '-g2';
		$id_detbarang_g3 = $id_explode[0] . '-' . $id_explode[1] . '-' . $id_explode[2] . '-' . $id_explode[3] . '-' . $id_explode[4] . '-' . $id_explode[5] . '-g3';
		$data = [
			'status' => 'tidak',
			'stok_base' => 0,
			'stok_con1' => 0,
			'stok_con2' => 0,
		];
		$id1 = [
			'id_detbarang' => $id_detbarang_g1
		];
		$id2 = [
			'id_detbarang' => $id_detbarang_g2
		];
		$id3 = [
			'id_detbarang' => $id_detbarang_g3
		];
		$this->modelmaster->updatedetbarang($data, $id1);
		$this->modelmaster->updatedetbarang($data, $id2);
		$this->modelmaster->updatedetbarang($data, $id3);
		$path = '/detbarang/' . session()->get('id_barang');
		return redirect()->to($path);
	}

	public function ubahbarang($idbarang)
	{
		$id = [
			'id_barang' => $idbarang
		];
		$data = [
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
		];
		$this->modelmaster->updatebarang($data, $id);
		return redirect()->to('/barang');
	}

	public function ubahdetbarang($idbarang)
	{
		$id = [
			'id_barang' => $idbarang
		];
		$data = [
			'id_barang' => session()->get('id_barang'),
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
		];
		$this->modelmaster->updatebarang($data, $id);
		return redirect()->to('/barang');
	}
	public function deletedetbarang($idbarang)
	{
		$id = [
			'id_barang' => $idbarang
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updatebarang($data, $id);
		return redirect()->to('/barang');
	}

	public function inputdetbarang()
	{
		$barang = session()->get('id_barang');
		$ukuran = $this->request->getVar('ukuran');
		$berat = $this->request->getVar('berat');
		$brand = $this->request->getVar('brand');
		$cr = $this->request->getVar('cr');
		$explode_ukuran = explode('-', $ukuran);
		$explode_berat = explode('-', $berat);
		$explode_brand = explode('-', $brand);
		$explode_barang = explode('-', $barang);
		$explode_cr = explode('-', $cr);
		$id_input1 = 'db-' . $explode_barang[1] . '-' . $explode_brand[1] . '-' . $explode_berat[1] . '-' . $explode_ukuran[1] . '-' . $explode_cr[1] . '-g1';
		$id_input2 = 'db-' . $explode_barang[1] . '-' . $explode_brand[1] . '-' . $explode_berat[1] . '-' . $explode_ukuran[1] . '-' . $explode_cr[1] . '-g2';
		$id_input3 = 'db-' . $explode_barang[1] . '-' . $explode_brand[1] . '-' . $explode_berat[1] . '-' . $explode_ukuran[1] . '-' . $explode_cr[1] . '-g3';
		$data1 = [
			'id_barang' => $barang,
			'id_detbarang' => $id_input1,
			'id_ukuran' => $this->request->getVar('ukuran'),
			'id_brand' => $this->request->getVar('brand'),
			'id_berat' => $this->request->getVar('berat'),
			'id_cr' => $this->request->getVar('cr'),
			'stok_base' => 0,
			'stok_con1' => 0,
			'stok_con2' => 0,
			'id_gudang' => 'g1',
			'status' => 'aktif'
		];
		$data2 = [
			'id_barang' => $barang,
			'id_detbarang' => $id_input2,
			'id_ukuran' => $this->request->getVar('ukuran'),
			'id_brand' => $this->request->getVar('brand'),
			'id_berat' => $this->request->getVar('berat'),
			'id_cr' => $this->request->getVar('cr'),
			'stok_base' => 0,
			'stok_con1' => 0,
			'stok_con2' => 0,
			'id_gudang' => 'g2',
			'status' => 'aktif'
		];
		$data3 = [
			'id_barang' => $barang,
			'id_detbarang' => $id_input3,
			'id_ukuran' => $this->request->getVar('ukuran'),
			'id_brand' => $this->request->getVar('brand'),
			'id_berat' => $this->request->getVar('berat'),
			'id_cr' => $this->request->getVar('cr'),
			'stok_base' => 0,
			'stok_con1' => 0,
			'stok_con2' => 0,
			'id_gudang' => 'g3',
			'status' => 'aktif'
		];
		// echo $set_id;
		$path = '/detbarang/' . session()->get('id_barang');
		$cek = $this->modelmaster->countdetbarang($id_input1);
		$cek2 = $this->modelmaster->countdetbarang2($id_input1);
		if ($cek > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah ditambahkan dengan atribut tersebut');
			return redirect()->to($path);
		} else {
			if ($cek2 > 0) {
				$iup1 = [
					'id_detbarang' => $id_input1
				];
				$iup2 = [
					'id_detbarang' => $id_input1
				];
				$iup3 = [
					'id_detbarang' => $id_input1
				];
				$dup = [
					'status' => 'aktif',
				];
				$this->modelmaster->updatedetbarang($dup, $iup1);
				$this->modelmaster->updatedetbarang($dup, $iup2);
				$this->modelmaster->updatedetbarang($dup, $iup3);
				return redirect()->to($path);
				// dd($cek2);
			} else {
				$this->modelmaster->insertbarangdetail($data1);
				$this->modelmaster->insertbarangdetail($data2);
				$this->modelmaster->insertbarangdetail($data3);
				echo session()->setFlashdata('pesan1', 'Barang berhasil diinput');
				return redirect()->to($path);
			}
		}
	}
	public function inputbarang()
	{
		$count_barang = $this->modelmaster->countbarang();
		if ($count_barang > 0) {
			$ambilbarang = $this->modelmaster->ambilbarang();
			foreach ($ambilbarang as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_barang']);
			$no_belakang = $no[1] + 1;
			$set_id = "BRG-" . $no_belakang;
			if ($no_belakang <= 9) {
				$set_id = "BRG-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "BRG-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "BRG-" . $no_belakang;
			}
		} else {
			$set_id = "BRG-001";
		}
		session()->set([
			'id_barang' => $set_id
		]);
		$data = [
			'id_barang' => session()->get('id_barang'),
			'nama' => $this->request->getVar('nama'),
			'jenis' => $this->request->getVar('jenis'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertbarang($data);
		return redirect()->to('/barang');
	}
	//--------------------------------------------------------------------

	//============Conversion rate=================
	public function viewcr()
	{
		$cr = $this->modelmaster->tampilcr();
		// dd($jenis);
		$data = [
			'title' => 'DATA CONVERTION RATE',
			'data_cr' => $cr,
			'link' => '/cr',
		];
		return view('/barang/data_sub/cr', $data);
	}
	public function hapuscr($idcr)
	{
		$id = [
			'id_cr' => $idcr
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updatecr($data, $id);
		return redirect()->to('/cr');
	}
	public function ubahcr($idcr)
	{
		$id = [
			'id_cr' => $idcr
		];
		$data = [
			'cr2' => $this->request->getVar('cr2'),
			'cr3' => $this->request->getVar('cr3'),
		];
		$this->modelmaster->updatecr($data, $id);
		return redirect()->to('/cr');
	}
	public function inputcr()
	{
		$count_cr = $this->modelmaster->countcr();
		if ($count_cr > 0) {
			$ambilcr = $this->modelmaster->ambilcr();
			foreach ($ambilcr as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_cr']);
			$no_belakang = $no[1] + 1;
			if ($no_belakang <= 9) {
				$set_id = "CR-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "CR-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "CR-" . $no_belakang;
			}
		} else {
			$set_id = "CR-001";
		}
		session()->set([
			'id_cr' => $set_id
		]);
		$ex = explode('-', $this->request->getVar('satuan1'));
		$data = [
			'id_cr' => session()->get('id_cr'),
			'satuan1' => $ex[0],
			'satuan2' => $ex[1],
			'satuan3' => $ex[2],
			'cr1' => 1,
			'cr2' => $this->request->getVar('cr2'),
			'cr3' => $this->request->getVar('cr3'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertcr($data);
		return redirect()->to('/cr');
	}
	//--------------------------------------------------------------------

	//============USER=================
	public function viewuser()
	{
		$user = $this->modelmaster->tampiluser();
		$gudang = $this->modelmaster->optiongudang();
		// dd($jenis);
		$data = [
			'title' => 'DATA USER',
			'data_user' => $user,
			'data_gudang' => $gudang,
			'link' => '/user',
		];
		return view('/barang/data_sub/user', $data);
	}

	public function hapususer($iduser)
	{
		$id = [
			'id_user' => $iduser
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updateuser($data, $id);
		return redirect()->to('/user');
	}

	public function ubahuser($iduser)
	{
		$id = [
			'id_user' => $iduser
		];
		$data = [
			'nama' => $this->request->getVar('user'),
			'jabatan' => $this->request->getVar('jabatan'),
			'password' => $this->request->getVar('password'),
			'id_gudang' => $this->request->getVar('idgudang'),
		];
		$this->modelmaster->updateuser($data, $id);
		return redirect()->to('/user');
	}

	public function inputuser()
	{
		$data = [
			'id_user' => $this->request->getVar('iduser'),
			'password' => $this->request->getVar('password'),
			'nama' => $this->request->getVar('user'),
			'jabatan' => $this->request->getVar('jabatan'),
			'id_gudang' => $this->request->getVar('idgudang'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertuser($data);
		return redirect()->to('/user');
	}
	//--------------------------------------------------------------------


	//============supplier=================
	public function viewsupplier()
	{
		$supplier = $this->modelmaster->tampilsupplier();
		// dd($jenis);
		$data = [
			'title' => 'DATA supplier',
			'data_supplier' => $supplier,
			'link' => '/supplier',
		];
		return view('/barang/data_sub/supplier', $data);
	}

	public function hapussupplier($idsupplier)
	{
		$id = [
			'id_supplier' => $idsupplier
		];
		$data = [
			'status' => 'tidak',
		];
		$this->modelmaster->updatesupplier($data, $id);
		return redirect()->to('/supplier');
	}

	public function ubahsupplier($idsupplier)
	{
		$id = [
			'id_supplier' => $idsupplier
		];
		$data = [
			'nama_perusahaan' => $this->request->getVar('nama_perusahaan'),
			'penanggungjawab' => $this->request->getVar('penanggungjawab'),
			'telpon' => $this->request->getVar('telpon'),
			'alamat' => $this->request->getVar('alamat'),
		];
		$this->modelmaster->updatesupplier($data, $id);
		return redirect()->to('/supplier');
	}

	public function inputsupplier()
	{
		$count_cr = $this->modelmaster->countsup();
		if ($count_cr > 0) {
			$ambilcr = $this->modelmaster->ambilsup();
			foreach ($ambilcr as $get_id) {
			}
			// dd($get_id);
			$no = explode("-", $get_id['id_supplier']);
			$no_belakang = $no[1] + 1;
			if ($no_belakang <= 9) {
				$set_id = "SUP-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "SUP-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "SUP-" . $no_belakang;
			}
		} else {
			$set_id = "SUP-001";
		}
		session()->set([
			'id_supplier' => $set_id
		]);

		$data = [
			'id_supplier' => session()->get('id_supplier'),
			'nama_perusahaan' => $this->request->getVar('nama_perusahaan'),
			'penanggungjawab' => $this->request->getVar('penanggungjawab'),
			'telpon' => $this->request->getVar('telpon'),
			'alamat' => $this->request->getVar('alamat'),
			'status' => 'aktif'
		];
		// echo $set_id;
		$this->modelmaster->insertsupplier($data);
		return redirect()->to('/supplier');
	}
	//--------------------------------------------------------------------




	public function ambildatabrand()
	{
		if ($this->request->isAJAX()) {
			$caridata = $this->request->getGet('search');
			$databrand =  $this->modelmaster->tampilbrand();
			$countbrand = $this->modelmaster->countbrand();
			$list = [];
			$key = 0;
			if ($countbrand > 0) {
				foreach ($databrand as $tampilkeunbrand) {
					$list[$key]['id'] = $tampilkeunbrand['idbrand'];
					$list[$key]['text'] = $tampilkeunbrand['brand'];
					$key++;
				}
				echo json_encode($list);
			}
		}
	}
	public function ambildataberat()
	{
		$brand = $this->request->getVar('brand');
		$databerat = $this->modelmaster->get_ajax_berat($brand);
		$isi = "";
		foreach ($databerat as $tampilkeunberat) {
			$isi .= '<option> value="' . $tampilkeunberat['idberat'] . '">' . $tampilkeunberat['nama'] . '</option>';
		}
		$msg = [
			'data' => $isi
		];
		echo json_encode($msg);
	}
}
