<?php

namespace App\Models;

use CodeIgniter\Model;

class modpenyesuaianso extends Model
{
   protected $sesuai = 'penyesuaian';
   protected $so = 'so';
   protected $limit = ' limit 1,1';

   public function tampil_sesuai()
   {
      return $this->db->table($this->sesuai)
         ->select('*')
         ->get()->getResultArray();
   }
   public function tampil_so()
   {
      return $this->db->table($this->so)
         ->select('*')
         ->where('status', 'belum')
         ->get()->getResultArray();
   }
   public function tampil_detail($id)
   {
      $data = ['Sesuai'];
      return $this->db->table('detso')
         ->select('*')
         ->join('barang', 'barang.id_barang = detso.id_barang')
         ->whereNotIn('status', $data)
         ->where('id_so', $id)
         ->get()->getResultArray();
      // return $this->db->query("select * detso join barang on barang.id_barang = detso.id_barang where (status = 'Kurang' OR status= 'Lebih') AND where id_so = '" . $id . "'");
   }
   public function tampil_detailset($id)
   {
      return $this->db->table('detso')
         ->select('*')
         ->join('barang', 'barang.id_barang = detso.id_barang')
         ->where('id_so', $id)
         ->where('status', 'disesuaikan')
         ->get()->getResultArray();
   }
   public function tampil_soset()
   {
      return $this->db->table($this->so)
         ->select('*')
         ->where('status', 'disesuaikan')
         ->get()->getResultArray();
   }
   public function tampil_detdetail($id)
   {
      return $this->db->table('detso')
         ->select('*')
         ->join('barang', 'barang.id_barang = detso.id_barang')
         ->where('id_detso', $id)
         ->get()->getResultArray();
   }
   public function tampil_dump()
   {
      return $this->db->table('dump_penyesuaian')
         ->select('*')
         ->join('detso', 'dump_penyesuaian.id_detso = detso.id_detso')
         ->get()->getResultArray();
   }
   public function tampil_iddetdetail($id)
   {
      return $this->db->table('detso')
         ->select('id_detso')
         ->join('barang', 'barang.id_barang = detso.id_barang')
         ->where('id_detso', $id)
         ->get()->getResultArray();
   }
   public function tampil_idso($id)
   {
      return $this->db->table($this->so)
         ->select('id_so')
         ->where('id_so', $id)
         ->get()->getResultArray();
   }
   public function insert_dump($data)
   {
      return $this->db->table('dump_penyesuaian')
         ->insert($data);
   }
   public function hapus_draft($id)
   {
      return $this->db->table('dump_penyesuaian')
         ->delete($id);
   }
   public function pindah_dump()
   {
      return $this->db->query("insert into penyesuaian select * from dump_penyesuaian");
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_penyesuaian");
   }
   public function update_so($data, $id)
   {
      return $this->db->table('so')
         ->update($data, $id);
   }
   public function tampil_penyesuaian($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->where('id_detso', $id)
         ->get()->getResultArray();
   }
   public function update_penyesuaian($data, $id)
   {
      return $this->db->table('penyesuaian')
         ->update($data, $id);
   }
   public function tampil_stok($id)
   {
      return $this->db->table($this->sesuai)
         ->distinct('stok')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('barang', 'barang.id_barang=detso.id_barang')
         ->where('id_penyesuaian', $id)
         ->get()->getResultArray();
   }
   public function tampil_stok_sesuai($id)
   {
      return $this->db->table($this->sesuai)
         ->select('jumlah')
         ->where('id_penyesuaian', $id)
         ->get()->getResultArray();
   }
   public function updatestok($data, $id)
   {
      return $this->db->table('barang')
         ->update($data, $id);
   }
   public function tampil_id_barang($id)
   {

      return $this->db->table($this->sesuai)
         ->distinct()
         ->select('barang.id_barang')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('barang', 'barang.id_barang=detso.id_barang')
         ->where(['penyesuaian.id_penyesuaian' => $id])
         ->get()->getResultArray();
   }
   public function cetakpenyesuaian($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*,detso.status as stat')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->join('barang', 'barang.id_barang=detso.id_barang')
         ->where(['so.id_so' => $id])
         ->get()->getResultArray();
   }
   // public function tampil_id_detso2($id)
   // {
   //    return $this->db->table($this->sesuai)
   //       ->select('penyesuaian.id_detso')
   //       ->join('detso', 'detso.id_detso=detso.id_detso')
   //       ->join('barang', 'barang.id_barang=detso.id_barang')
   //       ->where('id_penyesuaian', $id)
   //       ->get()->getResultArray();
   // }
   // public function tampil_id_status($id)
   // {
   //    $this->db->table($this->sesuai)
   //       ->distinct('penyesuaian.status')
   //       ->join('detso', 'detso.id_detso=detso.id_detso')
   //       ->join('barang', 'barang.id_barang=detso.id_barang')
   //       ->where('id_penyesuaian', $id)
   //       ->get()->getResultArray();
   //    $cek = $this->db->getLastQuery();
   //    dd($cek);
   // }
   // public function tampil_id_bodon($id)
   // {
   //    return $this->db->query("select distinct barang.id_barang from penyesuaian join detso on penyesuaian.id_detso=detso.id_detso join barang on barang.id_barang=detso.id_barang where penyesuaian.id_penyesuaian ='" . $id . "'");
   // }

   // SELECT DISTINCT barang.id_barang,barang.stok,detso.id_detso FROM penyesuaian JOIN detso
   // ON detso.id_detso=detso.id_detso
   // JOIN barang
   // ON barang.id_barang=detso.id_barang
   // WHERE detso.id_detso="BRGSO-201214114509";
}
