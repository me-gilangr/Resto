@extends('backend.layouts.master')

@section('content')
<script>
  function switching(num) {
    if ($('#customSwitch'+num).is(':checked')) {
      $('#customSwitchLabel'+num).text('Bisa di-Buat');
    } else {
      $('#customSwitchLabel'+num).text('Tidak Bisa di-Buat');
    }
  }
</script>
<div class="row text-sm">
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
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <td>P01</td>
              <td>3 Menu</td>
              <td>4 Item</td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="#" data-toggle="modal" data-target="#pesananModal" class="btn btn-outline-info btn-xs borad-5" title="Detail Pemesanan">
                    <i class="fa fa-info-circle"></i>
                  </a>
                  <a href="#" class="btn btn-outline-success btn-xs borad-5 ml-1" title="Konfirmasi Pemesanan">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="#" class="btn btn-outline-danger btn-xs borad-5 ml-1" title="Tolak Pesanan">
                    <i class="fa fa-times-circle"></i>
                  </a>
                </div>
              </td>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pesananModal" tabindex="-1" aria-labelledby="pesananModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pesananModalLabel"><i class="fa fa-shopping-basket text-danger"></i> &ensp; Pesanan Meja : P01.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <td class="pl-3" style="white-space: nowrap;">Nama Menu</td>
                <td class="text-center">Jumlah</td>
                <td class="text-center">Aksi</td>
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
                <td class="text-center" style="vertical-align: bottom; white-space: nowrap;">
                  <div class="form-group text-sm">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" name="switch" id="customSwitch1" onclick="switching(1);">
                      <label class="custom-control-label" for="customSwitch1" id="customSwitchLabel1">
                        Tidak Bisa di-Buat
                      </label>
                    </div>
                  </div>
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
                <td class="text-center" style="vertical-align: bottom; white-space: nowrap;">
                  <div class="form-group text-sm">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" name="switch" id="customSwitch2" onclick="switching(2);">
                      <label class="custom-control-label" for="customSwitch2" id="customSwitchLabel2">
                        Tidak Bisa di-Buat
                      </label>
                    </div>
                  </div>
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
                <td class="text-center" style="vertical-align: bottom; white-space: nowrap;">
                  <div class="form-group text-sm">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" name="switch" id="customSwitch3" onclick="switching(3);">
                      <label class="custom-control-label" for="customSwitch3" id="customSwitchLabel3">
                        Tidak Bisa di-Buat
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="text-right">Total &ensp; : </td>
                <td><b>Rp. 100.000</b></td>
              </tr>
            </tfoot>
          </table>
        </div> 
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-paper-plane"></i> &ensp; Konfirmasi Pesanan</button>
      </div>
    </div>
  </div>
</div>
@endsection