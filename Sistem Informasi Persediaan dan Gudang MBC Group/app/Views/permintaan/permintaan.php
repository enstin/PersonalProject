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
              <h4 style="text-align:center;">PERMINTAAN DIAJUKAN</h4>
              <?php if (session()->get('gudang') == 'g1') : ?>
                <a href="/permintaan/gudlist" class="btn btn-primary">+TAMBAH+</a>
              <?php elseif (session()->get('gudang') == 'g2') : ?>
                <a href="/permintaan_g2/go_tambah_permintaan" class="btn btn-primary">+TAMBAH+</a>
              <?php elseif (session()->get('gudang') == 'g3') : ?>
                <a href="/permintaan_g3/go_tambah_permintaan" class="btn btn-primary">+TAMBAH+</a>
              <?php endif; ?>
            </div>
            <!-- /.card-header -->
            <div class="row">
              <div class="col-4">


              </div>
            </div>
            <div class="row">
              <div class="col-4">

              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>id_user</th>
                    <th>tanggal</th>
                    <th>Status</th>
                    <th>tujuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($table_data as $data) : ?>
                    <tr>
                      <td> <?= $data['id_permintaan']; ?></td>
                      <td> <?= $data['id_user']; ?></td>
                      <td> <?= $data['tanggal']; ?></td>
                      <td> <?= $data['status']; ?></td>
                      <td> <?= $data['tujuan']; ?></td>
                      <td>
                        <?php if (session()->get('gudang') == 'g1') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan/non-acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g1') : ?>
                              <a href="/permintaan/detail_non_view/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php else : ?>
                              <a href="/permintaan/detail_acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan_g2/non-acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g2') : ?>
                              <a href="/permintaan_g2/detail_non_view/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php else : ?>
                              <a href="/permintaan_g2/detail_acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php elseif (session()->get('gudang') == 'g3') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan_g3/non-acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g3') : ?>
                              <a href="/permintaan_g3/detail_non_view/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php else : ?>
                              <a href="/permintaan_g3/detail_acc/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <!-- model hapus -->
                    <div class="modal fade" id="hapus<?= $data['id_permintaan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="<?= $link; ?>/hapus/<?= $data['id_permintaan']; ?>" class="btn btn-primary">Ya</a>
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
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 style="text-align:center;">PERMINTAAN MASUK</h4>
            </div>
            <!-- /.card-header -->
            <div class="row">
              <div class="col-4">

              </div>
            </div>
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>id_user</th>
                    <th>tanggal</th>
                    <th>Status</th>
                    <th>Dari</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($table_request as $data) : ?>
                    <tr>
                      <td> <?= $data['id_permintaan']; ?></td>
                      <td> <?= $data['id_user']; ?></td>
                      <td> <?= $data['tanggal']; ?></td>
                      <td> <?= $data['status']; ?></td>
                      <td> <?= $data['asal']; ?></td>
                      <td>
                        <?php if (session()->get('gudang') == 'g1') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g2' || $data['status'] == 'Diajukan-g3') : ?>
                              <a href="/permintaan/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan/akan-kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">SETUJUI</a>
                            <?php else : ?>
                              <a href="/permintaan/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan/kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">KIRIM</a>
                               <a href="/permintaan/cetak/<?= $data['id_permintaan']; ?> " class="btn btn-primary" target="_blank">CETAK</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php elseif (session()->get('gudang') == 'g2') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan_g2/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g1') : ?>
                              <a href="/permintaan_g2/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan_g2/akan-kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">SETUJUI</a>
                            <?php else : ?>
                              <a href="/permintaan_g2/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan_g2/kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">KIRIM</a>
                               <a href="/permintaan/cetak/<?= $data['id_permintaan']; ?> " class="btn btn-primary" target="_blank">CETAK</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php elseif (session()->get('gudang') == 'g3') : ?>
                          <?php if (session()->get('jabatan') == 'Admin_Gudang') : ?>
                            <a href="/permintaan_g3/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                          <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
                            <?php if ($data['status'] == 'Diajukan-g1') : ?>
                              <a href="/permintaan_g3/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan_g3/akan-kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">SETUJUI</a>
                            <?php else : ?>
                              <a href="/permintaan_g3/lihat/<?= $data['id_permintaan']; ?>" class="btn btn-primary">LIHAT</a>
                              <a href="/permintaan_g3/kirim/<?= $data['id_permintaan']; ?>" class="btn btn-primary">KIRIM</a>
                                <a href="/permintaan/cetak/<?= $data['id_permintaan']; ?> " class="btn btn-primary" target="_blank">CETAK</a>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <!-- model hapus -->
                    <div class="modal fade" id="hapus<?= $data['id_permintaan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="<?= $link; ?>/hapus/<?= $data['id_permintaan']; ?>" class="btn btn-primary">Ya</a>
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