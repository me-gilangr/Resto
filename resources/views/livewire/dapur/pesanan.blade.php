<div>
	<div class="row">
		@forelse ($data_pesanan as $item)
		<div class="col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fa fa-utensils"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">
						<h4>
							{{ $item->menuHeader->FN_MENU }}
							<div class="float-right">
								@php
									$count = count($item->header->meja);
									$cm = 0;
								@endphp
								@foreach ($item->header->meja as $item2)
									@php
										$cm += 1;
									@endphp
									<u>{{ $item2->FNO_MEJA }}{{ $cm != $count ? ', ':'' }}</u>
								@endforeach
							</div>
						</h4>
					</span>
					<table>
						<tr>
							<td><b>Jumlah</b></td>
							<td>:</td>
							<td>{{ $item->FJML }} Item</td>
						</tr>
						<tr>
							<td><b>Keterangan</b></td>
							<td>:</td>
							<td>{{ $item->FKET != '' ? $item->FKET : '-' }}</td>
						</tr>
						<tr>
							<td colspan="3" class="pb-2"><b>Data Masakan &ensp; : </b></td>
						</tr>
						@foreach ($item->menuDetail as $item2)
							@foreach ($item2->produk->groupBuat as $item3)
								@if ($item3->FTEMPAT == 'D')
								<tr>
									<td class="p-2" colspan="3" style="border: 1px solid #000000;"><b><u>{{ $item2->produk->FN_NAMA }}</u> <small class="badge badge-success float-right"><i class="fa fa-utensils"></i> &ensp; {{ $item->FJML }} Porsi</small></b></td>
								</tr>
								@endif
							@endforeach
						@endforeach
						<tr>
							<td colspan="3" class="pt-2">
								<button class="btn btn-success btn-sm btn-block" style="border-radius: 0;" wire:click="ambilPesanan('{{ $item->FNO_D_PESAN }}', '{{ $item->FNO_H_PESAN }}', '{{ $item->FNO_H_MENU }}')">
									Ambil Pesanan
								</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		@empty
			<div class="col-12">
				<h5 class="text-center">Belum Ada Pesanan.</h5>
			</div>
		@endforelse
	</div>
</div>

@push('script')
<script>
	document.addEventListener('livewire:load', function(event) {
		window.livewire.emit('get_pesanan');
	});

	function getData() {
		window.livewire.emit('get_pesanan');
		console.log('getData');
		setTimeout(getData, 10000);
	}

	getData();

</script>
@endpush
