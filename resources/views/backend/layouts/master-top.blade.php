<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Cafe Allegra</title>

  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon') }}/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon') }}/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon') }}/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon') }}/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon') }}/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon') }}/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon') }}/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon') }}/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon') }}/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('images/favicon') }}/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon') }}/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon') }}/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon') }}/favicon-16x16.png">
  <link rel="manifest" href="{{ asset('images/favicon') }}/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('images/favicon') }}/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @livewireStyles
  @yield('css')
  @stack('css')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-danger text-sm">
    <div class="container">
      <a href="{{ route('backend.index') }}" class="navbar-brand navbar-danger">
        <img src="{{ asset('images/logo.jpg') }}" alt="Allegra Cafe" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light pl-4" style="font-family: system-ui; font-weight: 400 !important;">CAFE ALLEGRA</span>
      </a>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse"> 

      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto"> 
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
              <img src="{{ asset('images/logo.png') }}" alt="Logo Allegra" class="img-fluid" style="height: 100px !important;">
            </span>
            <div class="dropdown-divider"></div>
            <div href="#" class="dropdown-item text-center">
              {{ auth()->check() ? 'Halo, ' . auth()->user()->name : 'Silahkan Login' }}
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item dropdown-footer" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
  
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper"> 
    <div class="content pt-3">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <footer class="main-footer text-center text-xs p-1">
    <div class="float-right d-none d-sm-inline">
      Self-Service
    </div>
    <strong>Copyright &copy; 2020 <a href="#">Cafe Allegra</a>.</strong>
  </footer>
</div>

<div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="keranjangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="keranjangModalLabel"><i class="fa fa-shopping-basket text-danger"></i> &ensp; Menu Yang Akan di-Pesan.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <td class="pl-3">Nama Menu</td>
                <td class="text-center">Jumlah</td>
                <td class="text-center">Aksi</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pl-3">
                  Coffee Latte A <br>
                  <span class="badge badge-primary badge-pill">Rp. 20.000</span> 
                </td>
                <td class="text-center">
                  1 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 20.000</span> 
                </td>
                <td class="text-center" style="vertical-align: inherit;">
                  <button class="btn btn-xs btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
              <tr>
                <td class="pl-3">
                  Coffee Latte B <br>
                  <span class="badge badge-primary badge-pill">Rp. 25.000</span> 
                </td>
                <td class="text-center">
                  2 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 50.000</span> 
                </td>
                <td class="text-center" style="vertical-align: inherit;">
                  <button class="btn btn-xs btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
              <tr>
                <td class="pl-3">
                  Coffee Latte C <br>
                  <span class="badge badge-primary badge-pill">Rp. 30.000</span> 
                </td>
                <td class="text-center">
                  1 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 30.000</span> 
                </td>
                <td class="text-center" style="vertical-align: inherit;">
                  <button class="btn btn-xs btn-danger">
                    <span class="fa fa-trash"></span>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="text-right">Total &ensp; : </td>
                <td>Rp. 100.000</td>
              </tr>
            </tfoot>
          </table>
        </div> 
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-paper-plane"></i> &ensp; Lakukan Pemesanan</button>
      </div>
    </div>
  </div>
</div>


<!-- jQuery -->
<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend') }}/dist/js/adminlte.min.js"></script>


@livewireScripts
<script>
	$(document).ready(function() {
		window.livewire.on('success', success => {
			toastr.success(success, 'Berhasil !');
		});
		
		window.livewire.on('info', info => {			
			toastr.info(info, 'Informasi !');
		});

		window.livewire.on('warning', warning => {			
			toastr.warning(warning, 'Peringatan !');
		});

		window.livewire.on('error', error => {			
			toastr.error(error, 'Kesalahan !');
		});
	});
</script>
@yield('script')
@stack('script')
</body>
</html>
