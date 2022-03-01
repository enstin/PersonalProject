<?php

namespace App\Models;

use CodeIgniter\Model;

class modrbelanja extends Model
{
   protected $barang = 'barang';
   public function tampilbarang()
   {
      return $this->db->table($this->barang)
         ->select('*')
         ->get()->getResultArray();
   }
   protected $jenis = 'jenis';
   public function tampiljenis()
   {
      return $this->db->table($this->jenis)
         ->select('*')
         ->get()->getResultArray();
   }
   public function deletedata($del)
   {
      return $this->db->table($this->table)
         ->delete($del);
   }
}
