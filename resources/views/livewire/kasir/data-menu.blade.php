<div>

  <h6 class="text-center pb-2">Data Menu Pesanan</h6>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Nama Menu</th>
          <th>Jml</th>
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
            <td>{{ $item->FJML }}</td>
            <td>Rp. {{ number_format($item->FHARGA, 0, ',', '.') }}</td>
            <td>Rp. {{ number_format($item->FHARGA * $item->FJML, 0, ',', '.') }}</td>
            <td>
              @switch($item->FSTATUS_PESAN)
                @case(1)
                  <button class="btn btn-outline-secondary btn-xs">
                    Menunggu Konfirmasi
                  </button>
                    @break
                @case(2)
                  <button class="btn btn-outline-info btn-xs">
                    Antrian Pesanan Dapur / Bar
                  </button>
                    @break
                @case(3)
                  <button class="btn btn-outline-warning btn-xs">
                    Sedang di-Masak / di-Buat
                  </button>
                    @break
                @case(4)
                  <button class="btn btn-outline-success btn-xs">
                    Selesai di-Buat
                  </button>
                    @break
                @case(5)
                  <button class="btn btn-outline-success btn-xs">
                    Pesanan di-Antar
                  </button>
                    @break
                @case(6)
                  <button class="btn btn-outline-success btn-xs">
                    Menunggu Pembayaran
                  </button>
                    @break
                @case(7)
                  <button class="btn btn-outline-primary btn-xs">
                    Sudah di-Bayar
                  </button>
                    @break
                @default
                  <button class="btn btn-outline-secondary btn-xs">
                    No Status
                  </button>
              @endswitch
            </td>
            <td>
              @if ($item->FSTATUS_PESAN == '6')
                <button class="btn btn-success btn-xs" wire:click="payMenu('{{ $item->FNO_D_PESAN }}')">
                  <i class="fa fa-check"></i> Bayar Satuan
                </button>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
