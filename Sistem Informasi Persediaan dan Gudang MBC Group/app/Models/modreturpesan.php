<?php

namespace App\Models;

use CodeIgniter\Model;

class modreturpesan extends Model
{
   protected $base = 'retpesan';
   protected $detail = 'detretpesan';
   protected $dump = 'retur';
   //USED================================================
   public function tampilpemesanan()
   {
      return $this->db->table('pemesanan')
         ->select('*,pemesanan.status as status_pesan')
         ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
         ->where('pemesanan.status', 'sudah dimasukan')
         ->get()->getResultArray();
   }
   public function tampildump()
   {
      return $this->db->table('dump_detretpesan')
         ->select('*, dump_detretpesan.jumlah as jumlah_retur, detpemesanan.jumlah as jumlah_pesan')
         ->join('detpemesanan', 'detpemesanan.id_detpesan=dump_detretpesan.id_detpesan')
         ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->get()->getResultArray();
   }
   public function tampildetpemesanan($id)
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
   public function simpan_retpesan($data)
   {
      return $this->db->table('retpesan')
         ->insert($data);
   }
   public function tambah_dump_item($data)
   {
      return $this->db->table('dump_detretpesan')
         ->insert($data);
   }
   public function hapus_dump_item($data)
   {
      return $this->db->table('dump_detretpesan')
         ->delete($data);
   }
   public function edit_dump_item($data, $id)
   {
      return $this->db->table('dump_detretpesan')
         ->update($data, $id);
   }
   public function ubah_status_pesan($data, $id)
   {
      return $this->db->table('pemesanan')
         ->update($data, $id);
   }
   public function count_retesan($id)
   {
      return $this->db->table('retpesan')
         ->select('*')
         ->like('id_retpesan', $id)
         ->countAllResults();
   }
   public function get_id_retesan($id)
   {
      return $this->db->table('retpesan')
         ->select('id_retpesan')
         ->like('id_retpesan', $id)
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
   public function pindah_dump_retpesan()
   {
      return $this->db->query("insert into detretpesan select * from dump_detretpesan");
   }
   public function delete_dump_retpesan()
   {
      return $this->db->query("delete from dump_detretpesan");
   }
   public function cek_barang($id)
   {
      return $this->db->table('dump_detretpesan')
         ->select('*')
         ->join('detpemesanan', 'detpemesanan.id_detpesan=dump_detretpesan.id_detpesan')
         ->where('id_detbarang', $id)
         ->countAllResults();
   }
   public function cek_jumlah($id)
   {
      return $this->db->table('detpemesanan')
         ->select('jumlah')
         ->where('id_detpesan', $id)
         ->get()->getResultArray();
   }
   public function cek_jumlah_edit($id)
   {
      return $this->db->table('dump_detretpesan')
         ->select('*')
         ->join('detpemesanan', 'detpemesanan.id_detpesan=dump_detretpesan.id_detpesan')
         ->where('id_detretpesan', $id)
         ->get()->getResultArray();
   }
   // public function cek_jumlah_edit($id)
   // {
   //    return $this->db->query("select detpemesanan.jumlah as jumlah_pesan from detretpesan join detpemesanan on detpemesanan.id_detpesan=detretpesan.id_detpesan where id_detretpesan='" . $id . "'");
   // }
   public function tampil_terima_retur()
   {
      return $this->db->table('retpesan')
         ->select('*, retpesan.status as status_retur')
         ->join('detretpesan', 'detretpesan.id_retpesan=retpesan.id_retpesan')
         ->join('detpemesanan', 'detpemesanan.id_detpesan=detretpesan.id_detpesan')
         ->join('pemesanan', 'detpemesanan.id_pesan=pemesanan.id_pesan')
         ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
         ->where('retpesan.status', 'sedang di retur')
         ->groupBy('retpesan.id_retpesan')
         ->get()->getResultArray();
   }
   public function transaksiretur($id)
   {
      return $this->db->table('detretpesan')
         ->select('*, detretpesan.jumlah as jumlah_retur')
         ->join('detpemesanan', 'detretpesan.id_detpesan=detpemesanan.id_detpesan')
         ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_retpesan', $id)
         ->get()->getResultArray();
   }
   public function transaksiretur_1($id)
   {
      return $this->db->table('dump_detretpesan')
         ->select('*, dump_detretpesan.jumlah as jumlah_retur')
         ->join('detpemesanan', 'dump_detretpesan.id_detpesan=detpemesanan.id_detpesan')
         ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_retpesan', $id)
         ->get()->getResultArray();
   }
   public function transaksiretur_2($id)
   {
      return $this->db->table('dump_detretpesan')
         ->select('*, dump_detretpesan.jumlah as jumlah_retur')
         ->join('detpemesanan', 'dump_detretpesan.id_detpesan=detpemesanan.id_detpesan')
         ->join('detbarang', 'detbarang.id_detbarang=detpemesanan.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_retpesan', $id)
         ->countAllResults();
   }
   public function updatestok($data, $id)
   {
      return $this->db->table('detbarang')
         ->update($data, $id);
   }
   public function updatestatus($data, $id)
   {
      return $this->db->table('retpesan')
         ->update($data, $id);
   }
}
