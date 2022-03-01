<?php

namespace App\Models;

use CodeIgniter\Model;

class modreturminta extends Model
{
   protected $base = 'retminta';
   protected $detail = 'detretminta';
   //USED================================================
   public function tampilpermintaan()
   {
      return $this->db->table('permintaan')
         ->select('*')
         ->join('gudang', 'gudang.id_gudang=permintaan.tujuan')
         ->where('status', 'sudah dimasukan')
         ->get()->getResultArray();
   }

   public function tampildump()
   {
      return $this->db->table('dump_detretminta')
         ->select('*, dump_detretminta.jumlah as jumlah_retur, detpermintaan.jumlah as jumlah_minta')
         ->join('detpermintaan', 'detpermintaan.id_detpermintaan=dump_detretminta.id_detpermintaan')
         ->join('barang_c1', 'barang_c1.id_barang=detpermintaan.id_barang')
         ->join('ukuran', 'barang_c1.id_ukuran=ukuran.id_ukuran')
         ->join('cr', 'barang_c1.id_cr=cr.id_cr')
         ->join('berat', 'berat.id_berat=ukuran.id_berat')
         ->join('brand', 'brand.id_brand=berat.id_brand')
         ->get()->getResultArray();
   }
   public function tampildetpermintaan($id)
   {
      return $this->db->table('detpermintaan')
         ->select('*')
         ->join('barang_c1', 'barang_c1.id_barang=detpermintaan.id_barang')
         ->join('ukuran', 'barang_c1.id_ukuran=ukuran.id_ukuran')
         ->join('cr', 'barang_c1.id_cr=cr.id_cr')
         ->join('berat', 'berat.id_berat=ukuran.id_berat')
         ->join('brand', 'brand.id_brand=berat.id_brand')
         ->where('id_permintaan', $id)
         ->get()->getResultArray();
   }
   public function simpan_retminta($data)
   {
      return $this->db->table('retminta')
         ->insert($data);
   }
   public function tambah_dump_item($data)
   {
      return $this->db->table('dump_detretminta')
         ->insert($data);
   }
   public function hapus_dump_item($data)
   {
      return $this->db->table('dump_detretminta')
         ->delete($data);
   }
   public function edit_dump_item($data, $id)
   {
      return $this->db->table('dump_detretminta')
         ->update($data, $id);
   }
   public function ubah_status_minta($data, $id)
   {
      return $this->db->table('permintaan')
         ->update($data, $id);
   }
   public function count_retesan($id)
   {
      return $this->db->table('retminta')
         ->select('*')
         ->like('id_retminta', $id)
         ->countAllResults();
   }
   public function get_id_retesan($id)
   {
      return $this->db->table('retminta')
         ->select('id_retminta')
         ->like('id_retminta', $id)
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
   public function pindah_dump_retminta()
   {
      return $this->db->query("insert into detretminta select * from dump_detretminta");
   }
   public function delete_dump_retminta()
   {
      return $this->db->query("delete from dump_detretminta");
   }
   public function cek_barang($id)
   {
      return $this->db->table('dump_detretminta')
         ->select('*')
         ->join('detpermintaan', 'detpermintaan.id_detpermintaan=dump_detretminta.id_detpermintaan')
         ->where('id_barang', $id)
         ->countAllResults();
   }
   public function cek_jumlah($id)
   {
      return $this->db->table('detpermintaan')
         ->select('jumlah')
         ->where('id_barang', $id)
         ->get()->getResultArray();
   }
   public function tampil_terima_retur()
   {
      return $this->db->table('retminta')
         ->select('*, retminta.status as status_retur')
         ->join('detretminta', 'detretminta.id_retminta=retminta.id_retminta')
         ->join('detpermintaan', 'detpermintaan.id_detpermintaan=detretminta.id_detpermintaan')
         ->join('permintaan', 'detpermintaan.id_permintaan=permintaan.id_permintaan')
         ->join('gudang', 'gudang.id_gudang=permintaan.tujuan')
         ->where('retminta.status', 'sedang di retur')
         ->get()->getResultArray();
   }
   public function transaksiretur($id)
   {
      return $this->db->table('detretminta')
         ->select('*, detretminta.jumlah as jumlah_retur')
         ->join('detpermintaan', 'detretminta.id_detpermintaan=detpermintaan.id_detpermintaan')
         ->join('barang_c1', 'barang_c1.id_barang=detpermintaan.id_barang')
         ->join('cr', 'barang_c1.id_cr=cr.id_cr')
         ->join('ukuran', 'barang_c1.id_ukuran=ukuran.id_ukuran')
         ->join('berat', 'berat.id_berat=ukuran.id_berat')
         ->join('brand', 'brand.id_brand=berat.id_brand')
         ->where('id_retminta', $id)
         ->get()->getResultArray();
   }
   public function updatestok($data, $id)
   {
      return $this->db->table('barang_c1')
         ->update($data, $id);
   }
   public function updatestatus($data, $id)
   {
      return $this->db->table('retminta')
         ->update($data, $id);
   }
}
