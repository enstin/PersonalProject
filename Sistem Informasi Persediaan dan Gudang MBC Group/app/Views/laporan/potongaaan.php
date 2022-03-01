laporan bkeluar
<?php foreach ($tabel as $dump) : ?>
    <tr>
        <td><?= $dump['id_barang']; ?></td>
        <td><?= $dump['nama']; ?></td>
        <td><?= $dump['totalkeluar']; ?></td>
        <td><?= $dump['totalkurang']; ?></td>
        <td><?= $dump['satuan']; ?></td>
    </tr>
<?php endforeach; ?>

laporan bmasuktampil

<?php foreach ($tabel as $dump) : ?>
    <tr>
        <td><?= $dump['id_barang']; ?></td>
        <td><?= $dump['nama']; ?></td>
        <td><?= $dump['totalmasuk']; ?></td>
        <td><?= $dump['satuan']; ?></td>
        <td><?= $dump['totalharga']; ?></td>
    </tr>
<?php endforeach; ?>