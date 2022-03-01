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
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DRAFT PENERIMAAN</h3>
                        </div>
                        <!-- /.card-header -->
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <a href="/bmasuk/masuk" class="btn btn-success">MASUKAN BARANG</a>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                            <a href="/bmasuk_g2/masuk" class="btn btn-success">MASUKAN BARANG</a>
                        <?php else : ?>
                            <a href="/bmasuk_g3/masuk" class="btn btn-success">MASUKAN BARANG</a>
                        <?php endif; ?>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>nama</th>
                                        <th>ukuran</th>
                                        <th>berat</th>
                                        <th>brand</th>
                                        <th>jumlah</th>
                                        <th>satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $pesan) : ?>
                                        <tr>
                                            <td><?= $pesan['nama']; ?></td>
                                            <td><?= $pesan['ukuran']; ?></td>
                                            <td><?= $pesan['berat']; ?></td>
                                            <td><?= $pesan['brand']; ?></td>
                                            <td><?= $pesan['jumlah']; ?></td>
                                            <?php if ($pesan['convert'] == 'con1') : ?>
                                                <td><?= $pesan['satuan1']; ?></td>
                                            <?php elseif ($pesan['convert'] == 'con2') : ?>
                                                <td><?= $pesan['satuan2']; ?></td>
                                            <?php elseif ($pesan['convert'] == 'con3') : ?>
                                                <td><?= $pesan['satuan3']; ?></td>
                                            <?php else : ?>
                                                <td>?</td>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>