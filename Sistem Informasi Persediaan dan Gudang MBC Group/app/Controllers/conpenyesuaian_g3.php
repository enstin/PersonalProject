<?php

namespace App\Controllers;

use App\Models\modpenyesuaianso_g3;
use CodeIgniter\HTTP\Request;
use mysqli;
use PDO;

class conpenyesuaian_g3 extends BaseController
{

	protected $model;
	protected $base_link;


	public function __construct()
	{
		$this->model = new modpenyesuaianso_g3();
		$this->base_link = '/jurnal_g3';
		$this->judul = 'JURNAL PENYESUAIAN';
		$this->juduldraft = 'DRAFT JURNAL PENYESUAIAN';
	}
	public function view()
	{

		$data = [
			'title' => $this->judul,
			'tb_sesuai' => $this->model->tampil_penyesuaian_belum(),
			'tb_so' => $this->model->tampil_so(),
			'link' => $this->base_link
		];
		return view('/penyesuaian/jurnal', $data);
	}
	public function trans($id)
	{
		session()->set(['id_so' => $id]);
		$id_soo = session()->get('id_so');
		$id_oso = explode('-', $id_soo);
		$id_pen = 'JPE-' . $id_oso[1] . "-" . $id_oso[2];
		session()->set(['id_pen' => $id_pen]);
		$idso = $this->model->ambil_iddpen($id);
		foreach ($idso as $soid) {
			$iddetail = $soid['id_detpenyesuaian'];
			$this->model->delete_dump($iddetail);
		}
		$kondisi = [
			'id_penyesuaian'  => $id_pen
		];
		$this->model->hapus_penyesuaian($kondisi);

		$data_sesuai = [
			'id_penyesuaian' => session()->get('id_pen'),
			'status' => 'belum',
		];
		$this->model->insert_penyesuaian($data_sesuai);
		return redirect()->to('/jurnal_g3/transaksi-penyesuaian/' . $id);
	}
	public function gotrans($id)
	{

		$data = [
			'title' => 'DRAFT JURNAL PENYESUAIAN',
			'table_data' => $this->model->tampil_detail($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/draftpenyesuaian', $data);
	}
	public function godettrans($id)
	{
		$data = [
			'title' => 'DETAIL DRAFT JURNAL PENYESUAIAN',
			'table_data' => $this->model->tampil_detdetail($id),
			'table_dump' => $this->model->tampil_dump($id),
			'data_id' => $this->model->tampil_iddetdetail($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/detdraftpenyelesaian', $data);
		// dd();
	}
	public function tambah_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id auto untuk detail
		$id_det = date('ymdHis'); //201120
		// dd($id_det);
		$set_id_detail = "Tdk-" . $id_det;
		//end generate
		$stat = "belum";
		$data = [
			'id_detpenyesuaian' => $set_id_detail,
			'id_penyesuaian' => session()->get('id_pen'),
			'id_detso' => $this->request->getVar('id_detail'),
			'tindakan' => $this->request->getVar('tindakan'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan'),
			'status' => $stat,
		];
		$id_det = $this->request->getVar('id_detail');
		$id_detbarang_su = $this->model->tampil_id_detbarang_su($id_det);
		$path = "/jurnal_g3/transaksi-detpenyesuaian/" . $id_det;
		// dd($data);
		try {
			$this->model->insert_dump($data);
			session()->setFlashdata('pesan1', 'Data Berhasil Disimpan.');
			return redirect()->to($path);
		} catch (\Exception $e) {
			session()->setFlashdata('pesan', 'Silahkan Lengkapi Data.');
			return redirect()->to($path);
		}
		$this->model->insert_dump($data);
		return redirect()->to($path);
	}
	public function hapus_draft($id)
	{
		$idpecah = explode('_', $id);
		$id_penyesuaian = $idpecah[0];
		$where = [
			'id_detpenyesuaian' => $id_penyesuaian,
		];
		$id_detso = $idpecah[1];
		$this->model->hapus_draft($where);
		$path = '/jurnal_g3/transaksi-detpenyesuaian/' . $id_detso;
		return redirect()->to($path);
	}
	public function simpan_draft()
	{
		// echo 'hhhhhhh';

		$d = session()->get('id_so');
		$pathh = "/jurnal_g3/transaksi-penyesuaian/" . $d;
		// dd($pathh);
		return redirect()->to($pathh);
	}
	public function selesai_draft()
	{

		$d = session()->get('id_penyesuaian');
		$pathh = "/jurnal_g3/transaksi-persetujuan/" . $d;
		// dd($pathh);
		return redirect()->to($pathh);
	}
	public function selesai_trans()
	{
		return redirect()->to('/jurnal_g3');
	}
	public function updateso()
	{
		$idcek = session()->get('id_pen');
		$cek = $this->model->count_detpersetujuan($idcek);
		$d = session()->get('id_so');
		if ($cek > 0) {
			$idso = $this->model->ambil_iddetso($d);
			foreach ($idso as $soid) {
				$iddetail = $soid['id_detpenyesuaian'];
				$this->model->pindah_dump($iddetail);
				$this->model->delete_dump($iddetail);
			}
			$id_so = [
				'id_so' => $d
			];
			$status = 'disesuaikan';
			$data = [
				'status' => $status,
			];
			$data_sesuai = [
				'status' => 'belum',
			];
			$datapenyesuaian = [
				'id_user' => session()->get('id_user')
			];
			$idsesuai = [
				'id_penyesuaian' => session()->get('id_pen')
			];
			$this->model->update_persetujuan($datapenyesuaian, $idsesuai);
			// $this->model->insert_penyesuaian($data_sesuai);
			$this->model->update_so($data, $id_so);
			return redirect()->to('/jurnal_g3');
		} else {
			echo session()->setFlashdata('pesan', 'belum ada penyesuaian yang dimasukan');
			return redirect()->to('/jurnal_g3/transaksi-penyesuaian/' . $d);
		}
	}
	//persetujuan
	public function updatepenyesuaian()
	{

		$d = session()->get('id_penyesuaian');
		$id_so = [
			'id_penyesuaian' => $d
		];
		$status = 'selesai disetujui';
		$data = [
			'status' => $status,
		];
		$this->model->update_persetujuan($data, $id_so);
		return redirect()->to('/jurnal_g3');
	}

	public function gosetuju($id)
	{

		session()->set(['id_penyesuaian' => $id]);

		$data = [
			'title' => 'DRAFT JURNAL PERSETUJUAN',
			'table_data' => $this->model->tampil_soset_det($id),
			'link' => $this->base_link
		];
		// dd($this->model->tampil_detail($id));
		return view('/penyesuaian/draftpersetujuan', $data);
	}
	public function godetsetuju($id)
	{
		session()->set(['id_detpenyesuaian' => $id]);
		$data = [
			'title' => 'DRAFT PERSETUJUAN',
			'table_data' => $this->model->tampil_detpersetujuan($id),
			'table_penyesuaian' => $this->model->tampil_penyesuaian($id),
			'link' => $this->base_link
		];
		return view('/penyesuaian/detdraftpersetujuan', $data);
	}

	public function setujuitambah($id)
	{
		$stok = $this->model->tampil_stok($id);
		foreach ($stok as $jumlah_stok) {
			// dd($jumlah_stok['jumlah_sesuai']);
			if ($jumlah_stok['convert'] == 'con1') {
				$data = [
					'stok_base' => $jumlah_stok['stok_base'] + $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui ditambah'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} elseif ($jumlah_stok['convert'] == 'con2') {
				$data = [
					'stok_con1' => $jumlah_stok['stok_con1'] + $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui ditambah'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} elseif ($jumlah_stok['convert'] == 'con3') {
				$data = [
					'stok_con2' => $jumlah_stok['stok_con2'] + $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui ditambah'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} else {
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', '???????????????');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			}
		}
	}

	public function setujuikurang($id)
	{
		$stok = $this->model->tampil_stok($id);
		foreach ($stok as $jumlah_stok) {
			if ($jumlah_stok['convert'] == 'con1') {
				$data = [
					'stok_base' => $jumlah_stok['stok_base'] - $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui dikurang'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} elseif ($jumlah_stok['convert'] == 'con2') {
				$data = [
					'stok_con1' => $jumlah_stok['stok_con1'] - $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui dikurang'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} elseif ($jumlah_stok['convert'] == 'con3') {
				$data = [
					'stok_con2' => $jumlah_stok['stok_con2'] - $jumlah_stok['jumlah_sesuai']
				];
				$id = [
					'id_detbarang' => $jumlah_stok['id_detbarang']
				];
				$this->model->updatestok($data, $id);
				$data_update_sesuai = [
					'status' => 'disetujui dikurang'
				];
				$id_update_sesuai = [
					'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
				];
				$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', 'Data berhasil di update.');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			} else {
				$id_rdr = session()->get('id_detpenyesuaian');
				session()->setFlashdata('pesan1', '???????????????');
				return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
			}
		}
	}
	public function tidak($id)
	{
		$stok = $this->model->tampil_stok($id);
		foreach ($stok as $jumlah_stok) {
			$data_update_sesuai = [
				'status' => 'Tidak disetujui'
			];
			$id_update_sesuai = [
				'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
			];
			$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
		}
		$id_rdr = session()->get('id_detpenyesuaian');
		session()->setFlashdata('pesan1', 'Data berhasil di update.');
		return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
	}
	public function setujuinone($id)
	{
		$stok = $this->model->tampil_stok($id);
		foreach ($stok as $jumlah_stok) {
			$data_update_sesuai = [
				'status' => 'Tidak dilakukan tindakan'
			];
			$id_update_sesuai = [
				'id_detpenyesuaian' => $jumlah_stok['id_detpenyesuaian']
			];
			$this->model->updatestatussesuai($data_update_sesuai, $id_update_sesuai);
		}
		$id_rdr = session()->get('id_detpenyesuaian');
		session()->setFlashdata('pesan1', 'Data berhasil di update.');
		return redirect()->to('/jurnal_g3/transaksi-detpersetujuan/' . $id_rdr);
	}
	public function cetakpenyesuaian($id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tglcet = date('m/d/Y');
		$etct = explode('/', $tglcet);
		$angkabulancetak = $etct[0];
		switch ($angkabulancetak) {
			case 01:
				$namablncetak = "Januari";
				break;
			case 02:
				$namablncetak = "Februari";
				break;
			case 03:
				$namablncetak = "Maret";
				break;
			case 04:
				$namablncetak = "April";
				break;
			case 05:
				$namablncetak = "Mei";
				break;
			case 06:
				$namablncetak = "Juni";
				break;
			case 07:
				$namablncetak = "Juli";
				break;
			case '08':
				$namablncetak = "Agustus";
				break;
			case '09':
				$namablncetak = "September";
				break;
			case 10:
				$namablncetak = "Oktober";
				break;
			case 11:
				$namablncetak = "November";
				break;
			case 12:
				$namablncetak = "Desember";
				break;
			default:;
				break;
		}
		// x = trn1;namabulan, y = trn2;namabulan2, etct = namabulancetak 
		$tglcetak = $etct[1] . " " . $namablncetak . " " . $etct[2];
		$judul = "DAFTAR PENYESUAIAN STOK OPNAME";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->model->cetakpenyesuaian($id),
		];
		return view('/berkas/berkaspenyesuaian', $data);
	}
}
