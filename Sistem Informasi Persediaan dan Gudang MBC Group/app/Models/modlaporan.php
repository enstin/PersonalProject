<?php

namespace App\Models;

use CodeIgniter\Model;

class modlaporan extends Model
{
   public function tampilbarang()
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->join('gudang', 'detbarang.id_gudang=gudang.id_gudang')
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
         ->where('id_detbarang', $id)
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
      return $this->db->table('detbarang')
         ->select('*')
         ->selectSum('detbmasuk.jumlah', 'totalmasuk')
         ->join('detbmasuk', 'detbarang.id_detbarang = detbmasuk.id_detbarang')
         ->join('bmasuk', 'detbmasuk.id_bmasuk=bmasuk.id_bmasuk')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
         ->groupBy('detbarang.id_detbarang')
         ->groupBy('detbmasuk.con')
         ->get()->getResultArray();
   }
   public function tampilbkeluarg()
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->selectSum('detbkeluar.jumlah', 'totalkeluar')
         ->join('detbkeluar', 'detbarang.id_detbarang = detbkeluar.id_detbarang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 7 DAY)")
         ->groupBy('detbarang.id_detbarang')
         ->groupBy('detbkeluar.convert')
         ->get()->getResultArray();
   }
   public function tampilbmasuktgl($awal, $akhir)
   {
      return $this->db->table('detbarang')
         ->select('*')
         ->selectSum('detbmasuk.jumlah', 'totalmasuk')
         ->join('detbmasuk', 'detbarang.id_detbarang = detbmasuk.id_detbarang')
         ->join('bmasuk', 'detbmasuk.id_masuk=bmasuk.id_bmasuk')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         // ->where('tanggal >=', date($awal))
         // ->where('tanggal <=', date($akhir))
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('detbarang.id_detbarang')
         ->groupBy('detbmasuk.convert')
         ->get()->getResultArray();
   }
   public function tampilbkeluartgl($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('detbarang')
         ->select('*')
         ->selectSum('detbkeluar.jumlah', 'totalkeluar')
         ->join('detbkeluar', 'detbarang.id_detbarang = detbkeluar.id_detbarang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         // ->where('tanggal >=', date($awal))
         // ->where('tanggal <=', date($akhir))
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('detbarang.id_detbarang')
         ->groupBy('detbkeluar.convert')
         ->get()->getResultArray();
   }
   //histori barang masuk
   public function tampilhistmasuk()
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('bmasuk')
         ->select('*')
         ->select("DATE(bmasuk.tanggal) as tgl")
         ->join('user', 'bmasuk.id_user=user.id_user')
         ->join('gudang', 'gudang.id_gudang=bmasuk.id_gudang')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('id_bmasuk')
         ->get()->getResultArray();
   }
   public function tglhistmasuk($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('bmasuk')
         ->select('*')
         ->select("DATE(bmasuk.tanggal) as tgl")
         ->join('user', 'bmasuk.id_user=user.id_user')
         ->join('gudang', 'bmasuk.id_gudang=gudang.id_gudang')
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('bmasuk.id_bmasuk')
         ->get()->getResultArray();
   }
   public function histmasuk($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('detbarang')
         ->select('*')
         ->join('detbmasuk', 'detbarang.id_detbarang = detbmasuk.id_detbarang')
         ->join('bmasuk', 'detbmasuk.id_masuk=bmasuk.id_bmasuk')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('bmasuk.id_bmasuk', $id)
         ->get()->getResultArray();
   }

   //histori barang keluar
   public function tampilhistkeluar()
   {
      return $this->db->table('bkeluar')
         ->select('*')
         ->select("DATE(bkeluar.tanggal) as tgl")
         ->join('detbkeluar', 'bkeluar.id_bkeluar = detbkeluar.id_bkeluar')
         ->join('gudang', 'gudang.id_gudang=bkeluar.id_gudang')
         ->join('user', 'bkeluar.id_user = user.id_user')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('bkeluar.id_bkeluar')
         ->get()->getResultArray();
   }
   public function tglhistkeluar($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

      return $this->db->table('bkeluar')
         ->select('*')
         ->select("DATE(bkeluar.tanggal) as tgl")
         ->join('user', 'bkeluar.id_user = user.id_user')
         ->join('gudang', 'bkeluar.id_gudang=gudang.id_gudang')
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('bkeluar.id_bkeluar')
         ->get()->getResultArray();
   }
   public function histkeluar($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('detbarang')
         ->select('*')
         ->join('detbkeluar', 'detbarang.id_detbarang = detbkeluar.id_detbarang')
         ->join('bkeluar', 'detbkeluar.id_bkeluar=bkeluar.id_bkeluar')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('bkeluar.id_bkeluar', $id)
         ->get()->getResultArray();
   }

   //histori so

   public function tampilhistso()
   {
      return $this->db->table('so')
         ->select('*')
         ->select("DATE(so.tanggal) as tgl")
         ->join('user', 'so.id_user=user.id_user')
         ->join('gudang', 'so.id_gudang=gudang.id_gudang')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('so.id_so')
         ->get()->getResultArray();
   }
   public function tglhistso($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

      return $this->db->table('so')
         ->select('*')
         ->select("DATE(so.tanggal) as tgl")
         ->join('user', 'so.id_user=user.id_user')
         ->join('gudang', 'so.id_gudang=gudang.id_gudang')
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('so.id_so')
         ->get()->getResultArray();
   }
   public function histso($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('so')
         ->select('*')
         ->join('detso', 'so.id_so = detso.id_so')
         ->join('detbarang', 'detso.id_detbarang = detbarang.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('so.id_so', $id)
         ->groupBy('detbarang.id_detbarang')
         ->get()->getResultArray();
   }

   //histori penyesuaian
   public function histpenyesuaian($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('penyesuaian')
         ->select('*')
         ->select('detpenyesuaian.status as status_sesuai,detso.status as status_so')
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian = detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detpenyesuaian.id_detso = detso.id_detso')
         ->join('detbarang', 'detso.id_detbarang = detbarang.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('penyesuaian.id_penyesuaian', $id)
         ->get()->getResultArray();
   }

   //histori pbkeluar

   public function tglhistpbkeluar($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

      return $this->db->table('pbkeluar')
         ->select('*')
         ->select("DATE(pbkeluar.tanggal) as tgl")
         ->selectCount('id_detpbkeluar', 'banyak')
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('pbkeluar.id_pbkeluar')
         ->get()->getResultArray();
   }
   public function histpbkeluar($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('pbkeluar')
         ->select('*')
         ->join('detpbkeluar', 'pbkeluar.id_pbkeluar = detpbkeluar.id_pbkeluar')
         ->join('barang', 'detpbkeluar.id_detbarang = barang.id_detbarang')
         ->where('pbkeluar.id_pbkeluar', $id)
         ->groupBy('barang.id_detbarang')
         ->get()->getResultArray();
   }

   //histori belanja
   public function tampilhistpemesanan()
   {
      return $this->db->table('pemesanan')
         ->select('*')
         ->select("DATE(pemesanan.tanggal) as tgl")
         ->join('user', 'pemesanan.id_user=user.id_user')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('pemesanan.id_pesan')
         ->get()->getResultArray();
   }
   public function tglhistpemesanan($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

      return $this->db->table('pemesanan')
         ->select('*')
         ->select("DATE(pemesanan.tanggal) as tgl")
         ->join('user', 'pemesanan.id_user=user.id_user')
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('pemesanan.id_pesan')
         ->get()->getResultArray();
   }
   public function histpemesanan($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('pemesanan')
         ->select('*')
         ->join('detpemesanan', 'pemesanan.id_pesan = detpemesanan.id_pesan')
         ->join('detbarang', 'detpemesanan.id_detbarang = detbarang.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('pemesanan.id_pesan', $id)
         ->groupBy('detbarang.id_detbarang')
         ->get()->getResultArray();
   }
   //histori permintaan
   public function tampilhistpermintaan()
   {
      return $this->db->table('permintaan')
         ->select('*')
         ->select("DATE(permintaan.tanggal) as tgl")
         ->join('gudang', 'gudang.id_gudang=permintaan.asal')
         ->join('user', 'permintaan.id_user=user.id_user')
         ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->groupBy('permintaan.id_permintaan')
         ->get()->getResultArray();
   }
   // public function tampilhistpermintaan2()
   // {
   //    return $this->db->table('permintaan')
   //       ->select("gudang.gudang AS dari_g, tuj.gudang AS tujuan_g")
   //       ->select('*')
   //       ->join('gudang', 'permintaan.asal=gudang.id_gudang')
   //       ->join('', 'permintaan.tujuan=tuj.id_gudang')
   //       ->where("DATE(tanggal) > (NOW() - INTERVAL 30 DAY)")
   //       ->groupBy('permintaan.id_permintaan')
   //       ->get()->getResultArray();
   // }
   public function tampilhistpermintaan2()
   {
      return $this->db->query("SELECT permintaan.id_permintaan,user.nama,permintaan.tanggal,gudang.gudang AS dari_g, tuj.gudang AS tujuan_g
      FROM permintaan
      JOIN gudang ON permintaan.asal=gudang.id_gudang
      JOIN gudang tuj ON permintaan.tujuan=tuj.id_gudang
      JOIN user ON user.id_user=permintaan.id_user
      where DATE(tanggal) > (NOW() - INTERVAL 30 DAY)
      ")
         ->getResultArray();
   }

   public function tglhistpermintaan($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

     return $this->db->query("SELECT permintaan.id_permintaan,user.nama,permintaan.tanggal,gudang.gudang AS dari_g, tuj.gudang AS tujuan_g
      FROM permintaan
      JOIN gudang ON permintaan.asal=gudang.id_gudang
      JOIN gudang tuj ON permintaan.tujuan=tuj.id_gudang
      JOIN user ON user.id_user=permintaan.id_user
      where DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'"
      )
         ->getResultArray();
   }
   public function histpermintaan($id)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");
      return $this->db->table('permintaan')
         ->select('*')
         ->join('detpermintaan', 'permintaan.id_permintaan = detpermintaan.id_permintaan')
         ->join('detbarang', 'detpermintaan.id_detbarang = detbarang.id_detbarang')
         ->join('barang', 'detbarang.id_barang=barang.id_barang')
         ->join('cr', 'detbarang.id_cr=cr.id_cr')
         ->join('ukuran', 'ukuran.id_ukuran=detbarang.id_ukuran')
         ->join('berat', 'berat.id_berat=detbarang.id_berat')
         ->join('brand', 'brand.id_brand=detbarang.id_brand')
         ->where('permintaan.id_permintaan', $id)
         ->groupBy('detbarang.id_detbarang')
         ->get()->getResultArray();
   }


   public function tampilhistpenyesuaian()
   {
      return $this->db->table('penyesuaian')
         ->select('*')
         ->select("DATE(penyesuaian.tanggal) as tgl")
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->join('user', 'penyesuaian.id_user=user.id_user')
         ->join('gudang', 'so.id_gudang=gudang.id_gudang')
         ->where("DATE(penyesuaian.tanggal) > (NOW() - INTERVAL 30 DAY)")
         ->get()->getResultArray();
   }
   public function tglhistpenyesuaian($awal, $akhir)
   {
      // return $this->db->query("select `barang`.`id_detbarang`, `barang`.`nama`, `barang`.`satuan`, SUM(`detbkeluar`.`jumlah`) AS `totalkeluar`, SUM(`detbkeluar`.`kekurangan`) AS `totalkurang` FROM `barang` JOIN `detbkeluar` ON `barang`.`id_detbarang` = `detbkeluar`.`id_detbarang` JOIN `bkeluar` ON `detbkeluar`.`id_bkeluar`=`bkeluar`.`id_bkeluar` WHERE DATE(bkeluar.tanggal)  BETWEEN DATE('" . $awal . "') AND DATE('" . $akhir . "') GROUP BY `barang`.`id_detbarang`");

      return $this->db->table('penyesuaian')
         ->select('*')
         ->select("DATE(penyesuaian.tanggal) as tgl")
         ->join('detpenyesuaian', 'penyesuaian.id_penyesuaian=detpenyesuaian.id_penyesuaian')
         ->join('detso', 'detso.id_detso=detpenyesuaian.id_detso')
         ->join('so', 'so.id_so=detso.id_so')
         ->join('user', 'penyesuaian.id_user=user.id_user')
         ->join('gudang', 'so.id_gudang=gudang.id_gudang')
         ->where("DATE(penyesuaian.tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('penyesuaian.id_penyesuaian')
         ->get()->getResultArray();
   }
}
