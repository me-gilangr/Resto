<div>
  <div class="card card-info card-outline">
    <div class="card-header">
      <h4 class="card-title"><span class="fa fa-coins text-info"></span> &ensp; Pembayaran</h4>
    </div>
    <div class="card-body p-0 bayar">
      <div class="row p-0 m-0">
        <div class="col-12 p-0 m-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr style="border-top: 1px solid #aaaeb3; border-bottom: 1px solid #aaaeb3;">
                  <th class="text-center">No.</th>
                  <th>Nama Menu</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center">Sub Total</th>
                  <th class="text-center">#</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($menu as $item) 
                <tr style="border-top: 1px solid #aaaeb3; border-bottom: 1px solid #aaaeb3;">
                  <td class="text-center align-middle">{{ $loop->iteration }}. </td>
                  <td class="align-middle">{{ $item['menu_header']['FN_MENU'] }}</td>
                  <td width="15%">
                    <input type="number" wire:model="menu.{{ $item['FNO_D_PESAN'] }}.FJML" min="1" max="{{ $item['max'] }}" class="form-control form-control-sm" style="border-radius: 0px;" style="text-align: center;" value="{{ $item['FJML'] }}" required>
                  </td>
                  <td class="text-center align-middle">Rp. {{ number_format(($item['FHARGA'] * $item['FJML']), 0, ',', '.') }}</td>
                  <td class="text-center align-middle">
                    <button class="btn btn-danger btn-sm" wire:click="removeMenu('{{ $item['FNO_D_PESAN'] }}')">
                      <span class="fa fa-trash"></span>
                    </button>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center">Silahkan Pilih Data</td>
                </tr>
                @endforelse
              </tbody>
              {{-- <tfoot>
                <tr>
                  <td colspan="3" class="text-right">
                    <b>Total &ensp; : &ensp;</b>
                  </td>
                  <td class="text-center">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                  <td></td>
                </tr>
              </tfoot> --}}
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-7 text-right pt-1 pb-1">
          <h6>
            Total : 
          </h6>
        </div>
        <div class="col-5 text-center pt-1 pb-1">
          <h6>
            Rp. {{ number_format($total, 0, ',' ,'.') }}
          </h6>
        </div>
        {{-- <div class="col-7 text-right">
          <h6>
            Diskon : 
          </h6>
        </div>
        <div class="col-5 text-center">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="number" name="disc" id="disc" placeholder="0" min="0" class="form-control">
          </div>
        </div> --}}
        <div class="col-7 text-right pt-1 pb-1">
          <h6 class="align-middle">
            Bayar : 
          </h6>
        </div>
        <div class="col-5 text-center">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp. </span>
            </div>
            <input type="number" name="pay" id="pay" wire:model.debounce.200ms="bayar" placeholder="0" min="{{ $total }}" class="form-control">
          </div>
        </div>
        <div class="col-7 text-right pt-1 pb-1">
          <h6>
            Kembalian : 
          </h6>
        </div>
        <div class="col-5 text-center pt-1 pb-1">
          <h6>
            Rp. {{ number_format($kembalian, 0, ',', '.') }}
          </h6>
        </div>
        <div class="col-12">
          <button class="btn btn-outline-success btn-block">
            Bayar Pesanan
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
