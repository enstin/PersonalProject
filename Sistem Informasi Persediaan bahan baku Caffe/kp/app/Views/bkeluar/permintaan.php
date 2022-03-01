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
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>barang</label>
                        <select class="form-control select2bs4" style="width: 100%;">
                            <?php foreach ($baranga as $baranga) : ?>
                                <option> <?= $baranga['nama']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- /.form-group -->
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">jumlah</label>
                    <input type="jumlah" class="form-control" id="exampleInputEmail1" placeholder="jumlah">
                </div>

                <!-- /.col -->
                <div class="col-md-6">

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- /.card-body -->
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
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambah">TAMBAH</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>nama</th>
                                        <th>id_jenis</th>
                                        <th>stok</th>
                                        <th>harga</th>
                                        <th>tanggal expired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($barang as $barang) : ?>
                                        <tr>
                                            <td> <?= $barang['id_barang']; ?></td>
                                            <td> <?= $barang['nama']; ?></td>
                                            <td> <?= $barang['id_jenis']; ?></td>
                                            <td> <?= $barang['stok']; ?></td>
                                            <td> <?= $barang['harga']; ?></td>
                                            <td> <?= $barang['lama_expired']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $barang['id_barang']; ?>">edit</a>
                                                <a href="<?= $link; ?>/hapus/<?= $barang['id_barang']; ?>" class="btn btn-danger">hapus</a>
                                            </td>
                                        </tr>
                                        <!-- model edit -->
                                        <!-- end of model edit -->
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
<!-- model tambah -->
<form action="<?= $link; ?>/simpan" method="POST">
    <div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card-header">
                    <h5 class="modal-title" id="staticBackdropLabel">TAMBAH DATA JENIS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- general form elements -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>ID barang</label>
                            <input type="text" class="form-control" name="id" placeholder="ID barang" required>
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            <div class="form-group">
                                <label>jenis</label>
                                <select class="form-control">
                                    <?php foreach ($jenis as $jenis) : ?>
                                        <option> <?= $jenis['jenis']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                            <label>Batas Expired (hari)</label>
                            <input type="text" class="form-control" name="expired" placeholder="Batas Expired" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value='Simpandata'>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">kembali</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end of model tambah -->
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>