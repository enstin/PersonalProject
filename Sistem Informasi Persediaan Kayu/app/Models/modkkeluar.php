<?php

namespace App\Models;

use CodeIgniter\Model;

class modkkeluar extends Model
{
   protected $kayu = 'kayu_keluar';
   protected $detkayu = 'det_kayu_keluar';
   //USED================================================
   protected $table = 'kayu_keluar';
   public function tampilhistori()
   {
      return $this->db->table('kayu_keluar')
         ->select('*')
         ->join('user','user.user=kayu_keluar.user')
         ->get()->getResultArray();
   }
   public function tampildump()
   {
      return $this->db->table('det_kayu_keluar')
         ->select('*')
         ->join('kayu','kayu.id_kayu=det_kayu_keluar.id_kayu')
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
      return $this->db->query("delete from det_kayu_keluar where status='0'");
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
      return $this->db->table('det_kayu_keluar')
         ->delete($id);
   }
   public function hapus_kayu_keluar($id)
   {
      return $this->db->table('kayu_keluar')
         ->delete($id);
   }
   public function countkayu_keluar($id)
   {
      return $this->db->table('kayu_keluar')
         ->select('*')
         ->like('id_kayu_keluar', $id)
         ->countAllResults();
   }
   public function cekdata()
   {
      return $this->db->table('dump_detkayu_keluar')
         ->select('*')
         ->get()->getResultArray();
   }

   public function select_idkayu_keluar($id)
   {
      return $this->db->table('kayu_keluar')
         ->select('id_kayu_keluar')
         ->orderBy('tanggal', 'desc')
         ->limit(1)
         ->get()->getResultArray();
   }
   public function tambah_item($data)
   {
      return $this->db->table('det_kayu_keluar')
         ->insert($data);
   }
   public function proseskayu_keluar($data)
   {
      return $this->db->table('kayu_keluar')
         ->insert($data);
   }
   public function ubahstok($data, $id)
   {
      return $this->db->table('kayu')
         ->update($data, $id);
   }
   public function ubahstatus($data, $id)
   {
      return $this->db->table('det_kayu_keluar')
         ->update($data, $id);
   }
   public function updatekayu_keluar($data, $id)
   {
      return $this->db->table('det_kayu_keluar')
         ->update($data, $id);
   }
   public function pindah_dump($id)
   {
      return $this->db->query("insert into detkayu_keluar select * from dump_detkayu_keluar where id_kayu_keluar='" . $id . "'");
   }
   public function dump_update_item($data, $id)
   {
      return $this->db->table('dump_detkayu_keluar')
         ->update($data, $id);
   }
   public function tampilkayu_keluarwhere($id)
   {
      return $this->db->table('dump_detkayu_keluar')
         ->select('*')
         ->join('detbarang', 'dump_detkayu_keluar.id_detbarang=detbarang.id_detbarang')
         ->join('cr', 'cr.id_cr=detbarang.id_cr')
         ->where('id_detkayu_keluar', $id)
         ->get()->getResultArray();
   }
   public function cekdumptambah()
   {
      return $this->db->table('dump_detkayu_keluar')
         ->select('*')
         ->join('kayu_keluar', 'kayu_keluar.id_kayu_keluar=dump_detkayu_keluar.id_kayu_keluar')
         ->where("dump_detkayu_keluar.id_kayu_keluar = (SELECT kayu_keluar.id_kayu_keluar FROM kayu_keluar ORDER BY id_kayu_keluar DESC LIMIT 1)")
         ->where('kayu_keluar.id_gudang', 'g1')
         ->countAllResults();
   }
   public function cekdettambah()
   {
      return $this->db->table('detkayu_keluar')
         ->select('*')
         ->join('kayu_keluar', 'kayu_keluar.id_kayu_keluar=detkayu_keluar.id_kayu_keluar')
         ->where("detkayu_keluar.id_kayu_keluar = (SELECT kayu_keluar.id_kayu_keluar FROM kayu_keluar ORDER BY id_kayu_keluar DESC LIMIT 1)")
         ->where('kayu_keluar.id_gudang', 'g1')
         ->countAllResults();
   }
   public function ambilidkeluar()
   {
      return $this->db->table('kayu_keluar')
         ->select('*')
         ->where('id_gudang', 'g1')
         ->orderBy('id_kayu_keluar', 'desc')
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
