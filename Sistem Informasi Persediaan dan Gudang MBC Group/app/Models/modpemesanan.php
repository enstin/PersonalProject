<?php

namespace App\Models;

use CodeIgniter\Model;

class modpemesanan extends Model
{
    protected $table = 'belanja';
    protected $pesan = 'pemesanan';
    //Data detbarang ==========================================================================
    public function data_detbarang()
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->get()->getResultArray();
    }
    public function tampilpemesanandi()
    {
        return $this->db->table('pemesanan')
            ->select('*')
            ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
            ->where('pemesanan.status', 'disetujui')
            ->get()->getResultArray();
    }
    public function data_detbarang_kurang()
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->where('kekurangan>', 0)
            ->get()->getResultArray();
    }
    //================== End Data detbarang ==========================================================================

    public function tampilpemesanan()
    {
        return $this->db->table($this->pesan)
            ->select('*')
            ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
            ->get()->getResultArray();
    }
    public function tampilpemesanannon_acc()
    {
        return $this->db->table($this->pesan)
            ->select('*,pemesanan.status as status_pesan')
            ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
            ->where('pemesanan.status', 'belum disetujui')
            ->orwhere('pemesanan.status', 'disetujui')
            ->get()->getResultArray();
    }
    public function tampilsupplier()
    {
        return $this->db->table('supplier')
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function tampildumpdetpemesanan()
    {
        return $this->db->table('dump_detpemesanan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=dump_detpemesanan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->get()->getResultArray();
    }
    public function tampildumpdetpemesananwhere($id)
    {
        return $this->db->table('dump_detpemesanan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=dump_detpemesanan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_pesan', $id)
            ->get()->getResultArray();
    }
    public function tampildetpemesanan()
    {
        return $this->db->table('detpemesanan')
            ->select('*')
            ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->get()->getResultArray();
    }
       public function tampildetpemesananpil($id)
    {
        return $this->db->table('detpemesanan')
            ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_pesan', $id)
            ->get()->getResultArray();
    }
    public function optionsatuan()
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('cr', 'detbarang.id_cr=cr.id_cr')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->join('barang', 'detbarang.id_barang=barang.id_barang')
            ->where('id_gudang', 'g1')
            ->where('detbarang.status', 'aktif')
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
        // dd($data);
        return $this->db->table('dump_detpemesanan')
            ->insert($data);
    }
    public function count_data_pemesanan($data)
    {
        return $this->db->table('pemesanan')
            ->select('*')
            ->like('id_pesan', $data)
            ->countAllResults();
    }
    public function get_data_pemesanan($data)
    {
        return $this->db->table('pemesanan')
            ->selectMax('id_pesan')
            ->like('id_pesan', $data)
            ->get()->getResultArray();
    }
    public function cekdump($data)
    {
        return $this->db->table('dump_detpemesanan')
            ->select('*')
            ->where('id_pesan', $data)
            ->countAllResults();
    }
    public function hapus_dump_item($id)
    {
        return $this->db->table('dump_detpemesanan')
            ->delete($id);
    }
    public function update_dump_item($data, $id)
    {
        return $this->db->table('dump_detpemesanan')
            ->update($data, $id);
    }
    public function pindah_dump_pesan()
    {
        return $this->db->query("insert into detpemesanan select * from dump_detpemesanan");
    }
    public function delete_dump_pesan()
    {
        return $this->db->query("delete from dump_detpemesanan");
    }
    public function delete_dump_pesan_non($id)
    {
        return $this->db->query("delete from dump_detpemesanan where id_detpesan='" . $id . "'");
    }
    public function simpan_draft_pemesanan($data)
    {
        return $this->db->table('pemesanan')
            ->insert($data);
    }
    public function pindah_dump_nonacc($id)
    {
        // dd($id);
        return $this->db->query("insert into dump_detpemesanan select * from detpemesanan where id_pesan='" . $id . "'");
    }
    public function delete_pemesanan_nonacc($id)
    {
        return $this->db->query("delete from detpemesanan where id_pesan='" . $id . "'");
    }
    public function update_status($data, $id)
    {
        return $this->db->table('pemesanan')
            ->update($data, $id);
    }
    public function cek_jumlah($id)
    {
        return $this->db->table('dump_detpemesanan')
            ->select('*')
            ->where('id_detbarang', $id)
            ->countAllResults();
    }
}
