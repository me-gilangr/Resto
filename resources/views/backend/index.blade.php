@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-primary"><i class="fa fa-table"></i></span>

      <div class="info-box-content pt-2">
        <span class="info-box-text">Meja Kosong : </span>
        <span class="info-box-number">10 Meja</span>

        <div class="progress">
          <div class="progress-bar bg-primary" style="width: 100%"></div>
        </div> 
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fa fa-list-alt"></i></span>

      <div class="info-box-content pt-2">
        <span class="info-box-text">Transaksi Harian : </span>
        <span class="info-box-number">25 Transaksi</span>

        <div class="progress">
          <div class="progress-bar bg-info" style="width: 100%"></div>
        </div> 
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-6 col-sm-12 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fa fa-credit-card"></i></span>

      <div class="info-box-content pt-2">
        <span class="info-box-text">Pendapatan Harian : </span>
        <span class="info-box-number">Rp. 2.350.000</span>

        <div class="progress">
          <div class="progress-bar bg-success" style="width: 100%"></div>
        </div> 
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
@endsection