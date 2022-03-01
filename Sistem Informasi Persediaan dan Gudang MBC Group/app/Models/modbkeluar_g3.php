<?php

namespace App\Models;

use CodeIgniter\Model;

class modbkeluar_g3 extends Model
{
   protected $masuk = 'bkeluar';
   //USED================================================
   protected $table = 'pbkeluar';
   public function tampilhistori()
   {
      return $this->db->table('bkeluar')
         ->select('*')
         ->join('detbkeluar', 'bkeluar.id_bkeluar=detbkeluar.id_bkeluar')
         ->join('detbarang', 'detbarang.id_detbarang=detbkeluar.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('detbarang.id_gudang', 'g3')
         ->get()->getResultArray();
   }
   public function tampildump()
   {
      return $this->db->table('dump_detbkeluar')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbkeluar.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_gudang', 'g3')
         ->get()->getResultArray();
   }
   public function updatebkeluar($data, $id)
   {
      return $this->db->table('bkeluar')
         ->update($data, $id);
   }
   public function hapus_bkeluar($id)
   {
      return $this->db->table('bkeluar')
         ->delete($id);
   }
   public function cekdata()
   {
      return $this->db->table('dump_detbkeluar')
         ->select('*')
         ->get()->getResultArray();
   }
   public function tampiloption()
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_gudang', 'g3')
         ->where('detbarang.status','aktif')
         ->get()->getResultArray();
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_detbkeluar");
   }
   public function optionsat($data)
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->where('id_detbarang', $data)
         ->get()->getResultArray();
   }
   public function hapus_item($id)
   {
      return $this->db->table('dump_detbkeluar')
         ->delete($id);
   }
   public function countbkeluar($id)
   {
      return $this->db->table('bkeluar')
         ->select('*')
         ->like('id_bkeluar', $id)
         ->countAllResults();
   }
   public function select_idbkeluar($id)
   {
      return $this->db->table('bkeluar')
         ->select('id_bkeluar')
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
   public function transaksikeluar()
   {
      return $this->db->table('dump_detbkeluar')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbkeluar.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->get()->getResultArray();
   }
   public function cek_dump($id_detbarang, $convert)
   {
      return $this->db->table('dump_detbkeluar')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbkeluar.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('detbarang.id_detbarang', $id_detbarang)
         ->where('convert', $convert)
         ->countAllResults();
   }
   public function tambah_dump_item($data)
   {
      return $this->db->table('dump_detbkeluar')
         ->insert($data);
   }
   public function prosesbkeluar($data)
   {
      return $this->db->table('bkeluar')
         ->insert($data);
   }
   public function keluarstok($data, $id)
   {
      return $this->db->table('detbarang')
         ->update($data, $id);
   }
   public function pindah_dump($id)
   {
      return $this->db->query("insert into detbkeluar select * from dump_detbkeluar where id_bkeluar='" . $id . "'");
   }
   public function dump_update_item($data, $id)
   {
      return $this->db->table('dump_detbkeluar')
         ->update($data, $id);
   }
   private function updateStok($id_detbarang, $stok_base, $stok)
   {
      $id_detbarang = [
         'id_detbarang' => $id_detbarang
      ];
      $data_stok = [
         $stok => $stok_base
      ];
      $this->model->keluarstok($data_stok, $id_detbarang);
   }

   private function hitungSelisih($butuh, $nilaiKonversi)
   {
      $hasilKonversi = 1;
      $loop = true;
      while ($loop) {
         if (($hasilKonversi * $nilaiKonversi) >= $butuh) {
            $loop = false;
         } else {
            $hasilKonversi++;
         }
      }
      return $hasilKonversi;
   }
   public function getstokbarang($idbarang, $idbrand)
   {
      return $this->db->table("detbarang")
         ->select("stok_base,stok_con1,stok_con2")
         ->where("id_barang", $idbarang)
         ->where("id_brand", $idbrand)
         ->where("id_gudang", session()->get('gudang'))
         ->get()
         ->getRowArray();
   }

   public function konversi($idkonversi)
   {
      return $this->db->table("cr")
         ->select("cr1,cr2,cr3")
         ->where("id_cr", $idkonversi)
         ->get()
         ->getRowArray();
   }
}
