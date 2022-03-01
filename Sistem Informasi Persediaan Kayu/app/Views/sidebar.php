<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png"> -->
    <span class=" brand-text font-weight-light">UD JAYA ABADI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= session()->get('namauser'); ?></a>
      </div>
    </div>
      <?php if (session()->get('jabatan') == 'owner') : ?>
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
                  <a href="/user" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data User</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  LAPORAN HISTORIS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

              <li class="nav-item">
                  <a href="/lapkmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pemesanan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                <i class="nav-icon fa fa-power-off"></i>
                <p>
                  LOGOUT
                </p>
              </a>
            </li>
          </ul>

        </nav>
        <!-- /.sidebar-menu -->
      <?php elseif (session()->get('jabatan') == 'admin') : ?>
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
                  <a href="/kayu" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Kayu</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/produk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Produk</p>
                  </a>
                </li>
               
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  TRANSAKSI KAYU
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/kayumasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/kayukeluar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  TRANSAKSI PRODUK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/pemesanan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  LAPORAN HISTORIS
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

              <li class="nav-item">
                  <a href="/lapkmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kayu Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/pemesanan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Produk Keluar</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                <i class="nav-icon fa fa-power-off"></i>
                <p>
                  LOGOUT
                </p>
              </a>
            </li>
          </ul>

        </nav>
        <!-- /.sidebar-menu -->
    <?php endif; ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>