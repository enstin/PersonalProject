<?php

namespace App\Models;

use CodeIgniter\Model;

class modpermintaan_g3 extends Model
{
    protected $table = 'belanja';
    protected $permintaan = 'permintaan';

    public function tampilpermintaan()
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->join('gudang', 'gudang.id_gudang=permintaan.tujuan')
            ->get()->getResultArray();
    }
    public function tampilpermintaan_nonacc_tambah()
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->join('gudang', 'gudang.id_gudang=permintaan.tujuan')
            ->where('status', 'Diajukan-g3')
            ->orwhere('status', 'akan dikirim-g1')
            ->orwhere('status', 'dikirim-g1')
            ->get()->getResultArray();
    }
    public function tampilpermintaan_nonacc_terima()
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->join('gudang', 'gudang.id_gudang=permintaan.tujuan')
            ->where('status', 'dikirim-ke-g1')
            ->get()->getResultArray();
    }
    public function tampilpermintaanwhere($id)
    {
        return $this->db->table('dump_detpermintaan')
            ->select('*')
            ->join('detbarang', 'dump_detpermintaan.id_detbarang=detbarang.id_detbarang')
            ->join('cr', 'cr.id_cr=detbarang.id_cr')
            ->where('id_detpermintaan', $id)
            ->get()->getResultArray();
    }
    public function tampilpermintaan_nonacc_request()
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->join('gudang', 'gudang.id_gudang=permintaan.asal')
            ->where('status', 'Diajukan-g1')
            ->orwhere('status', 'akan dikirim-g3')
            ->get()->getResultArray();
    }
    public function tampilgudang()
    {
        return $this->db->table('gudang')
            ->select('*')
            ->get()->getResultArray();
    }
    public function tampildumpdetpermintaan()
    {
        return $this->db->table('dump_detpermintaan')
            ->select('*')
            ->join('permintaan', 'permintaan.id_permintaan=dump_detpermintaan.id_permintaan')
            ->join('detbarang', 'detbarang.id_detbarang=dump_detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('asal', 'g3')
            ->get()->getResultArray();
    }
    public function optionsatuan()
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_gudang', 'g1')
            ->get()->getResultArray();
    }
    public function optionsatuanwhere($data)
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->where('id_detbarang', $data)
            ->get()->getResultArray();
    }
    public function optionsatuanexcept($data)
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->whereNotIn('id_detbarang', $data)
            ->get()->getResultArray();
    }
    public function optionsat($data)
    {
        return $this->db->table('detbarang')
            ->select('satuan1,satuan2,satuan3')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->where('id_detbarang', $data)
            ->get()->getResultArray();
    }
    public function tambah_dump_item($data)
    {
        return $this->db->table('dump_detpermintaan')
            ->insert($data);
    }
    public function count_data_permintaan($data)
    {
        return $this->db->table('permintaan')
            ->select('*')
            ->like('id_permintaan', $data)
            ->countAllResults();
    }
    public function get_data_permintaan($data)
    {
        return $this->db->table('permintaan')
            ->selectMax('id_permintaan')
            ->like('id_permintaan', $data)
            ->get()->getResultArray();
    }
    public function hapus_dump_item($id)
    {
        return $this->db->table('dump_detpermintaan')
            ->delete($id);
    }
    public function update_dump_item($data, $id)
    {
        return $this->db->table('dump_detpermintaan')
            ->update($data, $id);
    }
    public function pindah_dump_permintaan()
    {
        return $this->db->query("insert into detpermintaan select * from dump_detpermintaan");
    }
    public function delete_dump_permintaan()
    {
        return $this->db->query("delete from dump_detpermintaan");
    }
    public function simpan_draft_permintaan($data)
    {
        return $this->db->table('permintaan')
            ->insert($data);
    }
    public function pindah_dump_nonacc($id)
    {
        return $this->db->query("insert into dump_detpermintaan select * from detpermintaan where id_permintaan='" . $id . "'");
    }
    public function delete_permintaan_nonacc($id)
    {
        return $this->db->query("delete from detpermintaan where id_permintaan='" . $id . "'");
    }
    public function cek_dumpisi($id)
    {
        return $this->db->table('dump_detpermintaan')
            ->select('*')
            ->join('permintaan', 'permintaan.id_permintaan=dump_detpermintaan.id_permintaan')
            ->where('dump_detpermintaan.id_permintaan', $id)
            ->countAllResults();
    }
    public function update_status($data, $id)
    {
        return $this->db->table('permintaan')
            ->update($data, $id);
    }
    public function cek_jumlah($id)
    {
        return $this->db->table('dump_detpermintaan')
            ->select('*')
            ->where('id_detbarang', $id)
            ->countAllResults();
    }
    public function cek_dump($id_detbarang, $convert)
    {
        return $this->db->table('dump_detpermintaan')
            ->select('*')
            ->join('permintaan', 'permintaan.id_permintaan=dump_detpermintaan.id_permintaan')
            ->join('detbarang', 'detbarang.id_detbarang=dump_detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('detbarang.id_detbarang', $id_detbarang)
            ->where('convert', $convert)
            ->where('asal', 'g3')
            ->countAllResults();
    }
    public function kirim_list($id)
    {
        return $this->db->table('detpermintaan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
            ->where('id_permintaan', $id)
            ->get()->getResultArray();
    }
    public function delete_dump_minta($id)
    {
        return $this->db->query("delete from dump_detpermintaan where id_permintaan='" . $id . "'");
    }
    public function pindah_dump_minta($id)
    {
        return $this->db->query("insert into detpermintaan select * from dump_detpermintaan where id_permintaan='" . $id . "'");
    }
    public function keluarstok($data, $id)
    {
        return $this->db->table('detbarang')
            ->update($data, $id);
    }
    public function kirim($id)
    {
        return $this->db->table('detpermintaan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_permintaan', $id)
            ->where('convert', 'con1')
            ->get()->getResultArray();
    }
    public function kirim_2($id)
    {
        return $this->db->table('detpermintaan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_permintaan', $id)
            ->where('convert', 'con2')
            ->get()->getResultArray();
    }
    public function kirim_3($id)
    {
        return $this->db->table('detpermintaan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_permintaan', $id)
            ->where('convert', 'con3')
            ->get()->getResultArray();
    }
    public function ubahdetpermintaan($data, $id)
    {
        return $this->db->table('detpermintaan')
            ->update($data, $id);
    }
    public function selectdelete()
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->where('status', 'kosong')
            ->where('asal', 'g3')
            ->get()->getResultArray();
    }
    public function selectmintahwere($id)
    {
        return $this->db->table($this->permintaan)
            ->select('*')
            ->where('id_permintaan', $id)
            ->get()->getResultArray();
    }
    public function tampildetpermintaan_dikirim($id)
    {
        return $this->db->table('detpermintaan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_permintaan', $id)
            ->get()->getResultArray();
    }
    public function tampilpermintaan_delete_lihat()
    {
        return $this->db->table('permintaan')
            ->select('*')
            ->where('status', 'Diajukan-g3')
            ->get()->getResultArray();
    }
    public function delete_minta($id)
    {
        return $this->db->query("delete from permintaan where id_permintaan='" . $id . "'");
    }
    public function delete_permintaan_cek($id)
    {
        return $this->db->query("delete from detpermintaan where id_detpermintaan='" . $id . "'");
    }


    public function getAllPermitaan($idpermintaan)
    {
        return $this->db->table("dump_detpermintaan")
            ->select("id_detbarang,jumlah,convert")
            ->where("id_permintaan", $idpermintaan)
            ->orderBy("convert", "ASC")
            ->get()->getResultArray();
    }


    public function getbarang($iddetbarang)
    {
        return $this->db->table("detbarang")
            ->select("id_cr,stok_base,stok_con1,stok_con2")
            ->where("id_detbarang", $iddetbarang)
            ->get()->getRowArray();
    }

    public function getCr($idcr)
    {
        return $this->db->table("cr")
            ->select("cr1,cr2,cr3")
            ->where("id_cr", $idcr)
            ->get()->getRowArray();
    }
}
