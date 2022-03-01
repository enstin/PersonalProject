<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png"> -->
    <span class=" brand-text font-weight-light">PERSEDIAAN REMBUG KOPI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= session()->get('namauser'); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon fa fa-coffee"></i>
            <p>
              DASHBOARD
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-database"></i>
            <p>
              DATA MASTER
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/barang" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/brand" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/berat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data berat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/ukuran" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data ukuran</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data user</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/cr" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Conversin Rate</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/supplier" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Supplier</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cubes"></i>
            <p>
              TRANSAKSI
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pemesanan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemesanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/bmasuk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>barang masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/retpesan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>retpemesanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/retminta" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>retpermintaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/bkeluar" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>bkeluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/permintaan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>permintaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/so" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>so</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/jurnal" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>penyesuaian</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pemesanan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemesanan</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>