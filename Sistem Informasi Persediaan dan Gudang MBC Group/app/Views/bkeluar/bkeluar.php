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
    <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
        <?php if (session()->get('gudang') == 'g1') : ?>
            <a style="margin-left: 14px;" href="/bkeluar/draftbkeluar" class="btn btn-primary">+TAMBAH BARANG KELUAR INDEPENDEN+</a>
        <?php elseif (session()->get('gudang') == 'g2') : ?>
            <a style="margin-left: 14px;" href="/bkeluar_g2/draftbkeluar" class="btn btn-primary">+TAMBAH BARANG KELUAR INDEPENDEN+</a>
        <?php else : ?>
            <a style="margin-left: 14px;" href="/bkeluar_g3/draftbkeluar" class="btn btn-primary">+TAMBAH BARANG KELUAR INDEPENDEN+</a>
        <?php endif; ?>
    <?php endif; ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <H4>HISTORI BARANG KELUAR</H4>

                        </div>
                        <div class="row">
                            <div class="col-4">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Kekurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_histori as $histori) : ?>
                                        <tr>
                                            <td> <?= $histori['nama']; ?></td>
                                            <td> <?= $histori['jumlah']; ?></td>
                                            <?php if ($histori['convert'] == 'con1') : ?>
                                                <td> <?= $histori['satuan1']; ?></td>
                                            <?php elseif ($histori['convert'] == 'con2') : ?>
                                                <td> <?= $histori['satuan2']; ?></td>
                                            <?php else : ?>
                                                <td> <?= $histori['satuan3']; ?></td>
                                            <?php endif; ?>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- model hapus -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    Data transaksi sebelumnya ditemukan.
                    <br>
                    Apakah anda ingin melanjutkan transaksi sebelumnya?
                </div>
            </div>
            <div class="modal-footer">
                <a href="/bkeluar/draftbkeluar" class="btn btn-primary">Ya</a>
                <a href="/bkeluar/draftbkeluar_2" class="btn btn-primary">Tidak</a>
            </div>
        </div>
    </div>
</div>
<!-- end of model hapus -->

<?= $this->endSection(); ?>