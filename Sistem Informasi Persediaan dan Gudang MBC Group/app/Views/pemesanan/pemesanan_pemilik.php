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
            </div>
            <!-- /.card-header -->
            <div class="row">
              <div class="col-4">
                <a href="/pemesanan/suplist" class="btn btn-primary">+TAMBAH+</a>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Pemesanan</th>
                    <th>Supplier</th>
                    <th>tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($table_pemesanan as $data) : ?>
                    <tr>
                      <td> <?= $data['id_pesan']; ?></td>
                      <td> <?= $data['nama_perusahaan']; ?></td>
                      <td> <?= $data['tanggal']; ?></td>
                      <td> <?= $data['status']; ?></td>
                      <td>
                        <a href="<?= $link; ?>/lihat-acc/<?= $data['id_pesan']; ?>" class="btn btn-primary">LIHAT</a>
                        <a href="/belanja/cetak/<?= $data['id_pesan']; ?>" class="btn btn-primary">Cetak</a>
                      </td>
                    </tr>
                    <!-- model hapus -->
                    <div class="modal fade" id="hapus<?= $data['id_pesan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="<?= $link; ?>/hapus/<?= $data['id_pesan']; ?>" class="btn btn-primary">Ya</a>
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
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>