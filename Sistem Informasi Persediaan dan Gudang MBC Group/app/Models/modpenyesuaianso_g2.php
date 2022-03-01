<?php

namespace App\Models;

use CodeIgniter\Model;

class modpenyesuaianso_g2 extends Model
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
         ->where('id_gudang', 'g2')
         ->get()->getResultArray();
   }
   public function tampil_detail($id)
   {
      $data = ['Sesuai'];
      return $this->db->table('detso')
         ->select('*,detso.id_detso as desyo')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->whereNotIn('detso.status', $data)
         ->where('id_so', $id)
         ->get()->getResultArray();
      // return $this->db->query("select * detso join barang on detbarang.id_detbarang = detso.id_detbarang where (status = 'Kurang' OR status= 'Lebih') AND where id_so = '" . $id . "'");
   }
   public function tampil_detailset($id)
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
         ->where('so.status', 'disesuaikan')
         ->get()->getResultArray();
   }
   public function tampil_soset()
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->where('penyesuaian.status', 'belum')
         ->get()->getResultArray();
   }
   public function count_detpersetujuan($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->join('dump_detpenyesuaian', 'penyesuaian.id_penyesuaian=dump_detpenyesuaian.id_penyesuaian')
         ->where('dump_detpenyesuaian.id_penyesuaian', $id)
         ->countAllResults();
   }
   public function tampil_penyesuaian_belum()
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->where('penyesuaian.status', 'belum')
         ->where('id_gudang', 'g2')
         ->get()->getResultArray();
   }
   public function tampil_soset_det($id)
   {
      return $this->db->table('detpenyesuaian')
         ->select('*')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_penyesuaian', $id)
         ->get()->getResultArray();
   }
   public function tampil_soset_item($id)
   {
      return $this->db->table('detpenyesuaian')
         ->select('*')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->where('id_penyesuaian', $id)
         ->get()->getResultArray();
   }
   public function tampil_detdetail($id)
   {
      return $this->db->table('detso')
         ->select('*,detso.status as status_so')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_detso', $id)
         ->get()->getResultArray();
   }
   public function tampil_detpersetujuan($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_detpenyesuaian', $id)
         ->get()->getResultArray();
   }
   public function tampil_dump($id_so)
   {
      return $this->db->table('dump_detpenyesuaian')
         ->select('*')
         ->join('detso', 'dump_detpenyesuaian.id_detso = detso.id_detso')
         ->where('detso.id_detso', $id_so)
         ->get()->getResultArray();
   }
   public function tampil_iddetdetail($id)
   {
      return $this->db->table('detso')
         ->select('id_detso')
         ->join('detbarang', 'detbarang.id_detbarang = detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
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
      return $this->db->table('dump_detpenyesuaian')
         ->insert($data);
   }
   public function hapus_draft($id)
   {
      return $this->db->table('dump_detpenyesuaian')
         ->delete($id);
   }
   public function pindah_dump($id)
   {
      return $this->db->query("insert into detpenyesuaian select * from dump_detpenyesuaian where id_detpenyesuaian='" . $id . "'");
   }
   public function delete_dump($id)
   {
      return $this->db->query("delete from dump_detpenyesuaian where id_detpenyesuaian='" . $id . "'");
   }
   public function update_so($data, $id)
   {
      return $this->db->table('so')
         ->update($data, $id);
   }
   public function tampil_penyesuaian($id)
   {
      return $this->db->table('detpenyesuaian')
         ->select('*')
         ->where('id_detpenyesuaian', $id)
         ->get()->getResultArray();
   }
   public function tampil_penyesuaian_nowhere($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->get()->getResultArray();
   }
   public function update_penyesuaian($data, $id)
   {
      return $this->db->table('penyesuaian')
         ->update($data, $id);
   }
   public function insert_penyesuaian($data)
   {
      return $this->db->table('penyesuaian')
         ->insert($data);
   }
   public function tampil_stok($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*,detpenyesuaian.jumlah as jumlah_sesuai, detpenyesuaian.status as satus_sesuai')
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detpenyesuaian.id_detso=detso.id_detso')
         ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_detpenyesuaian', $id)
         ->limit(1)
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
      return $this->db->table('detbarang')
         ->update($data, $id);
   }
   public function updatestatussesuai($data, $id)
   {
      return $this->db->table('detpenyesuaian')
         ->update($data, $id);
   }
   public function tampil_id_detbarang($id)
   {
      return $this->db->table($this->sesuai)
         ->distinct()
         ->select('detbarang.id_detbarang')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where(['penyesuaian.id_penyesuaian' => $id])
         ->get()->getResultArray();
   }
   public function tampil_id_detbarang_su($id)
   {
      return $this->db->table('detpenyesuaian')
         ->select('detbarang.id_detbarang')
         ->join('detso', 'detpenyesuaian.id_detso=detso.id_detso')
         ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
         ->where('id_detpenyesuaian', $id)
         ->get()->getResultArray();
   }
   public function cetakpenyesuaian($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*,detso.status as stat')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where(['so.id_so' => $id])
         ->get()->getResultArray();
   }
   public function tampi($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*,detso.status as stat')
         ->join('detso', 'penyesuaian.id_detso=detso.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where(['so.id_so' => $id])
         ->get()->getResultArray();
   }
   public function ambil_iddetso($id)
   {
      return $this->db->table('detso')
         ->select('*')
         ->join('dump_detpenyesuaian', 'dump_detpenyesuaian.id_detso = detso.id_detso')
         ->where('id_so', $id)
         ->get()->getResultArray();
   }
   public function ambil_iddpen($id)
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->where('id_penyesuaian', $id)
         ->get()->getResultArray();
   }
   public function update_persetujuan($data, $id)
   {
      return $this->db->table('penyesuaian')
         ->update($data, $id);
   }
   public function hapus_penyesuaian($id)
   {
      return $this->db->table('penyesuaian')
         ->delete($id);
   }

   // public function tampil_id_detso2($id)
   // {
   //    return $this->db->table($this->sesuai)
   //       ->select('penyesuaian.id_detso')
   //       ->join('detso', 'detso.id_detso=detso.id_detso')
   //       ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
   //       ->where('id_penyesuaian', $id)
   //       ->get()->getResultArray();
   // }
   // public function tampil_id_status($id)
   // {
   //    $this->db->table($this->sesuai)
   //       ->distinct('penyesuaian.status')
   //       ->join('detso', 'detso.id_detso=detso.id_detso')
   //       ->join('detbarang', 'detbarang.id_detbarang=detso.id_detbarang')
   //       ->where('id_penyesuaian', $id)
   //       ->get()->getResultArray();
   //    $cek = $this->db->getLastQuery();
   //    dd($cek);
   // }
   // public function tampil_id_bodon($id)
   // {
   //    return $this->db->query("select distinct detbarang.id_detbarang from penyesuaian join detso on penyesuaian.id_detso=detso.id_detso join barang on detbarang.id_detbarang=detso.id_detbarang where penyesuaian.id_penyesuaian ='" . $id . "'");
   // }

   // SELECT DISTINCT detbarang.id_detbarang,barang.stok,detso.id_detso FROM penyesuaian JOIN detso
   // ON detso.id_detso=detso.id_detso
   // JOIN barang
   // ON detbarang.id_detbarang=detso.id_detbarang
   // WHERE detso.id_detso="BRGSO-201214114509";
}
