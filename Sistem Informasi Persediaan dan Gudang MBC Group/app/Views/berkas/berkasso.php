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
</head>

<body onload="window.print()">
    <div style="font-size:28px;  text-align: center; "><u>TOKO KERTAS MBC</u>
        <br><label style="font-size:18px;  text-align: center; ">Pd. III, Pondok, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah
        </label>
    </div>
    <hr>
    <p>
        <H2 align='Center' BOLD ><?= $title; ?> </H2>  <br>
        Dicetak pada tanggal : <?= $tgl; ?><br>
    </p>
    <hr>
    <p></p>
    <table border="1">
        <tr>
            <th><b>Nama Barang</b></th>
            <th><b>Jumlah Stok</b></th>
            <th><b>Jumlah Riil</b></th>
            <th><b>Status</b></th>
            <th><b>Selisih</b></th>
            <th><b>Satuan</b></th>
        </tr>
        <?php foreach ($tb as $list) : ?>
            <tr>
                <td><?= $list['nama']; ?></td>
                <td><?= $list['jml_stok']; ?></td>
                <td><?= $list['jml_so']; ?></td>
                <td><?= $list['status']; ?></td>
                <td><?= $list['selisih']; ?></td>
                <td><?= $list['satuan']; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>