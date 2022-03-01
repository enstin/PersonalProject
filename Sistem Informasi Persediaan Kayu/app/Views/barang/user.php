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
          <h1>DATA USER</h1>
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
                    <th>username</th>
                    <th>nama</th>
                    <th>jabatan</th>
                    <th>No telpon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data_user as $user) : ?>
                    <tr>
                      <td> <?= $user['user']; ?></td>
                      <td> <?= $user['nama']; ?></td>
                      <td> <?= $user['jabatan']; ?></td>
                      <td> <?= $user['no_telpon']; ?></td>
                      <td>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $user['user']; ?>">EDIT</a>
                        <a href="/user/hapus/<?= $user['user']; ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger" data-target="#hapus<?= $user['user']; ?>">HAPUS</a>
                      </td>
                    </tr>
                    <!-- model edit -->
                    <div class="modal fade" id="edit<?= $user['user']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="card-header">
                            <h5 class="modal-title" id="staticBackdropLabel">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= $link; ?>/ubah/<?= $user['user']; ?>" method="POST">
                            <div class="modal-body">
                              <!-- general form elements -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama user</label>
                                  <input type="text" class="form-control" name="nama" placeholder="user       (Wajib Diisi)" value="<?= $user['nama']; ?>" required disabled>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label><br>
                                  <input type="password" class="form-control" name="password" placeholder="password      (Wajib Diisi)" id="myInput" value="<?= $user['password']; ?>" required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Telpon</label><br>
                                <input type="number" class="form-control" name="telpon" placeholder="No Telpon      (Wajib Diisi)" id="myInput" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Jabatan</label>
                                  <select class="form-control" name="jabatan" required>
                                  <option value="Owner"> Owner </option>
                                  <option value="Kepala_gudang"> Admin </option>
                                  </select>
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
          <h5 class="modal-title" id="staticBackdropLabel">TAMBAH DATA user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">ID user</label>
              <input type="text" class="form-control" name="user      (Wajib Diisi)" placeholder="ID" required >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama user</label>
              <input type="text" class="form-control" name="nama      (Wajib Diisi)" placeholder="nama" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label><br>
              <input type="password" class="form-control" name="password      (Wajib Diisi)" placeholder="Password" id="myInput" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nomor Telpon</label><br>
              <input type="number" class="form-control" name="telpon" placeholder="No Telpon" id="myInput" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
              <select class="form-control" name="jabatan" required>
                <option value="Owner"> Owner </option>
                <option value="Kepala_gudang"> Admin </option>
              </select>
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