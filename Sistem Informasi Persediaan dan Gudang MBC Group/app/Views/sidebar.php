<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png"> -->
    <span class=" brand-text font-weight-light">MBC GROUP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= session()->get('namauser'); ?></a>
      </div>
    </div>
    <?php if (session()->get('gudang') == 'g1') : ?>
      <?php if (session()->get('jabatan') == 'Owner') : ?>
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
                <i class="nav-icon fas fa-database"></i>
                <p>
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Sukoharjo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Tawangsari</p>
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
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
                  <a href="/histbmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histbkeluar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpesan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemesanan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histminta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histso" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpenyesuaian" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  LAPORAN PERIODIK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/histbarang" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/lapbmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/lapbkeluar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
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
      <?php elseif (session()->get('jabatan') == 'Kepala_gudang') : ?>
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
                    <p>Data Brand</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/berat" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Berat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/ukuran" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Ukuran</p>
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
                <i class="nav-icon fas fa-database"></i>
                <p>
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Sukoharjo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Tawangsari</p>
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
                  <a href="/permintaan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/retpesan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Retur Pesan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/so" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
                  <a href="/histbmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histbkeluar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpesan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemesanan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histminta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histso" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpenyesuaian" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
      <?php elseif (session()->get('jabatan') == 'Admin_Gudang') : ?>
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
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Sukoharjo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Tawangsari</p>
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
                  <a href="/bmasuk" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bkeluar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="/permintaan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li> -->
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
    <?php elseif (session()->get('gudang') == 'g2') : ?>
      <?php if (session()->get('jabatan') == 'Kepala_gudang') : ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item">
              <a href="/dashboard_g2" class="nav-link">
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
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Sukoharjo</p>
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
                  <a href="/permintaan_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/so_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
                  <a href="/histbmasuk_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histbkeluar_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histminta_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histso_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpenyesuaian_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
      <?php elseif (session()->get('jabatan') == 'Admin_Gudang') : ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item">
              <a href="/dashboard_g2" class="nav-link">
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
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Sukoharjo</p>
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
                  <a href="/bmasuk_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bkeluar_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="/permintaan_g2" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li> -->
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
    <?php elseif (session()->get('gudang') == 'g3') : ?>
      <?php if (session()->get('jabatan') == 'Kepala_gudang') : ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item">
              <a href="/dashboard_g3" class="nav-link">
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
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Tawangsari</p>
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
                  <a href="/permintaan_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/so_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/jurnal_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
                  <a href="/histbmasuk_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histbkeluar_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histminta_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histso_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Opname</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/histpenyesuaian_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyesuaian</p>
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
      <?php elseif (session()->get('jabatan') == 'Admin_Gudang') : ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item">
              <a href="/dashboard_g3" class="nav-link">
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
                  DATA STOK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                  <a href="/barang_keseluruhan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stok Barang Keseluruhan</p>
                  </a>
                </li> -->
                <li class="nav-item">
                  <a href="/barang_g1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gudang Pusat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/barang_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>GudangTawangsari</p>
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
                  <a href="/bmasuk_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bkeluar_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="/permintaan_g3" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan</p>
                  </a>
                </li> -->
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
      <?php endif; ?>
    <?php endif; ?>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>