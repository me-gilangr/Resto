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

  @yield('css')
  @stack('css')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-danger text-sm">
    <div class="container">
      <a href="#" class="navbar-brand navbar-danger">
        <img src="{{ asset('images/logo.jpg') }}" alt="Allegra Cafe" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light pl-4" style="font-family: system-ui; font-weight: 400 !important;">CAFE ALLEGRA</span>
      </a>
      
      {{-- <button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> --}}

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        {{-- <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#keranjangModal">
            <i class="fa fa-shopping-basket"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <i class="fa fa-user"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper"> 

    <div class="content pt-3">
      <div class="container">
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
        {{-- <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <p>
              Nama Menu
            </p>
            <span class="badge badge-primary badge-pill">Jumlah</span> 
            <button class="btn btn-xs btn-danger">
              <span class="fa fa-trash"></span>
            </button>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <p>
              Caffee Latte A <br>
              Harga : Rp. <u>20.000</u> <br>
              SubTotal : Rp. <u>20.000</u>
            </p>
            <span class="badge badge-primary badge-pill">1</span>
            <button class="btn btn-xs btn-danger">
              <span class="fa fa-trash"></span>
            </button>
          </li> 
        </ul> --}}
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

@yield('script')
@stack('script')
</body>
</html>
