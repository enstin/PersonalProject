<?php

namespace App\Models;

use CodeIgniter\Model;

class modkmasuk extends Model
{
   protected $kayu = 'kayu_masuk';
   protected $detkayu = 'det_kayu_masuk';
   //USED================================================
   protected $table = 'kayu_masuk';
   public function tampilhistori()
   {
      return $this->db->table('kayu_masuk')
         ->select('*')
         ->join('user','user.user=kayu_masuk.user')
         ->get()->getResultArray();
   }
   public function tampildump()
   {
      return $this->db->table('det_kayu_masuk')
         ->select('*')
         ->join('kayu','kayu.id_kayu=det_kayu_masuk.id_kayu')
         ->where('status', '0')
         ->get()->getResultArray();
   }
   public function tampiloption()
   {
      return $this->db->table('kayu')
         ->select('*')
         ->get()->getResultArray();
   }
   public function tampilseleksi($id)
   {
      return $this->db->table('kayu')
         ->select('*')
         ->where('id_kayu',$id)
         ->get()->getResultArray();
   }
   public function delete_dump()
   {
      return $this->db->query("delete from det_kayu_masuk where status='0'");
   }
   public function optionsat($data)
   {
      return $this->db->table('kayu')
         ->select('*')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->where('id_detbarang', $data)
         ->get()->getResultArray();
   }
   public function hapus_item($id)
   {
      return $this->db->table('det_kayu_masuk')
         ->delete($id);
   }
   public function hapus_kayu_masuk($id)
   {
      return $this->db->table('kayu_masuk')
         ->delete($id);
   }
   public function countkayu_masuk($id)
   {
      return $this->db->table('kayu_masuk')
         ->select('*')
         ->like('id_kayu_masuk', $id)
         ->countAllResults();
   }
   public function cekdata()
   {
      return $this->db->table('dump_detkayu_masuk')
         ->select('*')
         ->get()->getResultArray();
   }

   public function select_idkayu_masuk($id)
   {
      return $this->db->table('kayu_masuk')
         ->select('id_kayu_masuk')
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
   public function tambah_item($data)
   {
      return $this->db->table('det_kayu_masuk')
         ->insert($data);
   }
   public function proseskayu_masuk($data)
   {
      return $this->db->table('kayu_masuk')
         ->insert($data);
   }
   public function ubahstok($data, $id)
   {
      return $this->db->table('kayu')
         ->update($data, $id);
   }
   public function ubahstatus($data, $id)
   {
      return $this->db->table('det_kayu_masuk')
         ->update($data, $id);
   }
   public function updatekayu_masuk($data, $id)
   {
      return $this->db->table('det_kayu_masuk')
         ->update($data, $id);
   }
   public function pindah_dump($id)
   {
      return $this->db->query("insert into detkayu_masuk select * from dump_detkayu_masuk where id_kayu_masuk='" . $id . "'");
   }
   public function dump_update_item($data, $id)
   {
      return $this->db->table('dump_detkayu_masuk')
         ->update($data, $id);
   }
   public function tampilkayu_masukwhere($id)
   {
      return $this->db->table('dump_detkayu_masuk')
         ->select('*')
         ->join('detbarang', 'dump_detkayu_masuk.id_detbarang=detbarang.id_detbarang')
         ->join('cr', 'cr.id_cr=detbarang.id_cr')
         ->where('id_detkayu_masuk', $id)
         ->get()->getResultArray();
   }
   public function cekdumptambah()
   {
      return $this->db->table('dump_detkayu_masuk')
         ->select('*')
         ->join('kayu_masuk', 'kayu_masuk.id_kayu_masuk=dump_detkayu_masuk.id_kayu_masuk')
         ->where("dump_detkayu_masuk.id_kayu_masuk = (SELECT kayu_masuk.id_kayu_masuk FROM kayu_masuk ORDER BY id_kayu_masuk DESC LIMIT 1)")
         ->where('kayu_masuk.id_gudang', 'g1')
         ->countAllResults();
   }
   public function cekdettambah()
   {
      return $this->db->table('detkayu_masuk')
         ->select('*')
         ->join('kayu_masuk', 'kayu_masuk.id_kayu_masuk=detkayu_masuk.id_kayu_masuk')
         ->where("detkayu_masuk.id_kayu_masuk = (SELECT kayu_masuk.id_kayu_masuk FROM kayu_masuk ORDER BY id_kayu_masuk DESC LIMIT 1)")
         ->where('kayu_masuk.id_gudang', 'g1')
         ->countAllResults();
   }
   public function ambilidkeluar()
   {
      return $this->db->table('kayu_masuk')
         ->select('*')
         ->where('id_gudang', 'g1')
         ->orderBy('id_kayu_masuk', 'desc')
         ->limit(1)
         ->get()->getResultArray();
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
