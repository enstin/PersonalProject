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
         ->get()->getResultArray();
   }
   //Data Barang ==========================================================================
   public function data_barang()
   {
      return $this->db->table('barang')
         ->select('*')
         ->get()->getResultArray();
   }
   //================== End Data Barang ==========================================================================
   public function tampil_dump()
   {
      return $this->db->table('dump_detso')
         ->select('*')
         ->join('barang', 'barang.id_barang = dump_detso.id_barang')
         ->get()->getResultArray();
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
         ->selectMax('id_so')
         ->like('id_so', $data)
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
   public function pindah_dump()
   {
      return $this->db->query("insert into detso select * from dump_detso");
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
         ->join('barang', 'barang.id_barang = detso.id_barang')
         ->where('id_so', $id)
         ->get()->getResultArray();
   }
}
