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
    <?php if (session()->get('gudang') == 'g1') : ?>
        <form action="/bkeluar/draftbkeluar/tambah-item" method="post">
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
                                <select class="form-control select2bs4" name="brg" id="namabrg" required style="width: 100%;">
                                    <option value="0|null" disabled selected>Pilih Barang</option>
                                    <?php foreach ($option_barang as $barang) : ?>
                                        <option value="<?= $barang['id_detbarang']; ?>"> <?= $barang['nama']; ?>-<?= $barang['ukuran']; ?>-<?= $barang['brand']; ?>-<?= $barang['berat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <script>
                                $(function() {
                                    $("#namabrg").change(e => {
                                        const idbarang = $("#namabrg option:selected").val()
                                        console.log(idbarang);
                                        $.ajax({
                                            method: "post",
                                            data: {
                                                id: idbarang
                                            },
                                            url: "https://mbcgroup.site/bkeluar/draftbkeluar/get_satuan",
                                            dataType: "html",
                                            success: res => {
                                                $("#satuan").empty()
                                                $("#satuan").append(res)
                                            }
                                        })
                                    })
                                })
                            </script>

                            <div class="form-group">
                                <label>satuan</label>
                                <select class="form-control select2bs4" name="satuan" id="satuan" required style="width: 100%;">
                                    <option id="sat1" value=""> </option>
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
            </div>
        </form>
        <!-- /.card -->
    <?php elseif (session()->get('gudang') == 'g2') : ?>
        <form action="/bkeluar_g2/draftbkeluar/tambah-item" method="post">
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
                                <select class="form-control select2bs4" name="brg" id="namabrg" required style="width: 100%;">
                                    <option value="0|null" disabled selected>Pilih Barang</option>
                                    <?php foreach ($option_barang as $barang) : ?>
                                        <option value="<?= $barang['id_detbarang']; ?>"> <?= $barang['nama']; ?>-<?= $barang['ukuran']; ?>-<?= $barang['brand']; ?>-<?= $barang['berat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <script>
                                $(function() {
                                    $("#namabrg").change(e => {
                                        const idbarang = $("#namabrg option:selected").val()
                                        console.log(idbarang);
                                        $.ajax({
                                            method: "post",
                                            data: {
                                                id: idbarang
                                            },
                                            url: "https://mbcgroup.site/bkeluar_g2/draftbkeluar/get_satuan",
                                            dataType: "html",
                                            success: res => {
                                                $("#satuan").empty()
                                                $("#satuan").append(res)
                                            }
                                        })
                                    })
                                })
                            </script>

                            <div class="form-group">
                                <label>satuan</label>
                                <select class="form-control select2bs4" name="satuan" id="satuan" required style="width: 100%;">
                                    <option id="sat1" value=""> </option>
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
            </div>
        </form>
        <!-- /.card -->
    <?php else : ?>
        <form action="/bkeluar_g3/draftbkeluar/tambah-item" method="post">
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
                                <select class="form-control select2bs4" name="brg" id="namabrg" required style="width: 100%;">
                                    <option value="0|null" disabled selected>Pilih Barang</option>
                                    <?php foreach ($option_barang as $barang) : ?>
                                        <option value="<?= $barang['id_detbarang']; ?>"> <?= $barang['nama']; ?>-<?= $barang['ukuran']; ?>-<?= $barang['brand']; ?>-<?= $barang['berat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <script>
                                $(function() {
                                    $("#namabrg").change(e => {
                                        const idbarang = $("#namabrg option:selected").val()
                                        console.log(idbarang);
                                        $.ajax({
                                            method: "post",
                                            data: {
                                                id: idbarang
                                            },
                                            url: "https://mbcgroup.site/bkeluar_g3/draftbkeluar/get_satuan",
                                            dataType: "html",
                                            success: res => {
                                                $("#satuan").empty()
                                                $("#satuan").append(res)
                                            }
                                        })
                                    })
                                })
                            </script>

                            <div class="form-group">
                                <label>satuan</label>
                                <select class="form-control select2bs4" name="satuan" id="satuan" required style="width: 100%;">
                                    <option id="sat1" value=""> </option>
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
            </div>
        </form>
        <!-- /.card -->
    <?php endif; ?>
    <!-- SELECT2 EXAMPLE -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ITEM</h3>
                        </div>
                        <!-- /.card-header -->
                        <?php if (session()->get('gudang') == 'g1') : ?>
                            <a href="/bkeluar/draftbkeluar/simpan" class="btn btn-success">SIMPAN</a>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                            <a href="/bkeluar_g2/draftbkeluar/simpan" class="btn btn-success">SIMPAN</a>
                        <?php else : ?>
                            <a href="/bkeluar_g3/draftbkeluar/simpan" class="btn btn-success">SIMPAN</a>
                        <?php endif; ?>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>nama</th>
                                        <th>ukuran</th>
                                        <th>berat</th>
                                        <th>brand</th>
                                        <th>jumlah</th>
                                        <th>satuan</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_dump as $pesan) : ?>
                                        <tr>
                                            <td><?= $pesan['nama']; ?></td>
                                            <td><?= $pesan['ukuran']; ?></td>
                                            <td><?= $pesan['berat']; ?></td>
                                            <td><?= $pesan['brand']; ?></td>
                                            <td><?= $pesan['jumlah']; ?></td>
                                            <?php if ($pesan['convert'] == 'con1') : ?>
                                                <td><?= $pesan['satuan1']; ?></td>
                                            <?php elseif ($pesan['convert'] == 'con2') : ?>
                                                <td><?= $pesan['satuan2']; ?></td>
                                            <?php else : ?>
                                                <td><?= $pesan['satuan3']; ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $pesan['id_detbkeluar']; ?>">Hapus</a>
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $pesan['id_detbkeluar']; ?>">Edit</a>
                                            </td>
                                        </tr>
                                        <?php if (session()->get('gudang') == 'g1') : ?>
                                            <!-- model hapus -->
                                            <div class="modal fade" id="hapus<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                            <a href="/bkeluar/draftbkeluar/hapus-item/<?= $pesan['id_detbkeluar']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model hapus -->
                                            <!-- model edit -->
                                            <div class="modal fade" id="edit<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/bkeluar/draftbkeluar/update-item/<?= $pesan['id_detbkeluar']; ?>" method="POST">
                                                            <div class="modal-body">
                                                                <!-- general form elements -->
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">ID barang</label>
                                                                        <input type="text" class="form-control" name="idbrg" readonly value="<?= $pesan['id_barang']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nama Barang</label>
                                                                        <input type="text" class="form-control" name="nama" readonly value="<?= $pesan['nama']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Jumlah</label>
                                                                        <input type="number" class="form-control" id="jml" name="jumlah_update" value="<?= $pesan['jumlah']; ?>" required>
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
                                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                                            <!-- model hapus -->
                                            <div class="modal fade" id="hapus<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                            <a href="/bkeluar_g2/draftbkeluar/hapus-item/<?= $pesan['id_detbkeluar']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model hapus -->
                                            <!-- model edit -->
                                            <div class="modal fade" id="edit<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/bkeluar_g2/draftbkeluar/update-item/<?= $pesan['id_detbkeluar']; ?>" method="POST">
                                                            <div class="modal-body">
                                                                <!-- general form elements -->
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">ID barang</label>
                                                                        <input type="text" class="form-control" name="idbrg" readonly value="<?= $pesan['id_barang']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nama Barang</label>
                                                                        <input type="text" class="form-control" name="nama" readonly value="<?= $pesan['nama']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Jumlah</label>
                                                                        <input type="number" class="form-control" id="jml" name="jumlah_update" value="<?= $pesan['jumlah']; ?>" required>
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
                                        <?php else : ?>
                                            <!-- model hapus -->
                                            <div class="modal fade" id="hapus<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                            <a href="/bkeluar_g3/draftbkeluar/hapus-item/<?= $pesan['id_detbkeluar']; ?>" class="btn btn-primary">Ya</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of model hapus -->
                                            <!-- model edit -->
                                            <div class="modal fade" id="edit<?= $pesan['id_detbkeluar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="card-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/bkeluar_g3/draftbkeluar/update-item/<?= $pesan['id_detbkeluar']; ?>" method="POST">
                                                            <div class="modal-body">
                                                                <!-- general form elements -->
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">ID barang</label>
                                                                        <input type="text" class="form-control" name="idbrg" readonly value="<?= $pesan['id_barang']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nama Barang</label>
                                                                        <input type="text" class="form-control" name="nama" readonly value="<?= $pesan['nama']; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Jumlah</label>
                                                                        <input type="number" class="form-control" id="jml" name="jumlah_update" value="<?= $pesan['jumlah']; ?>" required>
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
                                        <?php endif; ?>

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