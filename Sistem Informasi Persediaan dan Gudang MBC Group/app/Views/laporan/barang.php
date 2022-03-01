<?= $this->extend('baselayout'); ?>
<!-- section content -->
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.card -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
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
                                    </tr>
                                </thead>
                                <tbody>
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <a href="/laporan/barang/cetak" type="submit" class="btn btn-primary" target="_blank">Cetak</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>