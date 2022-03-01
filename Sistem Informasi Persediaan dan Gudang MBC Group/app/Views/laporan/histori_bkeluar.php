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
                            <h3 class="card-title">Daftar Barang keluar</h3>
                        </div>
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <!-- /.card-header -->
                            <form action="/histbkeluartgl" method="post">
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
                            <!-- /.card-header -->
                            <form action="/histbkeluartgl_g2" method="post">
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
                        <?php elseif (session()->get('gudang') == 'g3') : ?>
                            <!-- /.card-header -->
                            <form action="/histbkeluartgl_g3" method="post">
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
                        <!-- /.card-header -->
                        <br>
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>User</th>
                                    <th>tanggal</th>
                                    <th>gudang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tabel as $histori) : ?>
                                    <tr>
                                        <td> <?= $histori['id_bkeluar']; ?></td>
                                        <td> <?= $histori['nama']; ?></td>
                                        <td> <?= $histori['tgl']; ?></td>
                                        <td> <?= $histori['gudang']; ?></td>
                                        <?php if (session()->get('gudang') == 'g1') : ?>
                                            <td><a href="/histbkeluar/<?= $histori['id_bkeluar']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
                                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                                            <td><a href="/histbkeluar_g2/<?= $histori['id_bkeluar']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
                                        <?php elseif (session()->get('gudang') == 'g3') : ?>
                                            <td><a href="/histbkeluar_g3/<?= $histori['id_bkeluar']; ?>" type="submit" class="btn btn-primary" target="_blank">Cetak</a></td>
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