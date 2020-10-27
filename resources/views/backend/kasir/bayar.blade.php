@extends('backend.layouts.master-top')

@section('content')
<style>
  .bayar .table td, .bayar .table th {
    padding-top: 8px !important;
    padding-bottom: 8px !important;
    padding-left: 5px !important;
    padding-right: 5px !important;
    border-top: 0px;
  }
</style>
<div class="row">
	<div class="col-md-7 col-lg-7">
		<div class="card card-success card-outline">
			<div class="card-header">
				<h4 class="card-title"><span class="fa fa-info text-success"></span> &ensp; Detail Pesanan</h4>
				<div class="card-tools">
					<h6>Kasir : <span class="badge badge-info">{{ auth()->user()->name }}</span></h6>
				</div>
			</div>
			<div class="card-body pt-2 p-0">
				<div class="table-responsive">
					<table class="table mb-0">
						<tr>
							<td><h6>Kode Pesanan</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ $pesanan->FNO_H_PESAN }}</h6></td>
							<td><h6></h6></td>
							<td><h6>Tanggal Pesanan</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ date('d/m/Y', strtotime($pesanan->TGL_PESAN)) }}</h6></td>
						</tr>
						<tr>
							<td><h6>Atas Nama</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ $pesanan->FATAS_NAMA }}</h6></td>
							<td><h6></h6></td>
							<td><h6>Meja</h6></td>
							<td><h6>:</h6></td>
							<td>
								<h6>
									@php
										$count = count($pesanan->meja);
										$cm = 0;
									@endphp
									@foreach ($pesanan->meja as $item)
										@php
											$cm += 1;
										@endphp
										<u>{{ $item->FNO_MEJA }}{{ $cm != $count ? ', ':'' }}</u>
									@endforeach
								</h6>
							</td>
						</tr>
					</table>
        </div>
        <hr>
        @livewire('kasir.data-menu', ['pesanan' => $pesanan])
			</div>
		</div>
	</div>
	<div class="col-md-5 col-lg-5">
		@livewire('kasir.bayar')
	</div>
</div>
@endsection