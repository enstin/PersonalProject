<?= $this->extend('baselayout'); ?>
<!-- section content -->
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?= $permintaanbelum; ?>
                    </h3>

                    <p>PERMINTAAN BELUM DIPROSES</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?= $masuk; ?>
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
                        <?= $keluar; ?>
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

<script>
    $(function() {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                datasets: [{
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: [
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a1']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a2']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a3']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a4']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a5']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a6']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a7']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a8']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a9']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a10']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a11']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahun as $tahun) : ?>
                                <?= $tahun['a12']; ?>
                            <?php endforeach; ?>
                        ]
                    },
                    {
                        backgroundColor: '#ced4da',
                        borderColor: '#ced4da',
                        data: [
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a1']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a2']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a3']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a4']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a5']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a6']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a7']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a8']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a9']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a10']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a11']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($pertahunlalu as $tahunlalu) : ?>
                                <?= $tahunlalu['a12']; ?>
                            <?php endforeach; ?>

                        ]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'rb'
                                }
                                return value

                                // return value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })

        var $visitorsChart = $('#visitors-chart')
        var visitorsChart = new Chart($visitorsChart, {
            data: {
                labels: ['1', '2', '3', '4'],
                datasets: [{
                        type: 'line',
                        data: [
                            <?php foreach ($perminggu as $minggu) : ?>
                                <?= $minggu['keempat']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggu) : ?>
                                <?= $minggu['ketiga']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggu) : ?>
                                <?= $minggu['kedua']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggu) : ?>
                                <?= $minggu['pertama']; ?>
                            <?php endforeach; ?>
                        ],
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false
                        // pointHoverBackgroundColor: '#007bff',
                        // pointHoverBorderColor    : '#007bff'
                    },
                    {
                        type: 'line',
                        data: [
                            <?php foreach ($perminggulalu as $minggulalu) : ?>
                                <?= $minggulalu['pertama']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggulalu) : ?>
                                <?= $minggulalu['kedua']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggulalu) : ?>
                                <?= $minggulalu['ketiga']; ?>
                            <?php endforeach; ?>,
                            <?php foreach ($perminggu as $minggulalu) : ?>
                                <?= $minggulalu['keempat']; ?>
                            <?php endforeach; ?>
                        ],
                        backgroundColor: 'tansparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        fill: false
                        // pointHoverBackgroundColor: '#ced4da',
                        // pointHoverBorderColor    : '#ced4da'
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: 200
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    })
</script>


<!-- /.content-wrapper -->

<?= $this->endSection(); ?>