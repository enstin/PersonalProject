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
            ->where('id_user', $id)
            ->where('password', $pass)
            ->countAllResults();
    }
    public function ceklog($id, $pass)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->join('gudang', 'user.id_gudang=gudang.id_gudang')
            ->where('id_user', $id)
            ->where('password', $pass)
            ->get()->getResultArray();
    }
}
