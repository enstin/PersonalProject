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
    public function permintaanbelum()
    {
        return $this->db->table('permintaan')
            ->select('*')
            ->where('status', 'diajukan-g2')
            ->orwhere('status', 'diajukan-g3')
            ->countAllResults();
    }
    public function itemkeluar()
    {
        return $this->db->table('detbkeluar')
            ->select('*')
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->join('bkeluar', 'bkeluar.id_bkeluar=detbkeluar.id_bkeluar')
            ->where('detbarang.id_gudang', 'g1')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function itemmasuk()
    {
        return $this->db->table('detbmasuk')
            ->select('*')
            ->join('detbarang', 'detbmasuk.id_detbarang=detbarang.id_detbarang')
            ->join('bmasuk', 'bmasuk.id_bmasuk=detbmasuk.id_masuk')
            ->where('detbarang.id_gudang', 'g1')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function perminggu()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 7 DAY)) AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 14 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 22 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 30 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function perminggulalu()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 31 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 38 DAY))AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 39 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 46 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 47 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 54 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 55 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 62 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahun()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 1 MONTH))AS a12,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 1 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 2 MONTH))AS a11,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 2 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 3 MONTH))AS a10,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 3 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 4 MONTH))AS a9,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 4 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 5 MONTH))AS a8,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 5 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 6 MONTH))AS a7,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 6 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 7 MONTH))AS a6,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 8 MONTH))AS a5,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 8 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 9 MONTH))AS a4,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 9 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 10 MONTH))AS a3,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 10 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 11 MONTH))AS a2,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 11 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 12 MONTH))AS a1")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahunlalu()
    {
        return $this->db->table('detbkeluar')
            ->select(
                "
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 12 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 13 MONTH))AS a12,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 13 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 14 MONTH))AS a11,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 14 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 15 MONTH))AS a10,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 16 MONTH))AS a9,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 16 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 17 MONTH))AS a8,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 17 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 18 MONTH))AS a7,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 18 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 19 MONTH))AS a6,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 19 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 20 MONTH))AS a5,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 20 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 21 MONTH))AS a4,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 21 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 22 MONTH))AS a3,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 22 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 23 MONTH))AS a2,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 24 MONTH))AS a1,
        "
            )
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function hitungbmasuk_g2()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
            ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->where('bmasuk.id_gudang','g2')
            ->countAllResults();
    }
    public function hitungbkeluar_g2()
    {
        return $this->db->table('barang')
            ->select('barang.id_barang,barang.nama,barang.satuan')
            ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
            ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->where('bkeluar.id_gudang','g2')
            ->countAllResults();
    }
   
    public function permintaanbelum_g2()
    {
        return $this->db->table('permintaan')
            ->select('*')
            ->where('status', 'diajukan-g1')
            ->countAllResults();
    }
    public function itemkeluar_g2()
    {
        return $this->db->table('detbkeluar')
            ->select('*')
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->join('bkeluar', 'bkeluar.id_bkeluar=detbkeluar.id_bkeluar')
            ->where('detbarang.id_gudang', 'g2')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function itemmasuk_g2()
    {
        return $this->db->table('detbmasuk')
            ->select('*')
            ->join('detbarang', 'detbmasuk.id_detbarang=detbarang.id_detbarang')
            ->join('bmasuk', 'bmasuk.id_bmasuk=detbmasuk.id_masuk')
            ->where('detbarang.id_gudang', 'g2')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function perminggu_g2()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 7 DAY)) AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 14 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 22 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 30 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g2')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function perminggulalu_g2()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 31 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 38 DAY))AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 39 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 46 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 47 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 54 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 55 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 62 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g2')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahun_g2()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 1 MONTH))AS a12,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 1 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 2 MONTH))AS a11,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 2 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 3 MONTH))AS a10,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 3 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 4 MONTH))AS a9,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 4 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 5 MONTH))AS a8,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 5 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 6 MONTH))AS a7,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 6 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 7 MONTH))AS a6,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 8 MONTH))AS a5,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 8 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 9 MONTH))AS a4,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 9 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 10 MONTH))AS a3,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 10 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 11 MONTH))AS a2,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 11 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 12 MONTH))AS a1")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g2')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahunlalu_g2()
    {
        return $this->db->table('detbkeluar')
            ->select(
                "
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 12 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 13 MONTH))AS a12,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 13 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 14 MONTH))AS a11,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 14 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 15 MONTH))AS a10,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 16 MONTH))AS a9,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 16 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 17 MONTH))AS a8,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 17 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 18 MONTH))AS a7,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 18 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 19 MONTH))AS a6,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 19 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 20 MONTH))AS a5,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 20 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 21 MONTH))AS a4,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 21 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 22 MONTH))AS a3,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 22 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 23 MONTH))AS a2,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 24 MONTH))AS a1,
        "
            )
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g2')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function hitungbmasuk_g3()
    {
        return $this->db->table('barang')
            ->select('*')
            ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
            ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->where('bmasuk.id_gudang','g3')
            ->countAllResults();
    }
    public function hitungbkeluar_g3()
    {
        return $this->db->table('barang')
            ->select('barang.id_barang,barang.nama,barang.satuan')
            ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
            ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
            ->where('bkeluar.id_gudang','g3')
            ->countAllResults();
    }
   
    public function permintaanbelum_g3()
    {
        return $this->db->table('permintaan')
            ->select('*')
            ->where('status', 'diajukan-g1')
            ->countAllResults();
    }
    public function itemkeluar_g3()
    {
        return $this->db->table('detbkeluar')
            ->select('*')
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->join('bkeluar', 'bkeluar.id_bkeluar=detbkeluar.id_bkeluar')
            ->where('detbarang.id_gudang', 'g3')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function itemmasuk_g3()
    {
        return $this->db->table('detbmasuk')
            ->select('*')
            ->join('detbarang', 'detbmasuk.id_detbarang=detbarang.id_detbarang')
            ->join('bmasuk', 'bmasuk.id_bmasuk=detbmasuk.id_masuk')
            ->where('detbarang.id_gudang', 'g3')
            ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
            ->countAllResults();
    }
    public function perminggu_g3()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 7 DAY)) AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 14 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 22 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 30 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g3')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function perminggulalu_g3()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 31 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 38 DAY))AS pertama,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 39 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 46 DAY))AS kedua,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 47 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 54 DAY))AS ketiga,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 55 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 62 DAY))AS keempat")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g3')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahun_g3()
    {
        return $this->db->table('detbkeluar')
            ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 1 MONTH))AS a12,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 1 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 2 MONTH))AS a11,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 2 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 3 MONTH))AS a10,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 3 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 4 MONTH))AS a9,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 4 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 5 MONTH))AS a8,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 5 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 6 MONTH))AS a7,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 6 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 7 MONTH))AS a6,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 8 MONTH))AS a5,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 8 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 9 MONTH))AS a4,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 9 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 10 MONTH))AS a3,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 10 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 11 MONTH))AS a2,
            (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 11 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 12 MONTH))AS a1")
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g3')
            ->limit(1)
            ->get()->getResultArray();
    }
    public function pertahunlalu_g3()
    {
        return $this->db->table('detbkeluar')
            ->select(
                "
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 12 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 13 MONTH))AS a12,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 13 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 14 MONTH))AS a11,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 14 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 15 MONTH))AS a10,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 16 MONTH))AS a9,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 16 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 17 MONTH))AS a8,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 17 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 18 MONTH))AS a7,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 18 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 19 MONTH))AS a6,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 19 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 20 MONTH))AS a5,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 20 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 21 MONTH))AS a4,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 21 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 22 MONTH))AS a3,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 22 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 23 MONTH))AS a2,
        (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 MONTH) AND DATE(tanggal) > (NOW() - INTERVAL 24 MONTH))AS a1,
        "
            )
            ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
            ->where('detbarang.id_gudang','g3')
            ->limit(1)
            ->get()->getResultArray();
    }

    // public function per3hari()
    // {
    //     return $this->db->table('detbkeluar')
    //         ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 3 DAY)) AS pertama,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 4 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 7 DAY))AS kedua,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 8 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 11 DAY))AS ketiga,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 12 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 15 DAY))AS keempat")
    //         ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
    //         ->limit(1)
    //         ->get()->getResultArray();
    // }
    // public function per3harilalu()
    // {
    //     return $this->db->table('detbkeluar')
    //         ->select("(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 16 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 19 DAY)) AS pertama,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 20 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 23 DAY))AS kedua,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 24 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 27 DAY))AS ketiga,
    //         (SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 28 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 31 DAY))AS keempat")
    //         ->join('detbarang', 'detbkeluar.id_detbarang=detbarang.id_detbarang')
    //         ->limit(1)
    //         ->get()->getResultArray();
    // }
    // public function perminggu()
    // {
    //     return $this->db->query("SELECT 
    // 	(SELECT SUM(jumlah) AS pertama FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) >(NOW() - INTERVAL 7 DAY)) AS pertama,
    // 	(SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 7 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 14 DAY))AS kedua,
    // 	(SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 15 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 22 DAY))AS ketiga,
    // 	(SELECT SUM(jumlah) AS kedua FROM detbkeluar JOIN bkeluar USING(id_bkeluar) WHERE pengurangan='0' AND DATE(tanggal) < (NOW() - INTERVAL 23 DAY) AND DATE(tanggal) > (NOW() - INTERVAL 30 DAY))AS keempat
    // 	FROM detbkeluar JOIN bkeluar USING(id_bkeluar) LIMIT 1
    // 	");
    // }
}
