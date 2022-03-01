<?php

namespace App\Models;

use CodeIgniter\Model;

class modpbkeluar extends Model
{
    protected $table = 'pbkeluar';
    //Data Barang ==========================================================================
    public function data_barang()
    {
        return $this->db->table('barang')
            ->select('*')
            ->get()->getResultArray();
    }
    //================== End Data Barang ==========================================================================

    //Set ID pbkeluar ==========================================================================
    public function count_data_pbkeluar($data)
    {
        return $this->db->table($this->table)
            ->select('*')
            ->like('id_pbkeluar', $data)
            ->countAllResults();
    }
    public function get_data_pbkeluar($data)
    {
        return $this->db->table($this->table)
            ->selectMax('id_pbkeluar')
            ->like('id_pbkeluar', $data)
            ->get()->getResultArray();
    }
    //==================== END Set ID pbkeluar ==========================================================================

    //OPERASI DUMP =========================================================

    //OPERASI crud TABLE DUMP
    public function tampil_dump()
    {
        return $this->db->table('dump_detpbkeluar')
            ->select([
                'id_detpbkeluar',
                'id_pbkeluar',
                'barang.id_barang',
                'jumlah',
                'dump_detpbkeluar.kekurangan',
                'barang.stok',
                'barang.harga',
                'barang.satuan',
                'nama'
            ])
            ->join('barang', 'barang.id_barang = dump_detpbkeluar.id_barang')
            ->get()->getResultArray();
    }
    public function tampil_jum_barang($id)
    {
        return $this->db->table('barang')
            ->select('stok')
            ->where('id_barang', $id)
            ->get()->getResultArray();
    }
    public function insert_data_dump($data)
    {
        return $this->db->table('dump_detpbkeluar')
            ->insert($data);
    }
    public function delete_data_dump($id)
    {
        return $this->db->table('dump_detpbkeluar')
            ->delete($id);
    }
    //OPERASI TABLE DUMP
    public function delete_dump()
    {
        return $this->db->query("delete from dump_detpbkeluar");
    }
    public function pindah_dump()
    {
        return $this->db->query("insert into detpbkeluar select * from dump_detpbkeluar");
    }
    // public function sum_dump()
    // {
    //     return $this->db->table('dump_detpbkeluar')
    //         ->selectSum('sub_total')
    //         ->get()->getResultArray();
    // }
    //====================== end OPERASI DUMP =========================================================

    //OPERASI pbkeluar =========================================================
    public function insert_pbkeluar($data)
    {
        return $this->db->table($this->table)
            ->insert($data);
    }
    public function update_pbkeluar($data, $id)
    {
        return $this->db->table($this->table)
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
    public function updateitem($data, $id)
    {
        return $this->db->table('detpbkeluar')
            ->update($data, $id);
    }
    public function updateitemrencana($data, $id)
    {
        return $this->db->table('dump_detpbkeluar')
            ->update($data, $id);
    }
    public function hapus($id)
    {
        return $this->db->table($this->table)
            ->delete($id);
    }
    public function hapus_detail($id)
    {
        return $this->db->table('detpbkeluar')
            ->delete($id);
    }
    public function kondisi()
    {
        return $this->db->table('pbkeluar')
            ->select('*')
            ->where('status', 'disetujui')
            ->countAllResults();
    }
    //======================= END OPERASI pbkeluar =========================================================


    //OPERASI DETAIL pbkeluar BELUM DISETUJUI=========================================================

    public function tampil_detail($id)
    {
        return $this->db->table('detpbkeluar')
            ->select([
                'id_detpbkeluar',
                'id_pbkeluar',
                'barang.id_barang',
                'jumlah',
                'detpbkeluar.kekurangan',
                'barang.stok',
                'barang.harga',
                'barang.satuan',
                'nama'
            ])
            ->join('barang', 'barang.id_barang = detpbkeluar.id_barang')
            ->where('id_pbkeluar', $id)
            ->get()->getResultArray();
    }
    public function insert_data_detail($data)
    {
        return $this->db->table('detpbkeluar')
            ->insert($data);
    }
    public function delete_data_detail($id)
    {
        return $this->db->table('detpbkeluar')
            ->delete($id);
    }
    public function sum_detail($id)
    {
        return $this->db->table('detpbkeluar')
            ->selectSum('sub_total')
            ->where('id_pbkeluar', $id)
            ->get()->getResultArray();
    }
    //====================== OPERASI DETAIL pbkeluar BELUM DISETUJUI=========================================================
}
