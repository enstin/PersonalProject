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
                            <h3 class="card-title">Daftar Barang Masuk</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/lapkmasuktampil" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <!-- Date range -->
                                            <div class="form-group">
                                                <label>Tentukan Tanggal</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name='tgl' class="form-control float-right" id="reservation" required>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                            </form>
                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>nama</th>
                                        <th>Jenis</th>
                                        <th>Kwalitas</th>
                                        <th>total masuk</th>
                                        <th>satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tabel as $dump) : ?>
                                        <tr>
                                        <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['jenis']; ?></td>
                                            <td><?= $dump['kwalitas']; ?></td>
                                            <td><?= $dump['totalmasuk']; ?></td>
                                            <td><?= $dump['satuan']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <a href="/lapkmasuktampil/cetak" type="submit" class="btn btn-primary" target="_blank">Cetak</a>
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