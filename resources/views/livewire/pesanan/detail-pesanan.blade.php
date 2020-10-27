<div>
	<div wire:ignore.self class="modal fade" id="modalTransaksi" tabindex="-1" aria-labelledby="modalTransaksiLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTransaksiLabel">
						<i class="fa fa-shopping-basket text-danger"></i> 
						&ensp; 
						Pesanan Meja : 
						@if (!empty($data_detail))
							@php
								$count = count($data_detail->meja);
								$cm = 0;
							@endphp
							@foreach ($data_detail->meja as $item)
								@php
									$cm += 1;
								@endphp
								<u>{{ $item->FNO_MEJA }}{{ $cm != $count ? ', ':'' }}</u>
							@endforeach
						@endif
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-0 text-sm">
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<th class="pl-3" style="white-space: nowrap;">Nama Menu</th>
									<th class="text-center">Jumlah</th> 
									<th class="text-center">Status</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@if (!empty($data_detail))
									@foreach ($data_detail->detail as $item)
										<tr>
											<td class="pl-3" style="white-space: nowrap;">
												{{ $item->menuHeader->FN_MENU }} <br>
												<span class="badge badge-primary badge-pill">Rp. {{ number_format($item->FHARGA, 0, ',' ,'.') }}</span> 
											</td>
											<td class="text-center">
												1 Item <br>
												<span class="badge badge-success badge-pill">Sub Total : Rp. {{ number_format($item->FHARGA * $item->FJML, 0, ',' ,'.') }}</span> 
											</td> 
											<td class="text-center" style="vertical-align: inherit; white-space: nowrap;">
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
																Pesanan Selesai
															</button>
																@break
														@default
															<button class="btn btn-outline-secondary btn-xs">
																No Status
															</button>
												@endswitch

											</td>
											<td class="text-center" style="vertical-align: inherit; white-space: nowrap;">
												@switch($item->FSTATUS_PESAN)
														@case(1)
															<button class="btn btn-outline-success btn-xs">
																Konfirmasi
															</button>
															<button class="btn btn-outline-danger btn-xs">
																Tolak
															</button>
																@break
														@case(4)
															<button class="btn btn-outline-info btn-xs antar" data-id="{{ $item->FNO_D_PESAN }}">
																Antarkan Pesanan
															</button>
																@break
														@case(5)
															<button class="btn btn-outline-primary btn-xs selesai" data-id="{{ $item->FNO_D_PESAN }}">
																Selesai
															</button>
															<button class="btn btn-outline-danger btn-xs komplain" data-id="{{ $item->FNO_D_PESAN }}">
																Komplain
															</button>
																@break
														@default
															<button class="btn btn-outline-secondary btn-xs">
																No Action
															</button>
												@endswitch
											</td>
										</tr>
									@endforeach
								@endif
								{{-- <tr>
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
								</tr> --}}
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3" class="text-right"><b>Total &ensp; : </b></td>
									<td class="text-center">
										<b>
											Rp. 
											@if (!empty($data_detail))
												{{ number_format($data_detail->detail->sum('FHARGA'), 0, ',', '.') }}
											@endif
										</b>
									</td>
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
</div>

@push('script')
<script>
	$(document).ready(function() {
		window.livewire.on('bukaModal', function() {
			$('#modalTransaksi').modal('show');
		});

		$('#modalTransaksi').on('click', '.antar', function() {
			var id = $(this).data('id');
			window.livewire.emit('do_antar', id);
		});
		

		$('#modalTransaksi').on('click', '.selesai', function() {
			var id = $(this).data('id');
			window.livewire.emit('do_selesai', id);
		});
	});
</script>
@endpush