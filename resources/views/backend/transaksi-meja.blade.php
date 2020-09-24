@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-danger">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P01</h4>
        <p class="card-text">Tidak Ada Transaksi</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info">Total : Rp. 0</a>
      </div>
    </div>
  </div> 
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-success">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P02</h4>
        <p class="card-text m-0">3 Menu</p>
        <p class="card-text">4 Item</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info" data-toggle="modal" data-target="#modalTransaksi">Total : Rp. <u>100.000</u></a>
      </div>
    </div>
  </div> 
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-danger">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P03</h4>
        <p class="card-text">Tidak Ada Transaksi</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info">Total : Rp. 0</a>
      </div>
    </div>
  </div> 
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-danger">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P04</h4>
        <p class="card-text">Tidak Ada Transaksi</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info">Total : Rp. 0</a>
      </div>
    </div>
  </div> 
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-danger">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P05</h4>
        <p class="card-text">Tidak Ada Transaksi</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info">Total : Rp. 0</a>
      </div>
    </div>
  </div>  
  <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-success">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
        <h4 style="float: none !important;">P06</h4>
        <p class="card-text m-0">3 Menu</p>
        <p class="card-text">4 Item</p>
        <a href="#" class="btn btn-xs btn-block btn-outline-info" data-toggle="modal" data-target="#modalTransaksi">Total : Rp. <u>100.000</u></a>
      </div>
    </div>
  </div> 
</div>


<div class="modal fade" id="modalTransaksi" tabindex="-1" aria-labelledby="modalTransaksiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTransaksiLabel"><i class="fa fa-shopping-basket text-danger"></i> &ensp; Pesanan Meja : P02.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 text-sm">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <td class="pl-3" style="white-space: nowrap;">Nama Menu</td>
                <td class="text-center">Jumlah</td> 
                <td class="text-center">Status</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pl-3" style="white-space: nowrap;">
                  Coffee Latte A <br>
                  <span class="badge badge-primary badge-pill">Rp. 20.000</span> 
                </td>
                <td class="text-center">
                  1 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 20.000</span> 
                </td> 
                <td class="text-center" style="vertical-align: inherit; white-space: nowrap;">
                  <button class="btn btn-outline-success btn-xs">
                    Selesai di-Buat
                  </button>
                </td>
              </tr>
              <tr>
                <td class="pl-3" style="white-space: nowrap;">
                  Coffee Latte B <br>
                  <span class="badge badge-primary badge-pill">Rp. 25.000</span> 
                </td>
                <td class="text-center">
                  2 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 50.000</span> 
                </td> 
                <td class="text-center" style="vertical-align: inherit; white-space: nowrap;">
                  <button class="btn btn-outline-warning btn-xs">
                    Proses Pembuatan
                  </button>
                </td>
              </tr>
              <tr>
                <td class="pl-3" style="white-space: nowrap;">
                  Coffee Latte C <br>
                  <span class="badge badge-primary badge-pill">Rp. 30.000</span> 
                </td>
                <td class="text-center">
                  1 Item <br>
                  <span class="badge badge-success badge-pill">Sub Total : Rp. 30.000</span> 
                </td>
                <td class="text-center" style="vertical-align: inherit; white-space: nowrap;">
                  <button class="btn btn-outline-success btn-xs">
                    Selesai di-Buat
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="text-right">Total &ensp; : </td>
                <td class="text-center"><b>Rp. 100.000</b></td>
              </tr>
            </tfoot>
          </table>
        </div> 
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection