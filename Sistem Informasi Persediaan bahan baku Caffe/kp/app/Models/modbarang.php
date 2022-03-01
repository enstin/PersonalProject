<?php

namespace App\Models;

use CodeIgniter\Model;

class modbarang extends Model
{
    protected $barang = 'barang';
    public function tampilbarang()
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->join('jenis', 'jenis.id_jenis=barang.id_jenis')
            ->get()->getResultArray();
    }
    protected $jenis = 'jenis';
    public function tampiljenis()
    {
        return $this->db->table($this->jenis)
            ->select('*')
            ->get()->getResultArray();
    }
    public function insertdata($data)
    {
        return $this->db->table($this->barang)
            ->insert($data);
    }
    public function deletedata($del)
    {
        return $this->db->table($this->barang)
            ->delete($del);
    }
    public function updatedata($data, $id)
    {
        return $this->db->table($this->barang)
            ->update($data, $id);
    }
    public function count_data_barang($data)
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->like('id_barang', $data)
            ->countAllResults();
    }
    public function get_data_barang($data)
    {
        return $this->db->table($this->barang)
            ->selectMax('id_barang')
            ->like('id_barang', $data)
            ->get()->getResultArray();
    }
}
