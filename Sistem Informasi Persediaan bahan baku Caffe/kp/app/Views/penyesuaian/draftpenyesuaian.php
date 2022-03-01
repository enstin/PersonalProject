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
                            <h3 class="card-title">Draft Barang Stok Opname</h3>
                        </div>
                        <!-- /.card-header -->
                        <a href="<?= $link; ?>/simpan-draft" class="btn btn-success">simpan</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID_detso</th>
                                        <th>nama barang</th>
                                        <th>jumlah stok (sistem)</th>
                                        <th>jumlah rill</th>
                                        <th>Status</th>
                                        <th>selisih</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $dump) : ?>
                                        <tr>
                                            <td><?= $dump['id_detso']; ?></td>
                                            <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['jml_stok']; ?></td>
                                            <td><?= $dump['jml_so']; ?></td>
                                            <td><?= $dump['status']; ?></td>
                                            <td><?= $dump['selisih']; ?></td>
                                            <td>
                                            <td><a href="<?= $link; ?>/transaksi-detpenyesuaian/<?= $dump['id_detso']; ?>" class="btn btn-success" id="trans<?= $dump['id_detso']; ?>">Buat Penyesuaian</a></td>
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