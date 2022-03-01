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
        <H2 align='Center' BOLD >SURAT JALAN</H2>  <br>
        Dicetak pada tanggal : <?= $tgl; ?><br>
    </p>
    <table border="1">
        <tr>
            <th>nama</th>
            <th>ukuran</th>
            <th>berat</th>
            <th>brand</th>
            <th>jumlah</th>
            <th>satuan</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($tabel as $pesan) : ?>
                <tr>
                    <td><?= $pesan['nama']; ?></td>
                    <td><?= $pesan['ukuran']; ?></td>
                    <td><?= $pesan['berat']; ?></td>
                    <td><?= $pesan['brand']; ?></td>
                    <td><?= $pesan['jumlah']; ?></td>
                    <?php if ($pesan['convert'] == 'con1') : ?>
                        <td><?= $pesan['satuan1']; ?></td>
                    <?php elseif ($pesan['convert'] == 'con2') : ?>
                        <td><?= $pesan['satuan2']; ?></td>
                    <?php else : ?>
                        <td><?= $pesan['satuan3']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
    </table>
    <br>
    <br>
    <div class="col-sm-12">
        <p class="col " style="margin-right: 30px; margin-top: 60px;">Sukoharjo,............</p>
    </div>
    <div class="col-sm-12">
        <p class="col " style="margin-right: 30px; margin-top: 80px;">(.............................)</p>
    </div>
</body>

</html>