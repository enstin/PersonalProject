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
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambah">+TAMBAH+</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-4">

                            </div>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_barang as $brg) : ?>
                                        <tr>
                                            <td> <?= $brg['id_barang']; ?></td>
                                            <td> <?= $brg['nama']; ?></td>
                                            <td> <?= $brg['jenis']; ?></td>
                                            <?php if (session()->get('gudang') == 'g1') : ?>
                                                <td>
                                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $brg['id_barang']; ?>">EDIT</a>
                                                    <a href="<?= $link; ?>/hapus/<?= $brg['id_barang']; ?>" class="btn btn-danger">HAPUS</a>
                                                    <a href="/detbarang/<?= $brg['id_barang']; ?>" class="btn btn-success">DETAIL BARANG</a>
                                                </td>
                                            <?php endif; ?>

                                        </tr>
                                        <!-- model edit -->
                                        <div class="modal fade" id="edit<?= $brg['id_barang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= $link; ?>/ubah/<?= $brg['id_barang']; ?>" method="POST">
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama barang</label>
                                                                    <input type="text" class="form-control" name="nama" placeholder="Nama barang" value="<?= $brg['nama']; ?>" required>
                                                                    <label for="exampleInputEmail1">Jenis</label>
                                                                    <select class="form-control" name="jenis" required>
                                                                        <option value="kertas"> kertas </option>
                                                                        <option value="non-kertas"> non-kertas </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="submit" class="btn btn-primary" value='Simpan'>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">kembali</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                    <h5 class="modal-title" id="staticBackdropLabel">TAMBAH DATA BARANG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- general form elements -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            <label for="exampleInputEmail1">Jenis</label>
                            <select class="form-control" name="jenis" required>
                                <option value="kertas"> kertas </option>
                                <option value="non-kertas"> non-kertas </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value='Simpan'>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">kembali</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end of model tambah -->
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>