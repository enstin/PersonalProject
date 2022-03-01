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
    <?php endif; ?>
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
                            <select class="form-control select2bs4" name="brg" id="namabrg" required style="width: 100%;">
                                <?php foreach ($option_barang as $barang) : ?>
                                    <option a href="/pemesanan/go_tambah_pemesanan_pil" value="<?= $barang['id_barang']; ?>" <?php session()->set(['id_barang' => $barang['id_barang']]); ?> <?php session()->set(['satuan1' => $barang['satuan1']]); ?> <?php session()->set(['satuan2' => $barang['satuan2']]); ?> <?php session()->set(['satuan3' => $barang['satuan3']]); ?>> <?= $barang['nama']; ?> </option>
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
                                        url: "http://localhost:8080/pemesanan/get_satuan",
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
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="satuan" id="satuan" class="form-control" disabled>
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
                            <h3 class="card-title">ITEM</h3>
                        </div>
                        <!-- /.card-header -->

                        <a href="<?= $link; ?>/simpan-draft" class="btn btn-success">SIMPAN</a>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id_barang</th>
                                        <th>jumlah</th>
                                        <th>urgnesi</th>
                                        <th>subtotal</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>

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