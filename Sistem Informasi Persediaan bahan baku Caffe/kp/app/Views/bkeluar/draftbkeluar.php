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
                            <h3 class="card-title">Daftar item keluar</h3>
                        </div>
                        <!-- /.card-header -->
                        <a href="<?= $link; ?>/simpan-draft/<?= session()->get('id_trasnkel'); ?>" class="btn btn-success">simpan</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Kekurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $table) : ?>
                                        <tr>
                                            <td><?= $table['nama']; ?></td>
                                            <td><?= $table['jumlah']; ?></td>
                                            <td><?= $table['kekurangan']; ?></td>
                                            <td>
                                                <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $table['id_detbkeluar']; ?>">EDIT</a>
                                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $table['id_detbkeluar']; ?>">Hapus</a> -->
                                            </td>
                                        </tr>
                                        <!-- model hapus -->
                                        <div class="modal fade" id="hapus<?= $table['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                        <a href="<?= $link; ?>/hapus-draft/<?= $table['id_detbkeluar']; ?>" class="btn btn-primary">Ya</a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of model hapus -->
                                        <!-- model edit -->
                                        <div class="modal fade" id="edit<?= $table['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= $link; ?>/ubah-draft/<?= $table['id_detbkeluar']; ?>" method="POST">
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">id detail</label>
                                                                    <input type="text" class="form-control" name="id_detbkeluar" readonly value="<?= $table['id_detbkeluar']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Barang</label>
                                                                    <input type="text" class="form-control" name="nama" readonly value="<?= $table['nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Stok</label>
                                                                    <input type="text" class="form-control" name="stok" value="<?= $table['stok']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jumlah</label>
                                                                    <input type="text" class="form-control" name="jumlah" value="<?= $table['jumlah']; ?>" required>
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
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>