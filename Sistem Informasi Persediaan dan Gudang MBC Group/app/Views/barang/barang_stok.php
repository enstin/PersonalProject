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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Ukuran</th>
                                        <th>Berat</th>
                                        <th>Brand</th>
                                        <th>Parent stok</th>
                                        <th>Child 1 stok</th>
                                        <th>Child 2 stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_barang as $brg) : ?>
                                        <tr>
                                            <td> <?= $brg['id_detbarang']; ?></td>
                                            <td> <?= $brg['nama']; ?></td>
                                            <td> <?= $brg['jenis']; ?></td>
                                            <td> <?= $brg['ukuran']; ?></td>
                                            <td> <?= $brg['berat']; ?></td>
                                            <td> <?= $brg['brand']; ?></td>
                                            <td> <?= $brg['stok_base']; ?> </td>
                                            <td> <?= $brg['stok_con1']; ?> </td>
                                            <td> <?= $brg['stok_con2']; ?> </td>
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