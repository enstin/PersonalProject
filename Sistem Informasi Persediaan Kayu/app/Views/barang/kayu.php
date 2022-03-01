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
                    <h1>DATA KAYU</h1>
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
                                        <th>Kayu</th>
                                        <th>Jenis</th>
                                        <th>Kwalitas</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Reorder Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_kayu as $brg) : ?>
                                        <tr>
                                            <td> <?= $brg['id_kayu']; ?></td>
                                            <td> <?= $brg['nama']; ?></td>
                                            <td> <?= $brg['jenis']; ?></td>
                                            <td> <?= $brg['kwalitas']; ?></td>
                                            <td> <?= $brg['stok']; ?></td>
                                            <td> <?= $brg['satuan']; ?></td>
                                            <td> <?= $brg['rp']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $brg['id_kayu']; ?>">EDIT</a>
                                                <a href="<?= $link; ?>/hapus/<?= $brg['id_kayu']; ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">HAPUS</a>
                                            </td>
                                        </tr>
                                        <!-- model edit -->
                                        <div class="modal fade" id="edit<?= $brg['id_kayu']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= $link; ?>/ubah/<?= $brg['id_kayu']; ?>" method="POST">
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                            <label>Nama</label>
                                                                <input type="text" class="form-control" name="nama" placeholder="Nama      (Wajib Diisi)" value=<?= $brg['nama']; ?> disabled required>
                                                                <label for="exampleInputEmail1">Jenis</label>
                                                                <select class="form-control" name="jenis" required>
                                                                    <option value="Jati lokal"> Jati Lokal </option>
                                                                    <option value="Jati belanda"> Jati belanda </option>
                                                                    <option value="Trembesi"> Trembesi </option>
                                                                    <option value="Akasia"> Akasia </option>
                                                                </select>
                                                                <label for="exampleInputEmail1">Kwalitas</label>
                                                                <select class="form-control" name="kwalitas" required>
                                                                    <option value="A1"> A1 </option>
                                                                    <option value="A2"> A2 </option>
                                                                    <option value="A3"> A3 </option>
                                                                </select>
                                                                <label for="exampleInputEmail1">Satuan</label>
                                                                <select class="form-control" name="satuan" required>
                                                                    <option value="m3"> m3 </option>
                                                                    <option value="-"> - </option>
                                                                </select>
                                                                <label>Reorder Point</label>
                                                                <input type="number" class="form-control" name="rp" placeholder="Reorder Point      (Wajib Diisi)" maxl='99' min='1' required>
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
                            <input type="text" class="form-control" name="nama" placeholder="Nama      (Wajib Diisi)" required>
                            <label for="exampleInputEmail1">Jenis</label>
                                                                <select class="form-control" name="jenis" required>
                                                                    <option value="Jati lokal"> Jati Lokal </option>
                                                                    <option value="Jati belanda"> Jati belanda </option>
                                                                    <option value="Trembesi"> Trembesi </option>
                                                                    <option value="Akasia"> Akasia </option>
                                                                </select>
                                                                <label for="exampleInputEmail1">Kwalitas</label>
                                                                <select class="form-control" name="kwalitas" required>
                                                                    <option value="A1"> A1 </option>
                                                                    <option value="A2"> A2 </option>
                                                                    <option value="A3"> A3 </option>
                                                                </select>
                                                                <label for="exampleInputEmail1">Satuan</label>
                                                                <select class="form-control" name="satuan" required>
                                                                    <option value="m3"> m3 </option>
                                                                    <option value="-"> - </option>
                                                                </select>
                            <label>Reorder Point</label>
                            <input type="number" class="form-control" name="rp" placeholder="Reorder Point      (Wajib Diisi)" maxl='99' min='1' required>
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