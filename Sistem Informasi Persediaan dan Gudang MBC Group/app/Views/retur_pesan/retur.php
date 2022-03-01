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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <H4 align="center">PEMESANAN DITERIMA</H4>
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Pemesanan</th>
                                        <th>Supplier</th>
                                        <th>tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_pesan']; ?></td>
                                            <td> <?= $data['nama_perusahaan']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['status_pesan']; ?></td>
                                            <td>
                                                <!-- untuk pemilik dan kepala gudang -->
                                                <a href="/retpesan/draftretur/<?= $data['id_pesan']; ?>" class="btn btn-success">BUAT RETUR PEMESANAN</a>
                                                <!-- untuk pemilik saja -->
                                                <!-- <a href="/pemesanan/setujui/<?= $data['id_pesan']; ?>" class="btn btn-primary">SETUJUI</a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <H4 align="center"> PENERIMAAN DATA RETUR</H4>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-4">

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Supplier</th>
                                        <th>tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_terima as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_retpesan']; ?></td>
                                            <td> <?= $data['nama_perusahaan']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['status_retur']; ?></td>
                                            <td>
                                                <!-- untuk pemilik dan kepala gudang -->
                                                <a href="/retpesan/terima-retur/<?= $data['id_retpesan']; ?>" class="btn btn-success">PROSES PENERIMAAN RETUR</a>
                                                <!-- untuk pemilik saja -->
                                                <!-- <a href="/pemesanan/setujui/<?= $data['id_pesan']; ?>" class="btn btn-primary">SETUJUI</a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>