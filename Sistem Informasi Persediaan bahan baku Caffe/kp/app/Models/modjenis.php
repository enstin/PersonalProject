<?php

namespace App\Models;

use CodeIgniter\Model;

class modjenis extends Model
{
   protected $table = 'jenis';
   public function tampiljenis()
   {
      return $this->db->table($this->table)
         ->select('*')
         ->get()->getResultArray();
   }
   public function insertdata($kontol)
   {
      return $this->db->table($this->table)
         ->insert($kontol);
   }
   public function deletedata($del)
   {
      return $this->db->table($this->table)
         ->delete($del);
   }
   public function editdata($id, $data)
   {
      return $this->db->table($this->table)
         ->update($data, $id);
   }
}
