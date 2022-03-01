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
                            <h3 class="card-title">Daftar Tindakan Penyesuaian</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if (session()->get('gudang') == 'g1') : ?>
                                <form action="/histpenyesuaiantgl" method="post">
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
                            <?php elseif (session()->get('gudang') == 'g2') : ?>
                                <form action="/histpenyesuaiantgl_g2" method="post">
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
                            <?php else : ?>
                                <form action="/histpenyesuaiantgl_g3" method="post">
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
                            <?php endif; ?>

                            <br>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>user</th>
                                        <th>gudang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tabel as $dump) : ?>
                                        <tr>
                                            <td><?= $dump['id_penyesuaian']; ?></td>
                                            <td><?= $dump['tgl']; ?></td>
                                            <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['gudang']; ?></td>
                                            <?php if (session()->get('gudang') == 'g1') : ?>
                                                <td><a href="/histpenyesuaian/<?= $dump['id_penyesuaian']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
                                            <?php elseif (session()->get('gudang') == 'g2') : ?>
                                                <td><a href="/histpenyesuaian_g2/<?= $dump['id_penyesuaian']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
                                            <?php else : ?>
                                                <td><a href="/histpenyesuaian_g3/<?= $dump['id_penyesuaian']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
                                            <?php endif; ?>
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
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>