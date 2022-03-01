<?php

namespace App\Models;

use CodeIgniter\Model;

class modbmasuk extends Model
{
   protected $masuk = 'bmasuk';
   //USED================================================
   protected $table = 'belanja';
   public function tampil()
   {
      return $this->db->table($this->table)
         ->select('*')
         ->where('status', 'disetujui')
         ->get()->getResultArray();
   }
   public function tampil_histori()
   {
      return $this->db->table('bmasuk')
         ->select('*')
         ->join('fifo', 'bmasuk.id_bmasuk = fifo.id_bmasuk')
         ->join('barang', 'fifo.id_barang = barang.id_barang')
         ->where('sisa >', '0')
         ->orderBy('ex_date', 'asc')
         ->get()->getResultArray();
   }
   public function delete_dump()
   {
      return $this->db->query("delete from dump_detbmasuk");
   }
   public function tampil_barang()
   {
      return $this->db->table('barang')
         ->select('*')
         ->get()->getResultArray();
   }
   public function tampil_dump()
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->join('barang', 'barang.id_barang = dump_detbmasuk.id_barang')
         ->get()->getResultArray();
   }
   public function count_data_bmasuk($data)
   {
      return $this->db->table('bmasuk')
         ->select('*')
         ->like('id_bmasuk', $data)
         ->countAllResults();
   }
   public function get_data_bmasuk($id)
   {
      return $this->db->table('bmasuk')
         ->selectMax('id_bmasuk')
         ->like('id_bmasuk', $id)
         ->get()->getResultArray();
   }
   public function get_data_detbmasuk($id)
   {
      return $this->db->table('detbelanja')
         ->selectMax('id_detbel')
         ->like('id_belanja', $id)
         ->get()->getResultArray();
   }
   public function get_data_belanja($id)
   {
      return $this->db->table('belanja')
         ->select(['belanja.id_belanja', 'detbelanja.id_detbel', 'barang.id_barang', 'detbelanja.jumlah', 'barang.harga', 'barang.lama_expired'])
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->join('barang', 'detbelanja.id_barang = barang.id_barang')
         ->where('belanja.id_belanja', $id)
         ->get()->getResultArray();
   }
   public function count_data_belanja($id)
   {
      return $this->db->table('belanja')
         ->select(['*', 'barang.id_barang', 'detbelanja.jumlah', 'barang.harga', 'barang.lama_expired'])
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->join('barang', 'detbelanja.id_barang = barang.id_barang')
         ->where('belanja.id_belanja', $id)
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
   public function insert_dump_detbmasuk($data)
   {
      return $this->db->table('dump_detbmasuk')
         ->insert($data);
   }
   public function sum_sub_total_dump()
   {
      return $this->db->table('dump_detbmasuk')
         ->selectSum('sub_total')
         ->get()->getResultArray();
   }
   public function pindah_dump()
   {
      return $this->db->query("insert into detbmasuk select * from dump_detbmasuk");
   }
   public function pindah_fifo()
   {
      return $this->db->query("insert into fifo select * from dump_detbmasuk");
   }
   public function insert_bmasuk($data)
   {
      return $this->db->table('bmasuk')
         ->insert($data);
   }
   public function hapus_draft($id)
   {
      return $this->db->table('dump_detbmasuk')
         ->delete($id);
   }
   public function ubah_draft($data, $id)
   {
      return $this->db->table('dump_detbmasuk')
         ->update($data, $id);
   }
   public function ubah_status($data, $id)
   {
      return $this->db->table('belanja')
         ->update($data, $id);
   }
   public function updatestok($data, $id)
   {
      return $this->db->table('barang')
         ->update($data, $id);
   }
   //ENDUSED============================================
   public function count_data_dump()
   {
      return $this->db->table('dump_detbmasuk')
         ->select('*')
         ->countAllResults();
   }
   public function tampiloperasi($id)
   {
      return $this->db->table('dump_detbmasuk')
         ->select('barang.id_barang,barang.nama')
         ->selectSum('dump_detbmasuk.jumlah', 'total')
         ->join('barang', 'barang.id_barang = dump_detbmasuk.id_barang')
         ->where('barang.id_barang', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
}
