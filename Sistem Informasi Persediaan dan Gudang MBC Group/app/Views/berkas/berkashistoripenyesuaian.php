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
            <th>nama barang</th>
            <th>ukuran</th>
            <th>berat</th>
            <th>brand</th>
            <th>jumlah stok (sistem)</th>
            <th>jumlah rill</th>
            <th>Status SO</th>
            <th>selisih</th>
            <th>tindakan</th>
            <th>Status Penyesuaian</th>
            <th>jumlah</th>
            <th>satuan</th>
            <th>keterangan</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($tabel as $data) : ?>
                <tr>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['ukuran']; ?></td>
                    <td><?= $data['berat']; ?></td>
                    <td><?= $data['brand']; ?></td>
                    <td><?= $data['jumlah_sistem']; ?></td>
                    <td><?= $data['jumlah_riil']; ?></td>
                    <td><?= $data['status_so']; ?></td>
                    <td><?= $data['selisih']; ?></td>
                    <td><?= $data['tindakan']; ?></td>
                    <td><?= $data['status_sesuai']; ?></td>
                    <td><?= $data['jumlah']; ?></td>
                    <?php if ($data['convert'] == 'con1') : ?>
                        <td><?= $data['satuan1']; ?></td>
                    <?php elseif ($data['convert'] == 'con2') : ?>
                        <td><?= $data['satuan2']; ?></td>
                    <?php else : ?>
                        <td><?= $data['satuan3']; ?></td>
                    <?php endif; ?>
                    <td><?= $data['keterangan']; ?></td>
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
    Kepala Gudang Pusat
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    (_________________________)
</body>

</html>