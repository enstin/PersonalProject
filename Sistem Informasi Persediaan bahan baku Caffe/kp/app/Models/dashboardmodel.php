<?php

namespace App\Models;

use CodeIgniter\Model;

class dashboardmodel extends Model
{
 public function dboard(){

 }

public function hapus(){
   $this->db->table('cek')->delete(['input'=>'dua']);
}

}