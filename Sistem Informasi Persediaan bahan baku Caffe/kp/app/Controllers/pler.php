for ($i = 0; $i < $hitung; $i++) { $fi=$this->model->tabelfifo($kondisi);
    $fisisabesar = $fi[$i]['sisa'];
    $fibrgm = $fi[$i]['id_detbmasuk'];
    $sisafifobesar = $jmlbardumkel - $fisisabesar;
    echo $sisafifobesar;
    if ($sisafifobesar > 0) {
    $update = [
    'sisa' => 0,
    'keluar' => $fisisabesar,
    ];
    $idsu = [
    'id_barang' => $idbardumkel,
    'id_detbmasuk' => $fibrgm,
    ];
    echo 'ini kalau keluar masih ada nilai <br>';
    var_dump($update, $idsu);
    echo '<br>';
    // $this->model->updatefifo($update, $idsu);
    } else {
    echo '=====================' . $sisafifobesar . '<br>';
    $update = [
    'sisa' => $fisisabesar - $jmlbardumkel + (($fisisabesar - $jmlbardumkel) / 2),
    'keluar' => $fisisabesar / 4,
    ];
    $idsu = [
    'id_barang' => $idbardumkel,
    'id_detbmasuk' => $fibrgm,
    ];
    echo 'ini kalau keluar selesai <br>';
    var_dump($update, $idsu);
    echo '<br>';
    echo '<br>';
    // $this->model->updatefifo($update, $idsu);
    }
    }