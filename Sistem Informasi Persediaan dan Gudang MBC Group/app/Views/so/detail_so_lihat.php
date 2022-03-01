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
                            <h3 class="card-title">ITEM</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID_detail</th>
                                        <th>id_SO</th>
                                        <th>nama barang</th>
                                        <th>jumlah stok (sistem)</th>
                                        <th>jumlah riil</th>
                                        <th>status</th>
                                        <th>selisih</th>
                                        <th>satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $data) : ?>
                                        <tr>
                                            <td><?= $data['id_detso']; ?></td>
                                            <td><?= $data['id_so']; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td><?= $data['jumlah_sistem']; ?></td>
                                            <td><?= $data['jumlah_riil']; ?></td>
                                            <td><?= $data['status']; ?></td>
                                            <td><?= $data['selisih']; ?></td>
                                            <?php if ($data['convert'] == 'con1') : ?>
                                                <td><?= $data['satuan1']; ?></td>
                                            <?php elseif ($data['convert'] == 'con2') : ?>
                                                <td><?= $data['satuan2']; ?></td>
                                            <?php else : ?>
                                                <td><?= $data['satuan3']; ?></td>
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