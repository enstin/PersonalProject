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
    <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
        <?php if (session()->get('gudang') == 'g1') : ?>
            <a style="margin-left: 14px;" href="/bmasuk/tambah_draftbmasuk" class="btn btn-primary">+TAMBAH BARANG MASUK INDEPENDEN+</a>
        <?php elseif (session()->get('gudang') == 'g2') : ?>
            <a style="margin-left: 14px;" href="/bmasuk_g2/tambah_draftbmasuk" class="btn btn-primary">+TAMBAH BARANG MASUK INDEPENDEN+</a>
        <?php else : ?>
            <a style="margin-left: 14px;" href="/bmasuk_g3/tambah_draftbmasuk" class="btn btn-primary">+TAMBAH BARANG MASUK INDEPENDEN+</a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (session()->get('gudang') == 'g1' && session()->get('jabatan') == 'Kepala_gudang') : ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="text-align:center;">PEMESANAN</h4>
                                <div class="card-header">

                                </div>
                                <!-- /.card-header -->
                                <div class="row">
                                    <div class="col-4">


                                    </div>
                                </div>
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
                                                        <a href="/bmasuk/draftbmasuk/<?= $data['id_pesan']; ?>" class="btn btn-success">PROSES PEMESANAN MASUK</a>
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
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="text-align:center;">PERMINTAAN</h4>
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
                                        <th>ID permintaan</th>
                                        <th>Dikirim dari</th>
                                        <th>tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_minta as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_permintaan']; ?></td>
                                            <td> <?= $data['tujuan']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['status']; ?></td>
                                            <td>
                                                <?php if (session()->get('gudang') == 'g1') : ?>
                                                    <a href="/bmasuk/draftbmasuk_minta/<?= $data['id_permintaan']; ?>" class="btn btn-success">PROSES PERMINTAAN MASUK</a>
                                                <?php elseif (session()->get('gudang') == 'g2') : ?>
                                                    <a href="/bmasuk_g2/draftbmasuk_minta/<?= $data['id_permintaan']; ?>" class="btn btn-success">PROSES PERMINTAAN MASUK</a>
                                                <?php else : ?>
                                                    <a href="/bmasuk_g3/draftbmasuk_minta/<?= $data['id_permintaan']; ?>" class="btn btn-success">PROSES PERMINTAAN MASUK</a>
                                                <?php endif; ?>

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
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>