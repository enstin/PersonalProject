<?= $this->extend('baselayout'); ?>
<!-- section content -->
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Small boxes (Stat box) -->
    <div class="row">
       
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                     
                    </h3>

                    <p>BARANG MASUK MINGGU INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                     
                    </h3>

                    <p>BARANG KELUAR MINGGU INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
    </div>
    <!-- /.row -->


    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">BARANG KELUAR</h3>
            </div>
            <span class="text-muted">PERMINGGU</span>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <!-- <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 12.5%
                    </span> -->

                </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> BULAN INI
                </span>

                <span>
                    <i class="fas fa-square text-gray"></i> BULAN LALU
                </span>
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">BARANG KELUAR</h3>
            </div>
            <span>PERBULAN</span>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>

                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i>
                    </span>
                    <span class="text-muted"></span>
                </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> TAHUN INI
                </span>

                <span>
                    <i class="fas fa-square text-gray"></i> TAHUN LALU
                </span>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->




<!-- /.content-wrapper -->

<?= $this->endSection(); ?>