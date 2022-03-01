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
                            <h3 class="card-title">Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID_detso</th>
                                        <th>nama barang</th>
                                        <th>jumlah stok</th>
                                        <th>jumlah rill</th>
                                        <th>Status</th>
                                        <th>selisih</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $data) : ?>
                                        <tr>
                                            <td><?= $data['id_detso']; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td><?= $data['jumlah_sistem']; ?></td>
                                            <td><?= $data['jumlah_riil']; ?></td>
                                            <td><?= $data['status']; ?></td>
                                            <td><?= $data['selisih']; ?></td>

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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Draft persetujuan</h3>
                        </div>
                        <!-- /.card-header -->
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <a href="/jurnal/transaksi-detpersetujuan-clear/selesai" class="btn btn-success">Kembali</a>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                            <a href="/jurnal_g2/transaksi-detpersetujuan-clear/selesai" class="btn btn-success">Kembali</a>
                        <?php else : ?>
                            <a href="/jurnal_g3/transaksi-detpersetujuan-clear/selesai" class="btn btn-success">Kembali</a>
                        <?php endif; ?>

                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table id="dtHorizontal" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>id_detpenyesuaian</th>
                                            <th>ID_detso</th>
                                            <th>tindakan</th>
                                            <th>jumlah</th>
                                            <th>keterangan</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($table_penyesuaian as $dump) : ?>
                                            <tr>
                                                <td><?= $dump['id_detpenyesuaian']; ?></td>
                                                <td><?= $dump['id_detso']; ?></td>
                                                <td><?= $dump['tindakan']; ?></td>
                                                <td><?= $dump['jumlah']; ?></td>
                                                <td><?= $dump['keterangan']; ?></td>
                                                <?php if ($dump['status'] == 'belum') : ?>
                                                    <?php if ($dump['tindakan'] == 'Kurangi') : ?>
                                                        <td width="200px">
                                                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#setujukurang<?= $dump['id_detpenyesuaian']; ?>">Setujui</a>
                                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#tidak<?= $dump['id_detpenyesuaian']; ?>">Tidak</a>
                                                        </td>
                                                    <?php elseif ($dump['tindakan'] == 'Tambah') : ?>
                                                        <td width="200px">
                                                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#setujutambah<?= $dump['id_detpenyesuaian']; ?>">Setujui</a>
                                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#tidak<?= $dump['id_detpenyesuaian']; ?>">Tidak</a>
                                                        </td>
                                                    <?php elseif ($dump['tindakan'] == 'Tidak dilakukan tindakan') : ?>
                                                        <td width="200px">
                                                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#setujunone<?= $dump['id_detpenyesuaian']; ?>">Setujui</a>
                                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#tidak<?= $dump['id_detpenyesuaian']; ?>">Tidak</a>
                                                        </td>
                                                    <?php endif; ?>
                                                <?php elseif ($dump['status'] == 'disetujui ditambah') : ?>
                                                    <td width="200px">
                                                        SUDAH DISETUJUI : TAMBAH
                                                    </td>
                                                <?php elseif ($dump['status'] == 'disetujui dikurang') : ?>
                                                    <td width="200px">
                                                        SUDAH DISETUJUI : DIKURANG
                                                    </td>
                                                <?php elseif ($dump['status'] == 'disetujui Tidak dilakukan tindakan') : ?>
                                                    <td width="200px">
                                                        SUDAH DISETUJUI : TIDAK DILAKUKAN TINDAKAN
                                                    </td>
                                                <?php elseif ($dump['status'] == 'Tidak disetujui') : ?>
                                                    <td width="200px">
                                                        TIDAK DISETUJUI
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <!-- model setuju kurang -->
                                            <div class="modal fade" id="setujukurang<?= $dump['id_detpenyesuaian']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Setujui dikurangi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                Apakah anda menyetujui penyesuaian tersebut?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?= $link; ?>/setujuikurang/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model setuju kurang -->
                                            <!-- model setuju tambah -->
                                            <div class="modal fade" id="setujutambah<?= $dump['id_detpenyesuaian']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Setujui tambah</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                Apakah anda menyetujui penyesuaian tersebut?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?= $link; ?>/setujuitambah/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model setuju tambah -->
                                            <!-- model setuju tambah -->
                                            <div class="modal fade" id="setujunone<?= $dump['id_detpenyesuaian']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Setujui tambah</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                Apakah anda menyetujui penyesuaian tersebut?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?= $link; ?>/setujuinone/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model setuju tambah -->
                                            <!-- model tidak -->
                                            <div class="modal fade" id="tidak<?= $dump['id_detpenyesuaian']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Tidak setujui</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                Apakah anda tidak menyetujui penyesuaian tersebut?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?= $link; ?>/tidak-setujui/<?= $dump['id_detpenyesuaian']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model tidak -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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