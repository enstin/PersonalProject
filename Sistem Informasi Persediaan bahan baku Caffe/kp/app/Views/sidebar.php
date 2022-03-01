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
        <?php if (session()->get('jabatan') == 'Staff Gudang') : ?>
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
                <a href="/jenis-barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jenis Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                BARANG MASUK
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/belanja" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perencanaan belanja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/bmasuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang masuk</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/bkeluar" class="nav-link">
              <i class="nav-icon fa fa-coffee"></i>
              <p>
                BARANG KELUAR
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="/pbkeluar" class="nav-link">
              <i class="nav-icon fa fa-industry"></i>
              <p>
                Permintaan
                barang keluar
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-fax"></i>
              <p>
                STOCK OPNAME
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/so" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Opname</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/jurnal" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jurnal Penyesuaian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-fax"></i>
              <p>
                PEMBUATAN LAPORAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/laporan/barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Stok Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/bmasuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/bkeluar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Barang Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/histori/bmasuk" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori barang masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/histori/bkeluar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori barang keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/histori/so" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Stok opname</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/histori/penyesuaian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori penyesuaian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan/histori/pbkeluar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Permintaan Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan//histori/belanja" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Histori Belanja</p>
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
        <?php endif; ?>
        <?php if (session()->get('jabatan') == 'Barista') :  ?>
          <li class="nav-header">Menu</li>
          <li class="nav-item">
            <a href="/pbkeluar" class="nav-link">
              <i class="nav-icon fa fa-industry"></i>
              <p>
                Permintaan
                barang keluar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/laporan/histori/pbkeluar" class="nav-link">
              <i class="nav-icon fa fa-folder"></i>
              <p>
                Histori Premintaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>
                LOGOUT
              </p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>