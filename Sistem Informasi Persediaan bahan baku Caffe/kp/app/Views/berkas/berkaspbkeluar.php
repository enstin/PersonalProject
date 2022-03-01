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
            <th><b>Nama Barang</b></th>
            <th><b>Jumlah</b></th>
            <th><b>Satuan</b></th>
        </tr>
        <?php foreach ($tabel as $list) : ?>
            <tr>
                <td><?= $list['nama']; ?></td>
                <td><?= $list['jumlah']; ?></td>
                <td><?= $list['satuan']; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <br>
    <br>
    Mengetahui
    <br>
    Barista
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