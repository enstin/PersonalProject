<?php

namespace App\Controllers;

use App\Models\modpemesanan;
use mysqli;
use PDO;

class conpemesanan extends BaseController
{

	protected $model;
	protected $base_link;
	protected $judul_pemesanan;
	protected $judul_pemesanan_disetujui;
	protected $judul_pemesanan_belum_disetujui;

	public function __construct()
	{
		$this->model = new modpemesanan();
		$this->base_link = '/pemesanan';
		$this->judul_pemesanan = 'PEMESANAN';
		$this->judul_pemesanan_disetujui = 'DETAIL PEMESANAN TERSETUJUI';
		$this->judul_pemesanan_belum_disetujui = 'DETAIL PEMESANAN';
	}

	public function viewpemesanan()
	{
		$this->model->delete_dump_pesan();
		$data = [
			'title' => $this->judul_pemesanan,
			'table_pemesanan' => $this->model->tampilpemesanannon_acc(),
			'table_data' => $this->model->tampilpemesanandi(),
			'link' => $this->base_link
		];
		return view('/pemesanan/pemesanan', $data);
	}
	public function viewsuplist()
	{
		date_default_timezone_set('Asia/Jakarta');
		//generate id belanja
		$id_sekarang = date('Ymd'); //20201120
		$cek_id_belanja = $this->model->count_data_pemesanan($id_sekarang);
		if ($cek_id_belanja > 0) {
			$max = $this->model->get_data_pemesanan($id_sekarang);
			foreach ($max as $get_id) {
			}
			$no = explode("-", $get_id['id_pesan']);
			$no_belakang = $no[2] + 1;
			if ($no_belakang <= 9) {
				$set_id = "PEM-" . $id_sekarang . "-00" . $no_belakang;
			} elseif ($no_belakang > 9 && $no_belakang < 100) {
				$set_id = "PEM-" . $id_sekarang . "-0" . $no_belakang;
			} elseif ($no_belakang > 99) {
				$set_id = "PEM-" . $id_sekarang . "-" . $no_belakang;
			}
		} else {
			$set_id = "PEM-" . $id_sekarang . "-001";
		}
		//end generate
		session()->set([
			'id_pemesanan' => $set_id,
		]);
		$data = [
			'title' => $this->judul_pemesanan,
			'tabel_supplier' => $this->model->tampilsupplier(),
			'link' => $this->base_link
		];
		return view('/pemesanan/suplist', $data);
	}
	public function viewdraftpemesanan($id_sup)
	{

		session()->set([
			'id_supplier' => $id_sup,
		]);
		$data = [
			'title' => 'DRAFT PEMESANAN',
			'table_dump' => $this->model->tampildumpdetpemesanan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link
		];
		return view('/pemesanan/draftpemesanan', $data);
	}
	public function viewdraftpemesananpil()
	{
		$data = [
			'title' => 'DRAFT PEMESANAN',
			'table_dump' => $this->model->tampildumpdetpemesanan(),
			'option_barangseleksi' => $this->model->optionsatuanexcept(session()->get('id_detbarang')),
			'option_barangbukanseleksi' => $this->model->optionsatuanwhere(session()->get('id_detbarang')),
			'link' => $this->base_link

		];
		return view('/pemesanan/draftpemesananpil', $data);
	}
	public function tambah_dump_item()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "DPEM-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$data = [
			'id_detpesan' => $set_id_detail,
			'id_pesan' => session()->get('id_pemesanan'),
			'id_detbarang' => $id_brg[0],
			'jumlah' => $this->request->getVar('jumlah'),
			'convert' => 'con1',
		];
		$cek = $this->model->cek_jumlah($id_brg[0]);
		$id_sup = session()->get('id_supplier');

		if ($cek > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah ditambahkan');
			return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
		} else {
			if ($id_brg[0] == NULL) {
				echo session()->setFlashdata('pesan', 'silahkan pilih barang terlebih dahulu');
				return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
			} else {
				echo session()->setFlashdata('pesan1', 'Barang berhasil ditambahkan');
				$this->model->tambah_dump_item($data);
				return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
			}
		}
	}
	public function hapus_dump_item($id)
	{
		$data = [
			'id_detpesan' => $id,
		];
		$this->model->hapus_dump_item($data);
		$id_sup = session()->get('id_supplier');
		return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
	}
	public function hapus_dump_item_non($id)
	{
		$data = [
			'id_detpesan' => $id,
		];
		$this->model->hapus_dump_item($data);
		$id_edit = session()->get('id_pemesanan_edit');
		return redirect()->to('/pemesanan/non-acc_view/' . $id_edit);
	}
	public function update_dump_item($id)
	{
		$data = [
			'jumlah' => $this->request->getVar('jumlah_update'),
		];
		$id = [
			'id_detpesan' => $id,
		];
		$this->model->update_dump_item($data, $id);
		$id_sup = session()->get('id_supplier');
		return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
	}
	public function update_dump_item_non($id)
	{
		$data = [
			'jumlah' => $this->request->getVar('jumlah_update'),
		];
		$id = [
			'id_detpesan' => $id,
		];
		$this->model->update_dump_item($data, $id);
		$id_edit = session()->get('id_pemesanan_edit');
		return redirect()->to('/pemesanan/non-acc_view/' . $id_edit);
	}
	public function simpendraft()
	{
		$data = [
			'id_pesan' => session()->get('id_pemesanan'),
			'id_user' => session()->get('id_user'),
			'id_supplier' => session()->get('id_supplier'),
			'status' => 'belum disetujui',
		];
		$id_sup = session()->get('id_supplier');
		// dd($data);
		$cekdump = $this->model->cekdump(session()->get('id_pemesanan'));
		if ($cekdump > 0) {
			$this->model->delete_pemesanan_nonacc(session()->get('id_pemesanan'));
			$this->model->pindah_dump_pesan();
			$this->model->delete_dump_pesan();
			$this->model->simpan_draft_pemesanan($data);
			return redirect()->to('/pemesanan');
		} else {
			echo session()->setFlashdata('pesan', 'silahkan isikan data terlebih dahulu');
			return redirect()->to('/pemesanan/go_tambah_pemesanan/' . $id_sup);
		}
	}
	public function viewdraftpemesanan_nonacc_1($id_pemesanan)
	{
		session()->set([
			'id_pemesanan_edit' => $id_pemesanan,
		]);
		$this->model->pindah_dump_nonacc($id_pemesanan);
		return redirect()->to('/pemesanan/non-acc_view/' . $id_pemesanan);
	}
	public function viewdraftpemesanan_nonacc($id_pemesanan)
	{
		$data = [
			'title' => 'DRAFT PEMESANAN',
			'table_dump' => $this->model->tampildumpdetpemesanan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link

		];
		// dd($id_pemesanan);
		return view('/pemesanan/detail_pemesanan_non_acc', $data);
	}
	public function viewdraftpemesanan_nonacc_next($id_pemesanan)
	{
		session()->set([
			'id_pemesanan_edit' => $id_pemesanan,
		]);
		$data = [
			'title' => 'DRAFT PEMESANAN',
			'table_dump' => $this->model->tampildumpdetpemesanan(),
			'option_barang' => $this->model->optionsatuan(),
			'link' => $this->base_link

		];
		return view('/pemesanan/detail_pemesanan_non_acc', $data);
	}
	public function viewdraftpemesanan_acc($id)
	{
// 		session()->set([
// 			'id_pemesanan' => $id_pemesanan,
// 		]);
// $oood=$id;
    // $a=$this->model->tampildetpemesananpil($oood);
        // dd($a);
		$data = [
			'title' => 'DRAFT PEMESANAN',
			'table_dump' => $this->model->tampildetpemesananpil($id),
			'link' => $this->base_link

		];
		return view('/pemesanan/detail_pemesanan_acc', $data);
	}
	public function simpendraft_nonacc()
	{
		$id_pemesanan = session()->get('id_pemesanan_edit');
		$this->model->delete_pemesanan_nonacc($id_pemesanan);
		$this->model->pindah_dump_pesan();
		$this->model->delete_dump_pesan();
		return redirect()->to('/pemesanan');
	}
	public function tambah_dump_item_nonacc()
	{
		date_default_timezone_set('Asia/Jakarta');
		$id_det = date('ymdHis'); //201120
		$set_id_detail = "DPEM-" . $id_det;
		$brg = $this->request->getVar('brg');
		$id_brg = explode("|", $brg);
		$jml = $this->request->getVar('jumlah');
		$data = [
			'id_detpesan' => $set_id_detail,
			'id_pesan' => session()->get('id_pemesanan_edit'),
			'id_detbarang' => $id_brg[0],
			'jumlah' => $this->request->getVar('jumlah'),
			'convert' => 'con1',
		];
		// dd($data);
		$cek = $this->model->cek_jumlah($id_brg[0]);
		if ($cek > 0) {
			echo session()->setFlashdata('pesan', 'Barang sudah pernah ditambahkan');
			$id_edit = session()->get('id_pemesanan_edit');
			return redirect()->to('/pemesanan/non-acc_view/' . $id_edit);
		} else {
			echo session()->setFlashdata('pesan1', 'Barang berhasil ditambahkan');
			$this->model->tambah_dump_item($data);
			$id_edit = session()->get('id_pemesanan_edit');
			return redirect()->to('/pemesanan/non-acc_view/' . $id_edit);
		}
	}
	//pemilik
	public function setujui($id)
	{
		$id_pesan = [
			'id_pesan' => $id
		];
		$data = [
			'status' => 'disetujui',
		];
		$this->model->update_status($data, $id_pesan);
		return redirect()->to('/pemesanan');
	}
    public function po($id)
	{
		// konversi
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
		$judul = "Surat Pemesanan";
		$data = [
			'title' => $judul,
			'tgl' => $tglcetak,
			'tabel' => $this->model->tampildetpemesananpil($id),
			'link' => '/laporan/bmasuk',
		];
		return view('/berkas/berkashistoripemesanan', $data);
	}


	//AJAX

	public function get_satuan()
	{
		$idbarang = $this->request->getPost("id");
		$opt = $this->model->optionsat($idbarang);
		foreach ($opt as $o) {
			if ($o['satuan1']) echo "<option value='con1''>{$o['satuan1']}</option>";
			if ($o['satuan2']) echo "<option value='con2''>{$o['satuan2']}</option>";
			if ($o['satuan3']) echo "<option value='con3''>{$o['satuan3']}</option>";
		}
	}
}
