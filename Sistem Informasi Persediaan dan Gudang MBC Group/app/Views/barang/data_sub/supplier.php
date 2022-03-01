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
                    <th>Perusahaan</th>
                    <th>Penanggungjawab</th>
                    <th>Telfon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data_supplier as $supplier) : ?>
                    <tr>
                      <td> <?= $supplier['id_supplier']; ?></td>
                      <td> <?= $supplier['nama_perusahaan']; ?></td>
                      <td> <?= $supplier['penanggungjawab']; ?></td>
                      <td> <?= $supplier['telpon']; ?></td>
                      <td> <?= $supplier['alamat']; ?></td>
                      <td>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $supplier['id_supplier']; ?>">EDIT</a>
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $supplier['id_supplier']; ?>">HAPUS</a>
                      </td>
                    </tr>
                    <!-- model edit -->
                    <div class="modal fade" id="edit<?= $supplier['id_supplier']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="card-header">
                            <h5 class="modal-title" id="staticBackdropLabel">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= $link; ?>/ubah/<?= $supplier['id_supplier']; ?>" method="POST">
                            <div class="modal-body">
                              <!-- general form elements -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Perusahaan</label>
                                  <input type="text" class="form-control" name="nama_perusahaan" placeholder="supplier barang" value="<?= $supplier['nama_perusahaan']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Penanggungjawab</label><br>
                                  <input type="text" class="form-control" name="penanggungjawab" placeholder="supplier barang" id="myInput" value="<?= $supplier['penanggungjawab']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Telpon</label>
                                  <input type="number" class="form-control" name="telpon" placeholder="supplier barang" value="<?= $supplier['telpon']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Alamat</label>
                                  <input type="text" class="form-control" name="alamat" placeholder="supplier barang" value="<?= $supplier['alamat']; ?>" required>
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
                    <div class="modal fade" id="hapus<?= $supplier['id_supplier']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="/supplier/hapus/<?= $supplier['id_supplier']; ?>" class="btn btn-primary">Ya</a>
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
          <h5 class="modal-title" id="staticBackdropLabel">TAMBAH DATA supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Perusahaan</label>
              <input type="text" class="form-control" name="nama_perusahaan" placeholder="supplier barang" value="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Penanggungjawab</label><br>
              <input type="text" class="form-control" name="penanggungjawab" placeholder="supplier barang" id="myInput" value="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Telpon</label>
              <input type="number" class="form-control" name="telpon" placeholder="supplier barang" value="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Alamat</label>
              <input type="text" class="form-control" name="alamat" placeholder="supplier barang" value="" required>
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