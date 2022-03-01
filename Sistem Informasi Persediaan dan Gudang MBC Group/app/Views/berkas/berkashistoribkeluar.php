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
        <thead>
            <tr>
                <th>Barang</th>
                <th>ukuran</th>
                <th>berat</th>
                <th>brand</th>
                <th>Jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabel as $histori) : ?>
                <tr>
                    <td><?= $histori['nama']; ?></td>
                    <td><?= $histori['ukuran']; ?></td>
                    <td><?= $histori['berat']; ?></td>
                    <td><?= $histori['brand']; ?></td>
                    <td> <?= $histori['jumlah']; ?></td>
                    <?php if ($histori['convert'] == 'con1') : ?>
                        <td> <?= $histori['satuan1']; ?></td>
                    <?php elseif ($histori['convert'] == 'con2') : ?>
                        <td> <?= $histori['satuan2']; ?></td>
                    <?php else : ?>
                        <td> <?= $histori['satuan3']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

    </table>
</body>

</html>