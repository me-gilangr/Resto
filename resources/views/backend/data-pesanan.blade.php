@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-outline card-danger">
      <div class="card-header">
        <h4 class="card-title">
          <i class="fa fa-utensils text-danger"></i> &ensp; Daftar Pesanan Pelanggan  
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Nomor Meja</th>
                <th>Jumlah Menu</th>
                <th>Jumlah Item</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection