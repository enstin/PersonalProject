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
    <?php if (session()->get('jabatan') != 'Owner') : ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <H4>PENYESUAIAN STOK OPNAME</H4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Stok opname</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tb_so as $data) : ?>
                                            <tr>
                                                <td> <?= $data['id_so']; ?></td>
                                                <td> <?= $data['tanggal']; ?></td>
                                                <td> <?= $data['status']; ?></td>
                                                <?php if (session()->get('gudang') == 'g1') : ?>
                                                    <td><a href="/jurnal/trans/<?= $data['id_so']; ?>" class="btn btn-success" id="trans<?= $data['id_so']; ?>">Lihat Detail</a></td>
                                                <?php elseif (session()->get('gudang') == 'g2') : ?>
                                                    <td><a href="/jurnal_g2/trans/<?= $data['id_so']; ?>" class="btn btn-success" id="trans<?= $data['id_so']; ?>">Lihat Detail</a></td>
                                                <?php else : ?>
                                                    <td><a href="/jurnal_g3/trans/<?= $data['id_so']; ?>" class="btn btn-success" id="trans<?= $data['id_so']; ?>">Lihat Detail</a></td>
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
    <?php endif; ?>
    <?php if (session()->get('gudang') == 'g1') : ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <H4>PERSETUJUAN STOCK OPNAME</H4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Stok opname</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tb_sesuai as $data) : ?>
                                            <tr>
                                                <td> <?= $data['id_penyesuaian']; ?></td>
                                                <td> <?= $data['tanggal']; ?></td>
                                                <td> <?= $data['status']; ?></td>
                                                <td>
                                                    <?php if ($data['id_gudang'] == 'g1') : ?>
                                                        <a href="/jurnal/transaksi-persetujuan/<?= $data['id_penyesuaian']; ?>" class="btn btn-success" id="trans<?= $data['id_penyesuaian']; ?>">Lihat Detail</a>
                                                        <a href="/jurnal/cetak/<?= $data['id_penyesuaian']; ?>" class="btn btn-primary" id="trans<?= $data['id_penyesuaian']; ?>">Cetak</a>
                                                    <?php elseif ($data['id_gudang'] == 'g2') : ?>
                                                        <a href="/jurnal_g2/transaksi-persetujuan/<?= $data['id_penyesuaian']; ?>" class="btn btn-success" id="trans<?= $data['id_penyesuaian']; ?>">Lihat Detail</a>
                                                        <a href="/jurnal_g2/cetak/<?= $data['id_penyesuaian']; ?>" class="btn btn-primary" id="trans<?= $data['id_penyesuaian']; ?>">Cetak</a>
                                                    <?php else : ?>
                                                        <a href="/jurnal_g3/transaksi-persetujuan/<?= $data['id_penyesuaian']; ?>" class="btn btn-success" id="trans<?= $data['id_penyesuaian']; ?>">Lihat Detail</a>
                                                        <a href="/jurnal_g3/cetak/<?= $data['id_penyesuaian']; ?>" class="btn btn-primary" id="trans<?= $data['id_penyesuaian']; ?>">Cetak</a>
                                                    <?php endif; ?>
                                                </td>
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
    <?php endif; ?>
</div>


<?= $this->endSection(); ?>