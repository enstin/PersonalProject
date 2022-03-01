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
    <div style="font-size:28px;  text-align: center; "><u>UD JAYA ABADI</u>
        <br><label style="font-size:18px;  text-align: center; ">Harjowinangun, Triyagan, Kec. Mojolaban, Kabupaten Sukoharjo, Jawa Tengah 57554
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
                                        <th>Jenis</th>
                                        <th>Kwalitas</th>
                                        <th>total masuk</th>
                                        <th>satuan</th>
        </tr>
        <?php foreach ($tabel as $list) : ?>
            <tr>
            <td><?= $list['nama']; ?></td>
                                            <td><?= $list['jenis']; ?></td>
                                            <td><?= $list['kwalitas']; ?></td>
                                            <td><?= $list['totalmasuk']; ?></td>
                                            <td><?= $list['satuan']; ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>