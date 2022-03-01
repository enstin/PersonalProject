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
                    <th>berat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data_berat as $berat) : ?>
                    <tr>
                      <td> <?= $berat['id_berat']; ?></td>
                      <td> <?= $berat['berat']; ?></td>
                      <td>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $berat['id_berat']; ?>">EDIT</a>
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $berat['id_berat']; ?>">HAPUS</a>
                      </td>
                    </tr>
                    <!-- model edit -->
                    <div class="modal fade" id="edit<?= $berat['id_berat']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="card-header">
                            <h5 class="modal-title" id="staticBackdropLabel">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= $link; ?>/ubah/<?= $berat['id_berat']; ?>" method="POST">
                            <div class="modal-body">
                              <!-- general form elements -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Berat</label>
                                  <input type="number" class="form-control" name="berat" placeholder="berat barang" value="<?= $berat['berat']; ?>" required>
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
                    <div class="modal fade" id="hapus<?= $berat['id_berat']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="/berat/hapus/<?= $berat['id_berat']; ?>" class="btn btn-primary">Ya</a>
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
          <h5 class="modal-title" id="staticBackdropLabel">TAMBAH DATA berat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Berat</label>
              <input type="number" class="form-control" name="berat" placeholder="berat barang" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value='Simpan'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">kembali</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- end of model tambah -->
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>