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
                            <H4>RENCANA BELANJA DISETUJUI</H4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Belanja</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $data) : ?>
                                        <tr>
                                            <td> <?= $data['id_belanja']; ?></td>
                                            <td> <?= $data['tanggal']; ?></td>
                                            <td> <?= $data['total']; ?></td>
                                            <td> <?= $data['status']; ?></td>
                                            <td><a href="<?= $link; ?>/transaksi-barangmasuk/<?= $data['id_belanja']; ?>" class="btn btn-success" id="trans<?= $data['id_belanja']; ?>">MASUKAN BARANG</a></td>
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
                            <H4>HISTORI BARANG MASUK</H4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Tanggal masuk</th>
                                        <th>Tanggal expired</th>
                                        <th>jumlah masuk</th>
                                        <th>keluar</th>
                                        <th>sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_histori as $histori) : ?>
                                        <tr>
                                            <td> <?= $histori['nama']; ?></td>
                                            <td> <?= $histori['tanggal']; ?></td>
                                            <td> <?= $histori['ex_date']; ?></td>
                                            <td> <?= $histori['jumlah']; ?></td>
                                            <td> <?= $histori['keluar']; ?></td>
                                            <td> <?= $histori['sisa']; ?></td>
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