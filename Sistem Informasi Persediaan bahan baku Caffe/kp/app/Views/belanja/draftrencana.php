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
                            <h3 class="card-title">Draft Belanja</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Kekurangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_kurang as $kurang) : ?>
                                        <tr>
                                            <td><?= $kurang['nama']; ?></td>
                                            <td><?= $kurang['kekurangan']; ?></td>
                                            <td><a href="<?= $link; ?>/hapuskurang/<?= $kurang['id_barang']; ?>" class="btn btn-danger">Hapus</a></td>
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
    <!-- SELECT2 EXAMPLE -->
    <form action="<?= $link; ?>/tambah-item" method="post">
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
                            <label>barang</label>
                            <select class="form-control select2bs4" name="brg" id="namabrg" onchange="select_brg()" required style="width: 100%;">
                                <option value="0|null" disabled selected>Pilih Barang</option>
                                <?php foreach ($data_barang as $barang) : ?>
                                    <option value="<?= $barang['id_barang']; ?>|<?= $barang['harga']; ?>|<?= $barang['satuan']; ?>"> <?= $barang['nama']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" id="hrg" class="form-control" placeholder="0" readonly value="" required>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" id="sat" class="form-control" placeholder="0" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" placeholder="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label>Urgensi</label>
                            <select name="urgensi" id="" class="form-control" required>
                                <option value="Urgent">Urgent</option>
                                <option value="Tidak Urgent">Tidak Urgent</option>
                            </select>
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
                            <h3 class="card-title">Draft Belanja</h3>
                        </div>
                        <!-- /.card-header -->

                        <a href="<?= $link; ?>/simpan-draft" class="btn btn-success">SIMPAN</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID_detail</th>
                                        <th>id_belanja</th>
                                        <th>nama barang</th>
                                        <th>jumlah</th>
                                        <th>urgnesi</th>
                                        <th>subtotal</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_dump as $dump) : ?>
                                        <tr>
                                            <td><?= $dump['id_detbel']; ?></td>
                                            <td><?= $dump['id_belanja']; ?></td>
                                            <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['jumlah']; ?></td>
                                            <td><?= $dump['urgensi']; ?></td>
                                            <td><?= $dump['sub_total']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $dump['id_detbel']; ?>">Hapus</a>
                                            </td>
                                        </tr>
                                        <!-- model hapus -->
                                        <div class="modal fade" id="hapus<?= $dump['id_detbel']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= $link; ?>/hapus-dump/<?= $dump['id_detbel']; ?>" class="btn btn-primary">Ya</a>
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