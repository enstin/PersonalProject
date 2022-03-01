<?php

namespace App\Models;

use CodeIgniter\Model;

class moddashboard extends Model
{
    public function hitungbmasuk()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
            ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->countAllResults();
    }
    public function hitungbkeluar()
    {
        return $this->db->table('barang')
            ->select('barang.id_barang,barang.nama,barang.satuan')
            ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
            ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->countAllResults();
    }
    public function hitungbelanja()
    {
        return $this->db->table('belanja')
            ->select('*')
            ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->countAllResults();
    }
}
