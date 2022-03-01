<?php

namespace App\Models;

use CodeIgniter\Model;

class modlaporan extends Model
{
   public function tampilkmasuktgl($awal, $akhir)
   {
      return $this->db->table('kayu')
         ->select('*')
         ->selectSum('det_kayu_masuk.jumlah', 'totalmasuk')
         ->join('det_kayu_masuk', 'kayu.id_kayu = det_kayu_masuk.id_kayu')
         ->join('kayu_masuk', 'det_kayu_masuk.id_km = kayu_masuk.id_km')
         // ->where('tanggal >=', date($awal))
         // ->where('tanggal <=', date($akhir))
         ->where("DATE(tanggal) between '" . $awal .  "' and '" . $akhir . "'")
         ->groupBy('det_kayu_masuk.id_kayu')
         ->get()->getResultArray();
   }
}
