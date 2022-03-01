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
    <?php elseif (session()->getFlashdata('pesan1')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan1'); ?>
        </div>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Draft Barang Stok Opname</h3>
                        </div>
                        <!-- /.card-header -->
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <a href="/jurnal/simpan-draft" class="btn btn-success">simpan</a>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                            <a href="/jurnal_g2/simpan-draft" class="btn btn-success">simpan</a>
                        <?php else : ?>
                            <a href="/jurnal_g3/simpan-draft" class="btn btn-success">simpan</a>
                        <?php endif; ?>
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
                                        <th>selisih</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $dump) : ?>
                                        <tr>
                                            <td><?= $dump['desyo']; ?></td>
                                            <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['jumlah_sistem']; ?></td>
                                            <td><?= $dump['jumlah_riil']; ?></td>
                                            <td><?= $dump['status']; ?></td>
                                            <td><?= $dump['selisih']; ?></td>
                                            <?php if ($dump['convert'] == 'con1') : ?>
                                                <td><?= $dump['satuan1']; ?></td>
                                            <?php elseif ($dump['convert'] == 'con2') : ?>
                                                <td><?= $dump['satuan2']; ?></td>
                                            <?php else : ?>
                                                <td><?= $dump['satuan3']; ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <?php if (session()->get('gudang') == 'g1') : ?>
                                                    <a href="/jurnal/transaksi-detpenyesuaian/<?= $dump['id_detso']; ?>" class="btn btn-success" id="trans<?= $dump['id_detso']; ?>">Buat Penyesuaian</a>
                                                <?php elseif (session()->get('gudang') == 'g2') : ?>
                                                    <a href="/jurnal_g2/transaksi-detpenyesuaian/<?= $dump['id_detso']; ?>" class="btn btn-success" id="trans<?= $dump['id_detso']; ?>">Buat Penyesuaian</a>
                                                <?php else : ?>
                                                    <a href="/jurnal_g3/transaksi-detpenyesuaian/<?= $dump['id_detso']; ?>" class="btn btn-success" id="trans<?= $dump['id_detso']; ?>">Buat Penyesuaian</a>
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