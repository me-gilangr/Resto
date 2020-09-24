<div class="sidebar">
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('backend.index') }}" class="nav-link {{ Request::is('Internal') ? 'active':'' }}">
          <i class="nav-icon fa fa-home"></i>
          <p>
            Halaman Utama
          </p>
        </a>
      </li>
      <li class="nav-header pt-3 pl-3"><b><u>Navigasi Menu</u></b></li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Master Data
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kategori Menu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Daftar Menu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Daftar Meja</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-header pt-2 pl-3"><b><u>Dapur</u></b></li>
      <li class="nav-item">
        <a href="{{ route('backend.index') }}" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Data Pesanan
          </p>
        </a>
      </li>
      <li class="nav-header pt-2 pl-3"><b><u>Pelayan</u></b></li>
      <li class="nav-item">
        <a href="{{ route('backend.data-pesanan') }}" class="nav-link">
          <i class="nav-icon fa fa-tag"></i>
          <p>
            Pemesanan Customer
          </p>
        </a>
      </li>
    </ul>
  </nav>
</div>