<?php

namespace App\Models;

use CodeIgniter\Model;

class modlaporan extends Model
{
   public function tampilbarang()
   {
      return $this->db->table('barang')
         ->select('*')
         ->join('jenis', 'barang.id_jenis = jenis.id_jenis')
         ->get()->getResultArray();
   }
   public function tampilbarang2()
   {
      return $this->db->table('barang')
         ->select('*')
         ->join('jenis', 'barang.id_jenis = jenis.id_jenis')
         ->get()->getResultArray();
   }
   public function jumlahbmasuk($id)
   {
      return $this->db->table('detbmasuk')
         ->selectsum('jumlah')
         ->where('id_barang', $id)
         ->get()->getResultArray();
   }
   public function tampilbelanja()
   {
      return $this->db->table('belanja')
         ->select('*')
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->get()->getResultArray();
   }
   public function tampilbmasukg()
   {
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbmasuk.jumlah', 'totalmasuk')
         ->selectSum('detbmasuk.sub_total', 'totalharga')
         ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
         ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
   public function tampilbkeluarg()
   {
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbkeluar.jumlah', 'totalkeluar')
         ->selectSum('detbkeluar.kekurangan', 'totalkurang')
         ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
   public function tampilbmasuktgl($awal, $akhir)
   {
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbmasuk.jumlah', 'totalmasuk')
         ->selectSum('detbmasuk.sub_total', 'totalharga')
         ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
         ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
   public function tampilbkeluartgl($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbkeluar.jumlah', 'totalkeluar')
         ->selectSum('detbkeluar.kekurangan', 'totalkurang')
         ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }
   //histori barang masuk
   public function tampilhistmasuk()
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('bmasuk')
         ->select('*')
         ->select("DATE(bmasuk.tanggal) as tgl")
         ->selectCount('id_detbmasuk', 'banyak')
         ->join('detbmasuk', 'bmasuk.id_bmasuk = detbmasuk.id_bmasuk')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('bmasuk.id_bmasuk')
         ->get()->getResultArray();
   }
   public function tglhistmasuk($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('bmasuk')
         ->select('*')
         ->select("DATE(bmasuk.tanggal) as tgl")
         ->selectCount('id_detbmasuk', 'banyak')
         ->join('detbmasuk', 'bmasuk.id_bmasuk = detbmasuk.id_bmasuk')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('bmasuk.id_bmasuk')
         ->get()->getResultArray();
   }
   public function histmasuk($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbmasuk.jumlah', 'totalmasuk')
         ->selectSum('detbmasuk.sub_total', 'totalharga')
         ->join('detbmasuk', 'barang.id_barang = detbmasuk.id_barang')
         ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
         ->where('bmasuk.id_bmasuk', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }

   //histori barang keluar
   public function tampilhistkeluar()
   {
      return $this->db->table('bkeluar')
         ->select('*')
         ->select("DATE(bkeluar.tanggal) as tgl")
         ->selectCount('id_detbkeluar', 'banyak')
         ->join('detbkeluar', 'bkeluar.id_bkeluar = detbkeluar.id_bkeluar')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('bkeluar.id_bkeluar')
         ->get()->getResultArray();
   }
   public function tglhistkeluar($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");

      return $this->db->table('bkeluar')
         ->select('*')
         ->select("DATE(bkeluar.tanggal) as tgl")
         ->selectCount('id_detbkeluar', 'banyak')
         ->join('detbkeluar', 'bkeluar.id_bkeluar = detbkeluar.id_bkeluar')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('bkeluar.id_bkeluar')
         ->get()->getResultArray();
   }
   public function histkeluar($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('barang')
         ->select('barang.id_barang,barang.nama,barang.satuan')
         ->selectSum('detbkeluar.jumlah', 'totalkeluar')
         ->selectSum('detbkeluar.kekurangan', 'totalkurang')
         ->join('detbkeluar', 'barang.id_barang = detbkeluar.id_barang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->where('bkeluar.id_bkeluar', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }

   //histori so

   public function tampilhistso()
   {
      return $this->db->table('so')
         ->select('*')
         ->select("DATE(so.tanggal) as tgl")
         ->selectCount('id_detso', 'banyak')
         ->join('detso', 'so.id_so = detso.id_so')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('so.id_so')
         ->get()->getResultArray();
   }
   public function tglhistso($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");

      return $this->db->table('so')
         ->select('*')
         ->select("DATE(so.tanggal) as tgl")
         ->selectCount('id_detso', 'banyak')
         ->join('detso', 'so.id_so = detso.id_so')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('so.id_so')
         ->get()->getResultArray();
   }
   public function histso($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('so')
         ->select('*')
         ->join('detso', 'so.id_so = detso.id_so')
         ->join('barang', 'detso.id_barang = barang.id_barang')
         ->where('so.id_so', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }

   //histori penyesuaian
   public function histpenyesuaian($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('so')
         ->select('*')
         ->select("detso.status as stat")
         ->select("penyesuaian.jumlah as jum")
         ->select("penyesuaian.status as stats")
         ->join('detso', 'so.id_so = detso.id_so')
         ->join('penyesuaian', 'detso.id_detso = penyesuaian.id_detso')
         ->join('barang', 'detso.id_barang = barang.id_barang')
         ->where('so.id_so', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }

   //histori pbkeluar
   public function tampilhistpbkeluar()
   {
      return $this->db->table('pbkeluar')
         ->select('*')
         ->select("DATE(pbkeluar.tanggal) as tgl")
         ->selectCount('id_detpbkeluar', 'banyak')
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('pbkeluar.id_pbkeluar')
         ->get()->getResultArray();
   }
   public function tglhistpbkeluar($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");

      return $this->db->table('pbkeluar')
         ->select('*')
         ->select("DATE(pbkeluar.tanggal) as tgl")
         ->selectCount('id_detpbkeluar', 'banyak')
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('pbkeluar.id_pbkeluar')
         ->get()->getResultArray();
   }
   public function histpbkeluar($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('pbkeluar')
         ->select('*')
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->join('barang', 'detpbkeluar.id_barang = barang.id_barang')
         ->where('pbkeluar.id_pbkeluar', $id)
         ->groupBy('barang.id_barang')
         ->get()->getResultArray();
   }

   //histori belanja
   public function tampilhistbelanja()
   {
      return $this->db->table('belanja')
         ->select('*')
         ->select("DATE(belanja.tanggal) as tgl")
         ->selectCount('id_detbel', 'banyak')
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('belanja.id_belanja')
         ->get()->getResultArray();
   }
   public function tglhistbelanja($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");

      return $this->db->table('belanja')
         ->select('*')
         ->select("DATE(belanja.tanggal) as tgl")
         ->selectCount('id_detbel', 'banyak')
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->where('tanggal >=', date($awal))
         ->where('tanggal <=', date($akhir))
         ->groupBy('belanja.id_belanja')
         ->get()->getResultArray();
   }
   public function histbelanja($id)
   {
      // return $this->db->query("select `barang`.`id_barang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_barang` = `detbkeluar`.`id_barang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_barang`");
      return $this->db->table('belanja')
         ->select('*')
         ->join('detbelanja', 'belanja.id_belanja = detbelanja.id_belanja')
         ->join('barang', 'detbelanja.id_barang = barang.id_barang')
         ->where('belanja.id_belanja', $id)
         ->groupBy('barang.id_barang')
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
}
