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
            <th><b>Kode Barang</b></th>
            <th><b>Nama</b></th>
            <th><b>total masuk</b></th>
            <th><b>satuan</b></th>
            <th><b>Total Harga beli</b></th>
        </tr>
        <?php foreach ($tabel as $list) : ?>
            <tr>
                <td><?= $list['id_barang']; ?></td>
                <td><?= $list['nama']; ?></td>
                <td><?= $list['totalmasuk']; ?></td>
                <td><?= $list['satuan']; ?></td>
                <td><?= $list['totalharga']; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>