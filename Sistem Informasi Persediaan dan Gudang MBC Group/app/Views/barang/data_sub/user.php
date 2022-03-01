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
                    <th>nama</th>
                    <th>jabatan</th>
                    <th>Tempat tugas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data_user as $user) : ?>
                    <tr>
                      <td> <?= $user['id_user']; ?></td>
                      <td> <?= $user['nama']; ?></td>
                      <td> <?= $user['jabatan']; ?></td>
                      <td> <?= $user['gudang']; ?></td>
                      <td>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $user['id_user']; ?>">EDIT</a>
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $user['id_user']; ?>">HAPUS</a>
                      </td>
                    </tr>
                    <!-- model edit -->
                    <div class="modal fade" id="edit<?= $user['id_user']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="card-header">
                            <h5 class="modal-title" id="staticBackdropLabel">EDIT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="<?= $link; ?>/ubah/<?= $user['id_user']; ?>" method="POST">
                            <div class="modal-body">
                              <!-- general form elements -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama user</label>
                                  <input type="text" class="form-control" name="user" placeholder="user barang" value="<?= $user['nama']; ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label><br>
                                  <input type="password" class="form-control" name="password" placeholder="user barang" id="myInput" value="<?= $user['password']; ?>" required>
                                  <input type="checkbox" onclick="myFunction()">Show Password
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Jabatan</label>
                                  <select class="form-control" name="jabatan" required>
                                    <option value="Owner"> Owner </option>
                                    <option value="Kepala_gudang"> Kepala Gudang </option>
                                    <option value="Admin_Gudang"> Admin Gudang </option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">gudang</label>
                                  <select class="form-control" name="idgudang" required>
                                    <?php foreach ($data_gudang as $gudang) : ?>
                                      <option value=<?= $gudang['id_gudang']; ?>> <?= $gudang['gudang']; ?> </option>
                                    <?php endforeach; ?>
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
                    <!-- model hapus -->
                    <div class="modal fade" id="hapus<?= $user['id_user']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <a href="/user/hapus/<?= $user['id_user']; ?>" class="btn btn-primary">Ya</a>
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
              <input type="text" class="form-control" name="iduser" placeholder="user barang" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama user</label>
              <input type="text" class="form-control" name="user" placeholder="user barang" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label><br>
              <input type="password" class="form-control" name="password" placeholder="user barang" id="myInput" required>
              <input type="checkbox" onclick="myFunction()">Show Password
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
              <select class="form-control" name="jabatan" required>
                <option value="Owner"> Owner </option>
                <option value="Kepala_gudang"> Kepala Gudang </option>
                <option value="Admin_Gudang"> Admin Gudang </option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">gudang</label>
              <select class="form-control" name="idgudang" required>
                <?php foreach ($data_gudang as $gudang) : ?>
                  <option value=<?= $gudang['id_gudang']; ?>> <?= $gudang['gudang']; ?> </option>
                <?php endforeach; ?>
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