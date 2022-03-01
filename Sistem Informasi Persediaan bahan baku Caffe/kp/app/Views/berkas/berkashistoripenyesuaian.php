<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
            height: 20px;
        }
    </style>
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
</head>

<body onload="window.print()">
    <div style="font-size:28px;  text-align: center; "><u>REMBUG KOPI</u>
        <br><label style="font-size:18px;  text-align: center; ">Jl. Veteran No.148, Warungboto, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta
        </label>
    </div>
    <hr>
    <p>
        <?= $title; ?> <br>
        Dicetak pada tanggal : <?= $tgl; ?><br>
    </p>
    <hr>
    <p></p>
    <table border="1">
        <tr>
            <th><b>Nama Barang</b></th>
            <th><b>Jumlah di sistem</b></th>
            <th><b>Jumlah Riil</b></th>
            <th><b>Status SO</b></th>
            <th><b>Selisih</b></th>
            <th><b>Tindakan</b></th>
            <th><b>Jumlah</b></th>
            <th><b>Tindakan akhir</b></th>
            <th><b>Satuan</b></th>
            <th><b>Keterangan</b></th>
        </tr>
        <?php foreach ($tabel as $list) : ?>
            <tr>
                <td><?= $list['nama']; ?></td>
                <td><?= $list['jml_stok']; ?></td>
                <td><?= $list['jml_so']; ?></td>
                <td><?= $list['stat']; ?></td>
                <td><?= $list['selisih']; ?></td>
                <td><?= $list['tindakan']; ?></td>
                <td><?= $list['jum']; ?></td>
                <td><?= $list['stats']; ?></td>
                <td><?= $list['satuan']; ?></td>
                <td><?= $list['keterangan']; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <br>
    <br>
    Mengetahui
    <br>
    Pemilik
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    (_________________________)
    <br>
    <br>
    Staff Gudang
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    (_________________________)
</body>

</html>