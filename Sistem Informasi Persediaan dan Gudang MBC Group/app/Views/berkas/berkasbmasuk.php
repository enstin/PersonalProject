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
        <?= $range; ?><br>
        Dicetak pada tanggal : <?= $tgl; ?><br>
    </p>
    <hr>
    <p></p>
    <table border="1">
        <tr>
            <th>nama</th>
            <th>Ukuran</th>
            <th>Berat</th>
            <th>Brand</th>
            <th>total masuk</th>
            <th>satuan</th>
        </tr>
        <?php foreach ($tabel as $list) : ?>
            <tr>
                <td><?= $list['nama']; ?></td>
                <td><?= $list['ukuran']; ?></td>
                <td><?= $list['berat']; ?></td>
                <td><?= $list['brand']; ?></td>
                <td><?= $list['totalmasuk']; ?></td>
                <?php if ($list['convert'] == 'con1') : ?>
                    <td><?= $list['satuan1']; ?></td>
                <?php elseif ($list['convert'] == 'con2') : ?>
                    <td><?= $list['satuan2']; ?></td>
                <?php else : ?>
                    <td><?= $list['satuan3']; ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>