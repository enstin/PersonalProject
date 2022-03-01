<?php

namespace App\Models;

use CodeIgniter\Model;

class modso extends Model
{
   protected $so = 'so';
   public function view()
   {
      return $this->db->table($this->so)
         ->select('*')
         ->where('id_gudang', 'g1')
         ->where('status', 'belum')
         ->get()->getResultArray();
   }
   //Data Barang ==========================================================================
   public function data_barang()
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->get()->getResultArray();
   }
   //================== End Data Barang ==========================================================================
   public function tampil_dump()
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang = dump_detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_gudang', 'g1')
         ->get()->getResultArray();
   }
   public function tampil_dump_where($id)
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang = dump_detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_detso', $id)
         ->get()->getResultArray();
   }
   public function tampil_detail_where($id)
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->where('id_so', $id)
         ->get()->getResultArray();
   }
 public function delete_data_detail($id)
   {
      return $this->db->table('detso')
         ->delete($id);
   }
   public function insert_data($data)
   {
      return $this->db->table('dump_detso')
         ->insert($data);
   }
   public function count_data_so($data)
   {
      return $this->db->table('so')
         ->select('*')
         ->like('id_so', $data)
         ->countAllResults();
   }
   public function get_data_so($data)
   {
      return $this->db->table('so')
         ->select('id_so')
         ->like('id_so', $data)
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
  
   public function delete_data_dump($id)
   {
      return $this->db->table('dump_detso')
         ->delete($id);
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_detso");
   }
   public function pindah_dump($id)
   {
      return $this->db->query("insert into detso select * from dump_detso where id_so='" . $id . "'");
   }
   public function insert_so($data)
   {
      return $this->db->table('so')
         ->insert($data);
   }
   public function tampil_detail($id)
   {
      return $this->db->table('detso')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_so', $id)
         ->get()->getResultArray();
   }

   //=======================
   public function data_barangwhere($id)
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->where('id_detbarang', $id)
         ->get()->getResultArray();
   }
   public function update_dumpde($data, $id)
   {
      return $this->db->table('dump_detso')
         ->update($data, $id);
   }
   //==============================
   public function pilihbarang($id)
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->where('id_detbarang', $id)
         ->get()->getResultArray();
   }
   public function update_update($data, $id)
   {
      return $this->db->table('dump_detso')
         ->update($data, $id);
   }
   public function countdump($id)
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->where('id_detbarang', $id)
         ->countAllResults();
   }
   public function countdump2()
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('detbarang', 'dump_detso.id_detbarang=detbarang.id_detbarang')
         ->where('id_gudang', 'g1')
         ->countAllResults();
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
   public function optionsat($data)
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->where('id_detbarang', $data)
         ->get()->getResultArray();
   }
   public function cek_dump($id_detbarang, $convert)
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('detbarang.id_detbarang', $id_detbarang)
         ->where('convert', $convert)
         ->countAllResults();
   }
   public function cekstatussimpan()
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('so', 'so.id_so=dump_detso.id_so')
         ->where('id_gudang', 'g1')
         ->where("dump_detso.status != 'sesuai'")
         ->countAllResults();
   }
   public function cekdata()
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->get()->getResultArray();
   }
   public function hapus_base($id)
   {
      return $this->db->table('so')
         ->delete($id);
   }
   public function updateso($data, $id)
   {
      return $this->db->table('so')
         ->update($data, $id);
   }
   public function hapus_item($id)
   {
      return $this->db->table('dump_detso')
         ->delete($id);
   }
   public function prosesso($data)
   {
      return $this->db->table('so')
         ->insert($data);
   }
   // public function hapusbase1()
   // {
   //    return $this->db->query("delete from so where id_gudang='g1' and id_user=''");
   // }
}
