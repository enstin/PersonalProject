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
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <a href="/jurnal/selesai" class="btn btn-success">Kembali</a>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                            <a href="/jurnal_g2/selesai" class="btn btn-success">Kembali</a>
                        <?php else : ?>
                            <a href="/jurnal_g3/selesai" class="btn btn-success">Kembali</a>
                        <?php endif; ?>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>nama barang</th>
                                        <th>jumlah stok</th>
                                        <th>jumlah rill</th>
                                        <th>Status</th>
                                        <th>selisih</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $dump) : ?>
                                        <tr>
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
                                            <?php if (session()->get('gudang') == 'g1') : ?>
                                                <td><a href="/jurnal/transaksi-detpersetujuan/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-success" id="trans<?= $dump['id_detpenyesuaian']; ?>">Buat Penyesuaian</a></td>
                                            <?php elseif (session()->get('gudang') == 'g2') : ?>
                                                <td><a href="/jurnal_g2/transaksi-detpersetujuan/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-success" id="trans<?= $dump['id_detpenyesuaian']; ?>">Buat Penyesuaian</a></td>
                                            <?php else : ?>
                                                <td><a href="/jurnal_g3/transaksi-detpersetujuan/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-success" id="trans<?= $dump['id_detpenyesuaian']; ?>">Buat Penyesuaian</a></td>
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