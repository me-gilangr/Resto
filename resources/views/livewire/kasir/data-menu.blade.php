<div>
	<h6 class="text-center pb-2">
    <b>Data Menu Pesanan</b>
  </h6>
  <button class="btn btn-sm btn-outline-success btn-block align-middle" style="border-radius: 0px;" wire:click="payAll('{{ $FNO_H_PESAN }}')">
    <span class="fa fa-check"></span> &ensp;
    Bayar Seluruh Pesanan
  </button>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Nama Menu</th>
          <th class="text-center">Jml ( <span class="fa fa-check"></span> )</th>
          <th>Harga</th>
          <th>Subtotal</th>
          <th>Status</th>
          <th class="text-center">#</th>
        </tr>
      </thead>
      <tbody>
				@foreach ($pesanan->detail as $item)
          <tr>
            <td>{{ $item->menuHeader->FN_MENU }}</td>
            <td width="15%" class="text-center">
							{{ $item->FJML }} 
							( 
								@php
									$jml_bayar = 0;
									foreach ($item->bayar as $key => $value) {
										$jml_bayar += $value->FJML;
									}
								@endphp
								{{ $jml_bayar }}
							)
						</td>
            <td width="15%">Rp. {{ number_format($item->FHARGA, 0, ',', '.') }}</td>
            <td width="18%">Rp. {{ number_format($item->FHARGA * $item->FJML, 0, ',', '.') }}</td>
            <td>
              @switch($item->FSTATUS_PESAN)
                @case(1)
                  <button class="btn btn-outline-secondary btn-xs btn-block">
                    Menunggu Konfirmasi
                  </button>
                    @break
                @case(2)
                  <button class="btn btn-outline-info btn-xs btn-block">
                    Antrian Pesanan Dapur / Bar
                  </button>
                    @break
                @case(3)
                  <button class="btn btn-outline-warning btn-xs btn-block">
                    Sedang di-Masak / di-Buat
                  </button>
                    @break
                @case(4)
                  <button class="btn btn-outline-success btn-xs btn-block">
                    Selesai di-Buat
                  </button>
                    @break
                @case(5)
                  <button class="btn btn-outline-success btn-xs btn-block">
                    Pesanan di-Antar
                  </button>
                    @break
                @case(6)
                  <button class="btn btn-outline-success btn-xs btn-block">
                    Menunggu Pembayaran
                  </button>
                    @break
                @case(7)
                  <button class="btn btn-outline-primary btn-xs btn-block">
                    Sudah di-Bayar
                  </button>
										@break
								@case(8) 
									<button class="btn btn-outline-info btn-xs btn-block">
										di-Bayar Sebagian
									</button>
										@break
                @default
                  <button class="btn btn-outline-secondary btn-xs btn-block">
                    No Status
                  </button>
              @endswitch
            </td>
            <td>
              @if ($item->FSTATUS_PESAN == '6')
                <button class="btn btn-success btn-xs btn-block" wire:click="payMenu('{{ $item->FNO_D_PESAN }}')">
                  <i class="fa fa-check"></i> Bayar Satuan
								</button>
							@else
								<button class="btn btn-outline-secondary btn-xs btn-block">
									<i class="fa fa-times"></i> No Action
								</button>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
