<div>
	<div class="row">
		@forelse ($data_pesanan as $item)
		<div class="col-12">
			<div class="info-box">
				<span class="info-box-icon bg-info"><i class="fa fa-utensils"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">
						<h4>
							{{ $item->header->pesananDetail->menuHeader->FN_MENU }}
							<div class="float-right">
								@php
									$count = count($item->header->pesananDetail->header->meja);
									$cm = 0;
								@endphp
								@foreach ($item->header->pesananDetail->header->meja as $item2)
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
							<td>{{ $item->header->pesananDetail->FKET != '' ? $item->header->pesananDetail->FKET : '-' }}</td>
						</tr>
						<tr>
							<td colspan="3" class="pb-2"><b>Data Masakan &ensp; : </b></td>
						</tr>
						@if ($item->FTEMPAT == 'B')
							<tr>
								<td class="p-2" colspan="3" style="border: 1px solid #000000;"><b><u>{{ $item->produk->FN_NAMA }}</u> <small class="badge badge-success float-right"><i class="fa fa-utensils"></i> &ensp; {{ $item->FJML }} Porsi</small></b></td>
							</tr>
						@endif
						<tr>
							<td colspan="3" class="pt-2">
								<button class="btn btn-success btn-sm btn-block" style="border-radius: 0;" wire:click="ambilPesanan('{{ $item->FNO_D_PEMASAKAN }}')">
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
