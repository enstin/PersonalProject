<?php

namespace App\Models;

use CodeIgniter\Model;

class modlogin extends Model
{
    protected $barang = 'user';
    public function ceklogin($id, $pass)
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->where($id)
            ->where($pass)
            ->countAllResults();
    }
    public function ceklog($id, $pass)
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->where($id)
            ->where($pass)
            ->get()->getResultArray();
    }
}
