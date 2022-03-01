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
                        <div class="card-header">
                            <H4>PENYESUAIAN STOK OPNAME</H4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Stok opname</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tb_so as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_so']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['status']; ?></td>
                                            <td><a href="<?= $link; ?>/transaksi-penyesuaian/<?= $data['id_so']; ?>" class="btn btn-success" id="trans<?= $data['id_so']; ?>">Lihat Detail</a></td>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <H4>PERSETUJUAN STOCK OPNAME</H4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Stok opname</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tb_sesuai as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_so']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['status']; ?></td>
                                            <td>
                                                <a href="<?= $link; ?>/transaksi-persetujuan/<?= $data['id_so']; ?>" class="btn btn-success" id="trans<?= $data['id_so']; ?>">Lihat Detail</a>
                                                <a href="<?= $link; ?>/cetak/<?= $data['id_so']; ?>" class="btn btn-primary" id="trans<?= $data['id_so']; ?>">Cetak</a>
                                            </td>
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


<?= $this->endSection(); ?>