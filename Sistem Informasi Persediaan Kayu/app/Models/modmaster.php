<?php

namespace App\Models;

use CodeIgniter\Model;

class modmaster extends Model
{
    protected $kayu = 'kayu';
    protected $produk = 'produk';
    protected $user = 'user';

    //DATA kayu
    public function tampilkayu()
    {
        return $this->db->table($this->kayu)
            ->select('*')
            ->get()->getResultArray();
    }
    public function delete_kayu($id)
     {
         return $this->db->table('kayu')
             ->delete(['id_kayu'=>$id]);
     }
    public function countkayu()
    {
        return $this->db->table($this->kayu)
            ->select('*')
            ->countAllResults();
    }
    public function cekkayu($nama)
    {
        return $this->db->table($this->kayu)
            ->select('*')
            ->like('nama',$nama)
            ->countAllResults();
    }
    public function cekproduk($nama)
    {
        return $this->db->table('produk')
            ->select('*')
            ->like('nama',$nama)
            ->countAllResults();
    }
    public function ambilkayu()
    {
        return $this->db->table($this->kayu)
            ->select('*')
            ->orderBy('id_kayu', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function insertkayu($data)
    {
        return $this->db->table($this->kayu)
            ->insert($data);
    }
    public function updatekayu($data, $id)
    {
        return $this->db->table('kayu')
            ->update($data, $id);
    }

     //DATA produk
     public function tampilproduk()
     {
         return $this->db->table($this->produk)
             ->select('*')
             ->get()->getResultArray();
     }
     public function delete_produk($id)
     {
         return $this->db->table('produk')
             ->delete(['id_produk'=>$id]);
     }
     public function countproduk()
     {
         return $this->db->table($this->produk)
             ->select('*')
             ->countAllResults();
     }
     public function ambilproduk()
     {
         return $this->db->table($this->produk)
             ->select('*')
             ->orderBy('id_produk', 'desc')
             ->limit(1)
             ->get()->getResultArray();
     }
     public function insertproduk($data)
     {
         return $this->db->table('produk')
             ->insert($data);
     }
     public function updateproduk($data, $id)
     {
         return $this->db->table('produk')
             ->update($data, $id);
     }

      //DATA user
      public function tampiluser()
      {
          return $this->db->table($this->user)
              ->select('*')
              ->get()->getResultArray();
      }
      public function delete_user($id)
      {
          return $this->db->table('user')
              ->delete(['user'=>$id]);
      }
      public function countuser()
      {
          return $this->db->table($this->user)
              ->select('*')
              ->countAllResults();
      }
      public function ambiluser()
      {
          return $this->db->table($this->user)
              ->select('*')
              ->orderBy('id_user', 'desc')
              ->limit(1)
              ->get()->getResultArray();
      }
      public function insertuser($data)
      {
          return $this->db->table($this->user)
              ->insert($data);
      }
      public function updateuser($data, $id)
      {
          return $this->db->table('user')
              ->update($data, $id);
      }
}
