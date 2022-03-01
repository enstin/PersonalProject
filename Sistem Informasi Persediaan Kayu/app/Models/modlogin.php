<?php

namespace App\Models;

use CodeIgniter\Model;

class modlogin extends Model
{
    protected $tabel = 'user';
    public function ceklogin($id, $pass)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->where('user', $id)
            ->where('password', $pass)
            ->countAllResults();
    }
    public function ceklog($id, $pass)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->where('user', $id)
            ->where('password', $pass)
            ->get()->getResultArray();
    }
}
