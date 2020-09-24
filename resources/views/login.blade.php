<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Cafe Allegra</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box"> 
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Allegra" class="img-fluid" style="height: 120px !important;">
        <br>
        <b>Cafe Allegra</b>
        <br><br>
        Silahkan Login
      </p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" placeholder="Masukan E-Mail Pengguna...">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" style="
              background-color: #694121 !important;
              color: #ffffff !important;
              border-color: #4c2b14 !important;
            ">Login Sistem</button>
          </div>
          <!-- /.col -->
        </div>
      </form> 
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend') }}/dist/js/adminlte.min.js"></script>

</body>
</html>
