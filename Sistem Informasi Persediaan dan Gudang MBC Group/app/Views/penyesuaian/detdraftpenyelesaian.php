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

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $data) : ?>
                                        <tr>
                                            <td><?= $data['id_detso']; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td><?= $data['jumlah_sistem']; ?></td>
                                            <td><?= $data['jumlah_riil']; ?></td>
                                            <td><?= $data['status_so']; ?></td>
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
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <!-- /.content -->
    <!-- SELECT2 EXAMPLE -->
    <!-- <form action="<?= $link; ?>/transaksi-detpenyesuaian/tambah-item" method="post"> -->
    <form action="/jurnal/transaksi-detpenyesuaian/tambahitem" method="post">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">ITEM</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>ID detail SO</label>
                            <input type="text" name="id_detail" class="form-control" readonly value="<?php foreach ($data_id as $id) : ?><?= $id['id_detso']; ?><?php endforeach; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tindakan</label>
                            <select class="form-control select2bs4" name="tindakan" id="tindakan" required style="width: 100%;">
                                <?php foreach ($table_data as $status) : ?>
                                    <?php if ($status['status_so'] == 'kurang') : ?>
                                        <option value="0|null" disabled selected>Pilih tindakan</option>
                                        <option value="Kurangi">Kurangi</option>
                                        <option value="Tidak dilakukan tindakan">Tidak dilakukan tindakan</option>
                                    <?php else : ?>
                                        <option value="0|null" disabled selected>Pilih tindakan</option>
                                        <option value="Tambah">Tambah</option>
                                        <option value="Tidak dilakukan tindakan">Tidak dilakukan tindakan</option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="0" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukan keterangan proses"></textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <!-- /.card -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Draft Tindakan Penyesuaian</h3>
                        </div>
                        <!-- /.card-header -->
                        <a href="<?= $link; ?>/transaksi-detpenyesuaian-clear/simpan-draft" class="btn btn-success">simpan</a>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table id="dtHorizontal" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID_penyesuaian</th>
                                            <th>ID_detso</th>
                                            <th>tindakan</th>
                                            <th>jumlah</th>
                                            <th>keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($table_dump as $dump) : ?>
                                            <tr>
                                                <td><?= $dump['id_penyesuaian']; ?></td>
                                                <td><?= $dump['id_detso']; ?></td>
                                                <td><?= $dump['tindakan']; ?></td>
                                                <td><?= $dump['jumlah']; ?></td>
                                                <td><?= $dump['keterangan']; ?></td>
                                                <td width="200px">
                                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $dump['id_penyesuaian']; ?>">Hapus</a>
                                                </td>
                                            </tr>
                                            <!-- model hapus -->
                                            <div class="modal fade" id="hapus<?= $dump['id_penyesuaian']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                Anda Akan menghapus data?
                                                            </div>
                                                            <div>
                                                                <input type="text" name="id_detaill" class="form-control" readonly value="<?php foreach ($data_id as $id) : ?><?= $id['id_detso']; ?><?php endforeach; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?= $link; ?>/transaksi-detpenyesuaian/hapusitem/<?= $dump['id_detpenyesuaian']; ?>_<?= $dump['id_detso']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model hapus -->
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