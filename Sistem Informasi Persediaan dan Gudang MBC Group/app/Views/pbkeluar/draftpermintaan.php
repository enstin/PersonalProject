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

    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">ITEM</h3>
            <!-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div> -->
        </div>
        <!-- /.card-header -->
        <form action="<?= $link; ?>/tambah-item" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>barang</label>
                            <select class="form-control select2bs4" name="brg" id="namabrg" required style="width: 100%;">
                                <option value="0|null" disabled selected>Pilih Barang</option>
                                <?php foreach ($data_barang as $barang) : ?>
                                    <option value="<?= $barang['id_barang']; ?>|<?= $barang['harga']; ?>"> <?= $barang['nama']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="jumlah" required>
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
        </form>
    </div>
    <!-- /.card -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <a href="<?= $link; ?>/simpan-draft" class="btn btn-success">simpan</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id_detpbkeluar</th>
                                        <th>id_pbkeluar</th>
                                        <th>nama barang</th>
                                        <th>jumlah</th>
                                        <th>kekurangan</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_dump as $dump) : ?>
                                        <tr>
                                            <td><?= $dump['id_detpbkeluar']; ?></td>
                                            <td><?= $dump['id_pbkeluar']; ?></td>
                                            <td><?= $dump['nama']; ?></td>
                                            <td><?= $dump['jumlah']; ?></td>
                                            <td><?= $dump['kekurangan']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $dump['id_detpbkeluar']; ?>">Hapus</a>
                                            </td>
                                        </tr>
                                        <!-- model hapus -->
                                        <div class="modal fade" id="hapus<?= $dump['id_detpbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                        <a href="<?= $link; ?>/hapus-dump/<?= $dump['id_detpbkeluar']; ?>" class="btn btn-primary">Ya</a>
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
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>