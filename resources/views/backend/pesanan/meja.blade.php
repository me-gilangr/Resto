@extends('backend.layouts.master')

@section('content')
<div class="row">
	<div class="col-12 text-center">
		<h5 style="font-weight: 600; text-shadow: 1px 1px #ffffff;">Daftar Pesanan & Meja</h5>
		<hr>
	</div>
</div>
<div class="row">
	@foreach ($pesanan as $item)
	<div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
    <div class="card card-success">
      <div class="card-header">

      </div>
      <div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
				<h4 style="float: none !important;">
					@php
						$count = count($item);
						$cm = 0;
					@endphp
					@foreach ($item as $item2)
						@php
							$cm += 1;
						@endphp
						{{ $item2->FNO_MEJA }} {{ $cm != $count ? '|':'' }}
					@endforeach
				</h4>
        <p class="card-text m-0">{{ count($item[0]->header->detail) }} Menu</p>
        <p class="card-text">{{ $item[0]->header->FATAS_NAMA }}</p>
        <button href="#" class="btn btn-xs btn-block btn-outline-info detail" data-id="{{ $item[0]->FNO_H_PESAN }}">Total : Rp. <u>{{ number_format($item[0]->header->detail->sum('FHARGA')) }}</u></button>
      </div>
    </div>
  </div> 
	@endforeach
	@foreach ($meja as $item)
		@if ($item->pesanan == null)
			<div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<div class="card card-danger">
					<div class="card-header">
						
					</div>
					<div class="card-body text-center" style="min-height: 170px; max-height: 170px; overflow: auto;">
						<h4 style="float: none !important;">{{ $item->FNO_MEJA }}</h4>
						<p class="card-text">Tidak Ada Transaksi</p>
						<a href="#" class="btn btn-xs btn-block btn-outline-info">Total : Rp. 0</a>
					</div>
				</div>
			</div> 
		@endif
	@endforeach
  {{-- <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-xs-6">
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
  </div>  --}}
</div>

@livewire('pesanan.detail-pesanan')
@endsection

@push('script')
<script>
	$(document).ready(function() {
		$('.detail').on('click', function() {
			var id = $(this).data('id');
			window.livewire.emit('get_detail', id);
			// $('#modalTransaksi').modal('show');
		});
	});
</script>
@endpush