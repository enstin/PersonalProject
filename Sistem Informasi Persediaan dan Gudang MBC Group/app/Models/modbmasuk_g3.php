<?php

namespace App\Models;

use CodeIgniter\Model;

class modbmasuk_g3 extends Model
{
   protected $masuk = 'bmasuk';
   //USED================================================
   public function tampilpemesanan()
   {
      return $this->db->table('pemesanan')
         ->select('*')
         ->join('supplier', 'supplier.id_supplier=pemesanan.id_supplier')
         ->where('pemesanan.status', 'disetujui')
         ->get()->getResultArray();
   }
   public function tampilpermintaan()
   {
      return $this->db->table('permintaan')
         ->select('*')
         ->where('permintaan.status', 'dikirim-g1')
         ->where('asal', 'g3')
         ->get()->getResultArray();
   }
   public function tampildetpemesanan($id)
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
   public function transaksimasuk($id)
   {
      return $this->db->table('detpermintaan')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=detpermintaan.id_detbarang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->where('id_permintaan', $id)
         ->get()->getResultArray();
   }
   public function transaksimasuk_non()
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbmasuk.id_detbarang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->where('id_gudang', 'g3')
         ->get()->getResultArray();
   }

   public function countbmasuk($id)
   {
      return $this->db->table('bmasuk')
         ->select('*')
         ->like('id_bmasuk', $id)
         ->countAllResults();
   }
   public function select_idbmasuk($id)
   {
      return $this->db->table('bmasuk')
         ->select('*')
         ->like('id_bmasuk', $id)
         ->orderBy('tanggal', 'desc')
         ->get()->getResultArray();
   }
   public function countdetbmasuk($id)
   {
      return $this->db->table('detbmasuk')
         ->select('*')
         ->where('id_bmasuk', $id)
         ->countAllResults();
   }
   public function select_iddetbmasuk($id)
   {
      return $this->db->table('detbmasuk')
         ->select('*')
         ->like('id_detbmasuk', $id)
         ->get()->getResultArray();
   }
   public function masukstok($data, $id)
   {
      return $this->db->table('detbarang')
         ->update($data, $id);
   }
   public function dump_update_item($data, $id)
   {
      return $this->db->table('dump_detbmasuk')
         ->update($data, $id);
   }
   public function update_status_permintaan($data, $id)
   {
      return $this->db->table('permintaan')
         ->update($data, $id);
   }
   public function prosesbmasuk($data)
   {
      return $this->db->table('bmasuk')
         ->insert($data);
   }
   public function prosesdetbmasuk($data)
   {
      return $this->db->table('detbmasuk')
         ->insert($data);
   }
   public function transaksibarang($id)
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->where('id_detbarang', $id)
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
   public function tampildump()
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbmasuk.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('id_gudang', 'g3')
         ->get()->getResultArray();
   }
   public function cek_dump($id_detbarang, $convert)
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->join('detbarang', 'detbarang.id_detbarang=dump_detbmasuk.id_detbarang')
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
      return $this->db->table('dump_detbmasuk')
         ->insert($data);
   }
   public function hapus_item($id)
   {
      return $this->db->table('dump_detbmasuk')
         ->delete($id);
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_detbmasuk");
   }
   public function cekdata()
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->get()->getResultArray();
   }
   public function hapus_base($id)
   {
      return $this->db->table('bmasuk')
         ->delete($id);
   }
   public function updatemasuk($data, $id)
   {
      return $this->db->table('bmasuk')
         ->update($data, $id);
   }
}
