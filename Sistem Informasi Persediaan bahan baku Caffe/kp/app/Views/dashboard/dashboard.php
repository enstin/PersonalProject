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
                    <h1>DASHBOARD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DASHBOARD</li>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-4">
                                <!-- <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambah">+TAMBAH+</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <section class="content">
                                <div class="container-fluid">
                                    <!-- Info boxes -->
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-server"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Barang Masuk</span>
                                                    <span class="info-box-number">
                                                        <?= $bmasuk; ?>
                                                    </span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="info-box mb-3">
                                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-server"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Barang Keluar</span>
                                                    <span class="info-box-number"><?= $bkeluar; ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->

                                        <!-- fix for small devices only -->
                                        <div class="clearfix hidden-md-up"></div>

                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="info-box mb-3">
                                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Belanja</span>
                                                    <span class="info-box-number"><?= $belanja; ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </section>
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