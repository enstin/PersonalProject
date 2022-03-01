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
            <th>Nama Barang</th>
            <th>ukuran</th>
            <th>berat</th>
            <th>Brand</th>
            <th>Jenis</th>
            <th>Stok Base</th>
            <th>Satuan Base</th>
            <th>Stok konversi 1</th>
            <th>Satuan konversi 1</th>
            <th>Stok konversi 2</th>
            <th>Satuan konversi 2</th>
            <th>Gudang</th>
        </tr>
        <?php foreach ($tabel as $dump) : ?>
            <tr>
                <td><?= $dump['nama']; ?></td>
                <td><?= $dump['ukuran']; ?></td>
                <td><?= $dump['berat']; ?></td>
                <td><?= $dump['brand']; ?></td>
                <td><?= $dump['jenis']; ?></td>
                <td><?= $dump['stok_base']; ?></td>
                <td><?= $dump['satuan1']; ?></td>
                <td><?= $dump['stok_con1']; ?></td>
                <td><?= $dump['satuan2']; ?></td>
                <td><?= $dump['stok_con2']; ?></td>
                <td><?= $dump['satuan3']; ?></td>
                <td><?= $dump['gudang']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>