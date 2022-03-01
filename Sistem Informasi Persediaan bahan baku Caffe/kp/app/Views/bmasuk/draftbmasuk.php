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
                            <h3 class="card-title">Draft Barang masuk</h3>
                        </div>
                        <!-- /.card-header -->
                        <a href="<?= $link; ?>/simpan-draft/<?= session()->get('id_trasnbel'); ?>" class="btn btn-success">simpan</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Riil</th>
                                        <th>Harga sistem</th>
                                        <th>Harga Riil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_data as $table) : ?>
                                        <tr>
                                            <td><?= $table['nama']; ?></td>
                                            <td><?= $table['satuan']; ?></td>
                                            <td><?= $table['jumlah']; ?></td>
                                            <td><?= $table['harga']; ?></td>
                                            <td><?= $table['harga_asli']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $table['id_detbmasuk']; ?>">EDIT</a>
                                                <a href="<?= $link; ?>/hapus-draft/<?= $table['id_detbmasuk']; ?>" class="btn btn-danger">HAPUS</a>
                                            </td>
                                        </tr>
                                        <!-- model edit -->
                                        <div class="modal fade" id="edit<?= $table['id_detbmasuk']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= $link; ?>/ubah-draft/<?= $table['id_detbmasuk']; ?>" method="POST">
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">id detail</label>
                                                                    <input type="text" class="form-control" name="id_detbmasuk" readonly value="<?= $table['id_detbmasuk']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Barang</label>
                                                                    <input type="text" class="form-control" name="nama" readonly value="<?= $table['nama']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jumlah</label>
                                                                    <input type="text" class="form-control" id="jml" name="jumlah" value="<?= $table['jumlah']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">harga asli</label>
                                                                    <input type="text" class="form-control" name="harga_asli" value="<?= $table['harga_asli']; ?>" required>
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
    <!-- SELECT2 EXAMPLE -->
    <form action="<?= $link; ?>/tambah-item" method="post">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">ITEM TAMBAHAN</h3>
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
                            <label>ID Transaksi</label>
                            <input type="text" name="id_bmasuk" class="form-control" placeholder="0" readonly value="<?= session()->get('id_trasnbel'); ?>">
                        </div>
                        <div class="form-group">
                            <label>barang</label>
                            <select class="form-control select2bs4" name="brg" id="namabrg" onchange="select_brg()" required style="width: 100%;">
                                <option value="0|null" disabled selected>Pilih Barang</option>
                                <?php foreach ($data_brg as $barang) : ?>
                                    <option value="<?= $barang['id_barang']; ?>|<?= $barang['harga']; ?>|<?= $barang['satuan']; ?>"> <?= $barang['nama']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" id="hrg" class="form-control" placeholder="0" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" placeholder="jumlah" required>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" id="sat" class="form-control" placeholder="0" value="" readonly>
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
    <!-- SELECT2 EXAMPLE -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>