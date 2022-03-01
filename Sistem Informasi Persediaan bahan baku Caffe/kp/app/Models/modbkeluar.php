<?php

namespace App\Models;

use CodeIgniter\Model;

class modbkeluar extends Model
{
   protected $masuk = 'bkeluar';
   //USED================================================
   protected $table = 'pbkeluar';
   public function tampil()
   {
      return $this->db->table('pbkeluar')
         ->select('*')
         ->where('status', 'disetujui')
         ->get()->getResultArray();
   }
   public function tampil_histori()
   {
      return $this->db->table('bkeluar')
         ->select([
            'id_detbkeluar', 'bkeluar.id_bkeluar', 'tanggal',
            'barang.id_barang', 'jumlah', 'detbkeluar.kekurangan',
            'barang.stok', 'barang.harga', 'barang.satuan', 'nama'
         ])
         ->join('detbkeluar', 'bkeluar.id_bkeluar = detbkeluar.id_bkeluar')
         ->join('barang', 'detbkeluar.id_barang = barang.id_barang')
         // ->where('sisa>', '0')
         ->orderBy('id_detbkeluar', 'desc')
         ->get()->getResultArray();
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_detbkeluar");
   }
   public function tampil_barang()
   {
      return $this->db->table('barang')
         ->select('*')
         ->get()->getResultArray();
   }
   public function tampil_dump()
   {
      return $this->db->table('dump_detbkeluar')
         ->select([
            'id_detbkeluar', 'id_bkeluar',
            'barang.id_barang', 'jumlah', 'dump_detbkeluar.kekurangan',
            'barang.stok', 'barang.harga', 'barang.satuan', 'nama'
         ])
         ->join('barang', 'barang.id_barang = dump_detbkeluar.id_barang')
         ->get()->getResultArray();
   }
   public function count_data_bkeluar($data)
   {
      return $this->db->table('bkeluar')
         ->select('*')
         ->like('id_bkeluar', $data)
         ->countAllResults();
   }
   public function get_data_bkeluar($id)
   {
      return $this->db->table('bkeluar')
         ->selectMax('id_bkeluar')
         ->like('id_bkeluar', $id)
         ->get()->getResultArray();
   }
   public function get_data_detbkeluar($id)
   {
      return $this->db->table('detpbkeluar')
         ->selectMax('id_detpbkeluar')
         ->like('id_pbkeluar', $id)
         ->get()->getResultArray();
   }
   public function get_data_pbkeluar($id)
   {
      return $this->db->table('pbkeluar')
         ->select(['pbkeluar.id_pbkeluar', 'detpbkeluar.id_detpbkeluar', 'barang.id_barang', 'detpbkeluar.jumlah', 'detpbkeluar.kekurangan'])
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->join('barang', 'detpbkeluar.id_barang = barang.id_barang')
         ->where('pbkeluar.id_pbkeluar', $id)
         ->get()->getResultArray();
   }
   public function count_data_pbkeluar($id)
   {
      return $this->db->table('pbkeluar')
         ->select(['*', 'barang.id_barang', 'detpbkeluar.jumlah', 'barang.harga', 'barang.lama_expired'])
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->join('barang', 'detpbkeluar.id_barang = barang.id_barang')
         ->where('pbkeluar.id_pbkeluar', $id)
         ->countAllResults();
   }
   public function get_expired($id)
   {
      $var = $this->db->table('barang')
         ->select('lama_expired')
         ->where('id_barang', $id)
         ->get()->getResultArray();

      return $this->db->table('barang')
         ->select('lama_expired')
         ->where('id_barang', $id)
         ->get()->getResultArray();
   }
   public function insert_dump_detbkeluar($data)
   {
      return $this->db->table('dump_detbkeluar')
         ->insert($data);
   }
   public function pindah_dump()
   {
      return $this->db->query("insert into detbkeluar select * from dump_detbkeluar");
   }
   public function pindah_dump2($data)
   {
      return $this->db->table('detbkeluar')
         ->insert($data);
   }
   // public function pindah_bkel()
   // {
   //    return $this->db->query("update barang set kekurangan=(select dump_detbkeluar.kekurangan from dump_detbkeluar join barang where dump_detbkeluar.id_barang=barang.id_barang limit 1)");
   // }
   public function insert_bkeluar($data)
   {
      return $this->db->table('bkeluar')
         ->insert($data);
   }
   public function hapus_draft($id)
   {
      return $this->db->table('dump_detbkeluar')
         ->delete($id);
   }
   public function ubah_draft($data, $id)
   {
      return $this->db->table('dump_detbkeluar')
         ->update($data, $id);
   }
   public function ubah_status($data, $id)
   {
      return $this->db->table('pbkeluar')
         ->update($data, $id);
   }
   //ENDUSED============================================
   public function count_data_dump()
   {
      return $this->db->table('dump_detbkeluar')
         ->select('*')
         ->countAllResults();
   }
   public function tampiloperasi($id)
   {
      return $this->db->table('dump_detbkeluar')
         ->select('barang.id_barang,barang.nama')
         ->selectSum('dump_detbkeluar.jumlah', 'total')
         ->join('barang', 'barang.id_barang = dump_detbkeluar.id_barang')
         ->where('barang.id_barang', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
   public function updatestok($data, $id)
   {
      return $this->db->table('barang')
         ->update($data, $id);
   }

   //fifo

   public function tabelfifo($data)
   {
      return $this->db->table('fifo')
         ->select('*')
         ->where('ex_date>', "curdate()")
         ->where($data)
         ->get()->getResultArray();
   }
   public function tabelfifokurang($data)
   {
      return $this->db->table('fifo')
         ->select('*')
         ->where('ex_date>', "curdate()")
         ->where($data)
         ->limit(1)
         ->orderBy('ex_date', 'ASC')
         ->get()->getResultArray();
   }
   public function tabelfifocount($data)
   {
      return $this->db->table('fifo')
         ->select('*')
         ->where('ex_date>', "curdate()")
         ->where($data)
         ->countAllResults();
   }
   public function displayfifo()
   {
      return $this->db->table('fifo')
         ->select('*')
         ->get()->getResultArray();
   }
   public function updatefifo($data, $id)
   {
      return $this->db->table('fifo')
         ->update($data, $id);
   }
   public function deletefifo()
   {
      return $this->db->query("delete from fifo where sisa=0");
   }
   public function updatebmasuk($data, $id)
   {
      return $this->db->table('detbmasuk')
         ->update($data, $id);
   }
}
