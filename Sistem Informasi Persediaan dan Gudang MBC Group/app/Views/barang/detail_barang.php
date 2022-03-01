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
                                        <th>brand</th>
                                        <th>Ukuran</th>
                                        <th>Berat</th>
                                        <th>Konversi</th>
                                        <td>Tombol Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_barang as $brg) : ?>
                                        <tr>
                                            <td> <?= $brg['id_detbarang']; ?></td>
                                            <td> <?= $brg['brand']; ?></td>
                                            <td> <?= $brg['ukuran']; ?></td>
                                            <td> <?= $brg['berat']; ?></td>
                                            <td>
                                                <?php if ($brg['satuan3'] && $brg['satuan2']  == '') : ?>
                                                    <?= $brg['cr1']; ?> <?= $brg['satuan1']; ?>
                                                <?php elseif ($brg['satuan3'] == '') : ?>
                                                    <?= $brg['cr1']; ?> <?= $brg['satuan1']; ?> = <?= $brg['cr2']; ?> <?= $brg['satuan2']; ?>
                                                <?php else : ?>
                                                    <?= $brg['cr1']; ?> <?= $brg['satuan1']; ?> = <?= $brg['cr2']; ?> <?= $brg['satuan2']; ?> || 1 <?= $brg['satuan2']; ?> = <?= $brg['cr3']; ?> <?= $brg['satuan3']; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td> <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $brg['id_detbarang']; ?>">HAPUS</a> </td>
                                        </tr>
                                        <!-- model edit -->
                                        <div class="modal fade" id="edit<?= $brg['id_detbarang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="card-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">edit</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= $link; ?>/ubah/<?= $brg['id_detbarang']; ?>" method="POST">
                                                        <div class="modal-body">
                                                            <!-- general form elements -->
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Brand</label>
                                                                    <select class="form-control" name="brand" required>
                                                                        <?php foreach ($data_brand as $brand) : ?>
                                                                            <option value="<?= $brand['id_brand']; ?>"> <?= $brand['brand']; ?> </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label for="exampleInputEmail1">berat</label>
                                                                    <select class="form-control" name="berat" required>
                                                                        <?php foreach ($data_berat as $berat) : ?>
                                                                            <option value="<?= $berat['id_berat']; ?>"> <?= $berat['berat']; ?> </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label for="exampleInputEmail1">ukuran</label>
                                                                    <select class="form-control" name="ukuran" required>
                                                                        <?php foreach ($data_ukuran as $ukuran) : ?>
                                                                            <option value="<?= $ukuran['id_ukuran']; ?>"> <?= $ukuran['ukuran']; ?> </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label>Conversion Rate</label>
                                                                    <select class="form-control" name="cr">
                                                                        <?php foreach ($data_cr as $cr) : ?>
                                                                            <option value=<?= $cr['id_cr']; ?>> <?= $cr['cr1']; ?> <?= $cr['satuan1']; ?> = <?= $cr['cr2']; ?> <?= $cr['satuan2']; ?> || 1 <?= $cr['satuan2']; ?> = <?= $cr['cr3']; ?> <?= $cr['satuan3']; ?></option>
                                                                        <?php endforeach; ?>
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
                                        <!-- model hapus -->
                                        <div class="modal fade" id="hapus<?= $brg['id_detbarang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                        <a href="/detbarang/hapus/<?= $brg['id_detbarang']; ?>" class="btn btn-primary">Ya</a>
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
                            <label for="exampleInputEmail1">Brand</label>
                            <select class="form-control" name="brand" required>
                                <?php foreach ($data_brand as $brand) : ?>
                                    <option value="<?= $brand['id_brand']; ?>"> <?= $brand['brand']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="exampleInputEmail1">berat</label>
                            <select class="form-control" name="berat" required>
                                <?php foreach ($data_berat as $berat) : ?>
                                    <option value="<?= $berat['id_berat']; ?>"> <?= $berat['berat']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="exampleInputEmail1">ukuran</label>
                            <select class="form-control" name="ukuran" required>
                                <?php foreach ($data_ukuran as $ukuran) : ?>
                                    <option value="<?= $ukuran['id_ukuran']; ?>"> <?= $ukuran['ukuran']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <label>Conversion Rate</label>
                            <select class="form-control" name="cr">
                                <?php foreach ($data_cr as $cr) : ?>
                                    <?php if ($cr['satuan3'] && $cr['satuan2']  == '') : ?>
                                        <option value=<?= $cr['id_cr']; ?>> <?= $cr['cr1']; ?> <?= $cr['satuan1']; ?> </option>
                                    <?php elseif ($cr['satuan3'] == '') : ?>
                                        <option value=<?= $cr['id_cr']; ?>> <?= $cr['cr1']; ?> <?= $cr['satuan1']; ?> = <?= $cr['cr2']; ?> <?= $cr['satuan2']; ?></option>
                                    <?php else : ?>
                                        <option value=<?= $cr['id_cr']; ?>> <?= $cr['cr1']; ?> <?= $cr['satuan1']; ?> = <?= $cr['cr2']; ?> <?= $cr['satuan2']; ?> || 1 <?= $cr['satuan2']; ?> = <?= $cr['cr3']; ?> <?= $cr['satuan3']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
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