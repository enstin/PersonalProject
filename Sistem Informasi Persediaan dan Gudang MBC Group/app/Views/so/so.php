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
            <?php if (session()->get('gudang') == 'g1') : ?>
              <a href="/so/tambah-so" class="btn btn-primary">TAMBAH</a>
            <?php elseif (session()->get('gudang') == 'g2') : ?>
              <a href="/so_g2/tambah-so" class="btn btn-primary">TAMBAH</a>
            <?php else : ?>
              <a href="/so_g3/tambah-so" class="btn btn-primary">TAMBAH</a>
            <?php endif; ?>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Stock Opname</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($table_data as $data) : ?>
                    <tr>
                      <td> <?= $data['id_so']; ?></td>
                      <td> <?= $data['tanggal']; ?></td>
                      <td> <?= $data['status']; ?></td>
                      <?php if (session()->get('gudang') == 'g1') : ?>
                        <td><a href="/so/lihat/<?= $data['id_so']; ?>" class="btn btn-primary">LIHAT</a></td>
                      <?php elseif (session()->get('gudang') == 'g2') : ?>
                        <td><a href="/so_g2/lihat/<?= $data['id_so']; ?>" class="btn btn-primary">LIHAT</a></td>
                      <?php else : ?>
                        <td><a href="/so_g3/lihat/<?= $data['id_so']; ?>" class="btn btn-primary">LIHAT</a></td>
                      <?php endif; ?>
                    </tr>
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