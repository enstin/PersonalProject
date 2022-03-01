<?php

namespace App\Models;

use CodeIgniter\Model;

class modmaster extends Model
{
    protected $barang = 'barang';
    protected $cr = 'cr';
    protected $ukuran = 'ukuran';
    protected $berat = 'berat';
    protected $brand = 'brand';
    protected $gudang = 'gudang';
    protected $user = 'user';
    //DATA BARANG
    public function tampilbarang()
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function tampildetbarang($id)
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->join('cr', 'cr.id_cr=detbarang.id_cr')
            ->where('id_barang', $id)
            ->where('id_gudang', 'g1')
            ->where('detbarang.status', 'aktif')
            ->get()->getResultArray();
    }
    public function countdetbarang($id)
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->join('cr', 'cr.id_cr=detbarang.id_cr')
            ->where('id_detbarang', $id)
            ->where('detbarang.status', 'aktif')
            ->countAllResults();
    }
    public function countdetbarang2($id)
    {
        return $this->db->table('detbarang')
            ->select('*')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->join('cr', 'cr.id_cr=detbarang.id_cr')
            ->where('id_detbarang', $id)
            ->where('detbarang.status', 'tidak')
            ->countAllResults();
    }
    public function tampilbarang_g1()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbarang', 'barang.id_barang=detbarang.id_barang')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_gudang', 'g1')
            ->where('detbarang.status', 'aktif')
            ->get()->getResultArray();
    }
    public function tampilbarang_g2()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbarang', 'barang.id_barang=detbarang.id_barang')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_gudang', 'g2')
            ->where('detbarang.status', 'aktif')
            ->get()->getResultArray();
    }
    public function tampilbarang_g3()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbarang', 'barang.id_barang=detbarang.id_barang')
            ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
            ->join('berat', 'berat.id_berat=detbarang.id_berat')
            ->join('brand', 'brand.id_brand=detbarang.id_brand')
            ->where('id_gudang', 'g3')
            ->where('detbarang.status', 'aktif')
            ->get()->getResultArray();
    }

    public function optionukuran()
    {
        return $this->db->table($this->ukuran)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }

    public function optionubrand()
    {
        return $this->db->table('brand')
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }

    public function optionuberat()
    {
        return $this->db->table('berat')
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function optioncr()
    {
        return $this->db->table($this->cr)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertbarang($data)
    {
        return $this->db->table($this->barang)
            ->insert($data);
    }
    public function insertbarangdetail($data)
    {
        return $this->db->table('detbarang')
            ->insert($data);
    }
    public function updatebarang($data, $id)
    {
        return $this->db->table('barang')
            ->update($data, $id);
    }
    public function updatedetbarang($data, $id)
    {
        return $this->db->table('detbarang')
            ->update($data, $id);
    }
    public function ambilbarang()
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->orderBy('id_barang', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function countbarang()
    {
        return $this->db->table($this->barang)
            ->select('*')
            ->countAllResults();
    }

    //ukuran
    public function tampilukuran()
    {
        return $this->db->table($this->ukuran)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function optionberat()
    {
        return $this->db->table($this->berat)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertukuran($data)
    {
        return $this->db->table($this->ukuran)
            ->insert($data);
    }
    public function deleteukuran($del)
    {
        return $this->db->table($this->ukuran)
            ->delete($del);
    }
    public function updateukuran($data, $id)
    {
        return $this->db->table($this->ukuran)
            ->update($data, $id);
    }
    public function ambilukuran()
    {
        return $this->db->table($this->ukuran)
            ->select('*')
            ->orderBy('id_ukuran', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function countukuran()
    {
        return $this->db->table($this->ukuran)
            ->select('*')
            ->countAllResults();
    }

    //berat
    public function tampilberat()
    {
        return $this->db->table($this->berat)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertberat($data)
    {
        return $this->db->table($this->berat)
            ->insert($data);
    }
    public function deleteberat($del)
    {
        return $this->db->table($this->berat)
            ->delete($del);
    }
    public function updateberat($data, $id)
    {
        return $this->db->table($this->berat)
            ->update($data, $id);
    }
    public function ambilberat()
    {
        return $this->db->table($this->berat)
            ->select('*')
            ->orderBy('id_berat', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function countberat()
    {
        return $this->db->table($this->berat)
            ->select('*')
            ->countAllResults();
    }

    //brand
    public function tampilbrand()
    {
        return $this->db->table($this->brand)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertbrand($data)
    {
        return $this->db->table($this->brand)
            ->insert($data);
    }
    public function deletebrand($del)
    {
        return $this->db->table($this->brand)
            ->delete($del);
    }
    public function updatebrand($data, $id)
    {
        return $this->db->table($this->brand)
            ->update($data, $id);
    }
    public function ambilbrand()
    {
        return $this->db->table($this->brand)
            ->select('*')
            ->orderBy('id_brand', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function countbrand()
    {
        return $this->db->table($this->brand)
            ->select('*')
            ->countAllResults();
    }
    //user
    public function tampiluser()
    {
        return $this->db->table($this->user)
            ->select('*')
            ->join('gudang', 'gudang.id_gudang=user.id_gudang')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function optiongudang()
    {
        return $this->db->table('gudang')
            ->select('*')
            ->get()->getResultArray();
    }
    public function insertuser($data)
    {
        return $this->db->table($this->user)
            ->insert($data);
    }
    public function deleteuser($del)
    {
        return $this->db->table($this->user)
            ->delete($del);
    }
    public function updateuser($data, $id)
    {
        return $this->db->table($this->user)
            ->update($data, $id);
    }
    //conversion rate
    public function tampilcr()
    {
        return $this->db->table($this->cr)
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertcr($data)
    {
        return $this->db->table($this->cr)
            ->insert($data);
    }
    public function deletecr($del)
    {
        return $this->db->table($this->cr)
            ->delete($del);
    }
    public function updatecr($data, $id)
    {
        return $this->db->table($this->cr)
            ->update($data, $id);
    }
    public function countcr()
    {
        return $this->db->table($this->cr)
            ->select('*')
            ->countAllResults();
    }
    public function ambilcr()
    {
        return $this->db->table($this->cr)
            ->select('*')
            ->orderBy('id_cr', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }
    //supplier
    public function tampilsupplier()
    {
        return $this->db->table('supplier')
            ->select('*')
            ->where('status', 'aktif')
            ->get()->getResultArray();
    }
    public function insertsupplier($data)
    {
        return $this->db->table('supplier')
            ->insert($data);
    }
    public function deletesupplier($data)
    {
        return $this->db->table('supplier')
            ->delete($data);
    }
    public function updatesupplier($data, $id)
    {
        return $this->db->table('supplier')
            ->update($data, $id);
    }
    public function countsup()
    {
        return $this->db->table('supplier')
            ->select('*')
            ->countAllResults();
    }
    public function ambilsup()
    {
        return $this->db->table('supplier')
            ->select('*')
            ->orderBy('id_supplier', 'desc')
            ->limit(1)
            ->get()->getResultArray();
    }







    public function get_data_barang($data)
    {
        return $this->db->table($this->barang)
            ->selectMax('id_barang')
            ->like('id_barang', $data)
            ->get()->getResultArray();
    }


    // public function get_ajax_berat($data)
    // {
    //     return $this->db->table($this->berat)
    //         ->select('*')
    //         ->where('id_brand', $data)
    //         ->get()->getResultArray();
    // }
    // public function get_ajax_ukuran($data)
    // {
    //     return $this->db->table($this->ukuran)
    //         ->select('*')
    //         ->where('id_berat', $data)
    //         ->get()->getResultArray();
    // }
}
