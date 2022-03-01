<?php

namespace App\Models;

use CodeIgniter\Model;

class modbelanja extends Model
{
    protected $table = 'belanja';
    //Data Barang ==========================================================================
    public function data_barang()
    {
        return $this->db->table('barang')
            ->select('*')
            ->get()->getResultArray();
    }
    public function data_barang_kurang()
    {
        return $this->db->table('barang')
            ->select('*')
            ->where('kekurangan>', 0)
            ->get()->getResultArray();
    }
    //================== End Data Barang ==========================================================================

    //Set ID Belanja ==========================================================================
    public function count_data_belanja($data)
    {
        return $this->db->table($this->table)
            ->select('*')
            ->like('id_belanja', $data)
            ->countAllResults();
    }
    public function get_data_belanja($data)
    {
        return $this->db->table($this->table)
            ->selectMax('id_belanja')
            ->like('id_belanja', $data)
            ->get()->getResultArray();
    }
    //==================== END Set ID Belanja ==========================================================================

    //OPERASI DUMP =========================================================

    //OPERASI crud TABLE DUMP
    public function tampil_dump()
    {
        return $this->db->table('dump_detbelanja')
            ->select('*')
            ->join('barang', 'barang.id_barang = dump_detbelanja.id_barang')
            ->get()->getResultArray();
    }
    public function insert_data($data)
    {
        return $this->db->table('dump_detbelanja')
            ->insert($data);
    }
    public function delete_data_dump($id)
    {
        return $this->db->table('dump_detbelanja')
            ->delete($id);
    }
    //OPERASI TABLE DUMP
    public function delete_dump()
    {
        return $this->db->query("delete from dump_detbelanja");
    }
    public function pindah_dump()
    {
        return $this->db->query("insert into detbelanja select * from dump_detbelanja");
    }
    public function sum_dump()
    {
        return $this->db->table('dump_detbelanja')
            ->selectSum('sub_total')
            ->get()->getResultArray();
    }
    //====================== end OPERASI DUMP =========================================================

    //OPERASI BELANJA =========================================================
    public function insert_belanja($data)
    {
        return $this->db->table($this->table)
            ->insert($data);
    }
    public function update_belanja($data, $id)
    {
        return $this->db->table($this->table)
            ->update($data, $id);
    }
    public function update_barang($data, $id)
    {
        return $this->db->table('barang')
            ->update($data, $id);
    }
    public function tampil()
    {
        return $this->db->table($this->table)
            ->select('*')
            ->whereNotIn('status', ['dimasukan'])
            ->get()->getResultArray();
    }
    public function setuju($data, $id)
    {
        return $this->db->table($this->table)
            ->update($data, $id);
    }
    public function hapus($id)
    {
        return $this->db->table($this->table)
            ->delete($id);
    }
    public function hapus_detail($id)
    {
        return $this->db->table('detbelanja')
            ->delete($id);
    }
    //======================= END OPERASI BELANJA =========================================================


    //OPERASI DETAIL BELANJA BELUM DISETUJUI=========================================================

    public function tampil_detail($id)
    {
        return $this->db->table('detbelanja')
            ->select('*')
            ->join('barang', 'barang.id_barang = detbelanja.id_barang')
            ->where('id_belanja', $id)
            ->get()->getResultArray();
    }
    public function tampil_cetak($id)
    {
        return $this->db->table('detbelanja')
            ->select('*')
            ->join('barang', 'barang.id_barang = detbelanja.id_barang')
            ->join('belanja', 'belanja.id_belanja = detbelanja.id_belanja')
            ->where('belanja.id_belanja', $id)
            ->get()->getResultArray();
    }
    public function tampil_total($id)
    {
        return $this->db->table('detbelanja')
            ->select('*')
            ->join('barang', 'barang.id_barang = detbelanja.id_barang')
            ->join('belanja', 'belanja.id_belanja = detbelanja.id_belanja')
            ->where('belanja.id_belanja', $id)
            ->limit(1)
            ->get()->getResultArray();
    }
    public function insert_data_detail($data)
    {
        return $this->db->table('detbelanja')
            ->insert($data);
    }
    public function delete_data_detail($id)
    {
        return $this->db->table('detbelanja')
            ->delete($id);
    }
    public function sum_detail($id)
    {
        return $this->db->table('detbelanja')
            ->selectSum('sub_total')
            ->where('id_belanja', $id)
            ->get()->getResultArray();
    }
    //====================== OPERASI DETAIL BELANJA BELUM DISETUJUI=========================================================
    public function count_data_dump()
    {
        return $this->db->table('dump_detbelanja')
            ->select('*')
            ->countAllResults();
    }
}
