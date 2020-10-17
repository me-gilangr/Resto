<div>
	<ul class="list-group" style="border-radius: 0px;">
		@foreach ($data_pemasakan as $item) 
			@if ($item->FTEMPAT == 'B' && $item->FSTATUS == 0)
				<li class="list-group-item" style="border-top: 1px solid #000000b3;">
					<div class="row">
						<div class="col-12 d-flex justify-content-between align-items-center">
							{{ $loop->iteration }}. &ensp;
							Menu 
							{{ $item->header->pesananDetail->menuHeader->FN_MENU }}

							<span class="badge badge-info pl-2 pr-2 text-md float-right">{{ $item->header->pesananDetail->FJML }} &ensp; Porsi</span>
						</div>
						<div class="col-12">
							<ul>
								@if ($item->FTEMPAT == 'B')
									<li>
										{{ $item->produk->FN_NAMA }}
										&ensp; || &ensp;
										{{ $item->FJML }} Porsi
									</li>
								@endif
							</ul>
						</div>
						<div class="col-6">
							Atas Nama : {{ $item->header->pesananDetail->header->FATAS_NAMA }}
						</div>
						<div class="col-6 text-right">
							Meja &ensp; : &ensp; 
							@foreach ($item->header->pesananDetail->header->meja as $item2)
							<b>
								{{ $item2->FNO_MEJA }} 
							</b>
							@endforeach
						</div>
						<div class="col-12 pt-2 pb-2">
							<button class="btn btn-info btn-block btn-sm" style="border-radius: 0px;" wire:click="selesai('{{ $item->FNO_D_PEMASAKAN }}', '{{ $item->header->FNO_D_PESAN }}')">
								Selesai
							</button>
						</div>
					</div>
				</li>
			@endif 
		@endforeach
		<li class="list-group-item" style="border-top: 1px solid #000000b3;">
			<div class="row d-flex justify-content-between align-items-center">
				<div class="col-12 text-center">
					<h5>Data Pembuatan Bagian Bar</h5>
				</div>
			</div>
		</li>
	</ul>
</div>

@push('script')
<script>
	document.addEventListener('livewire:load', function(event) {
		window.livewire.emit('get_pemasakan');
	});

	
	function getData() {
		window.livewire.emit('get_pemasakan');
		setTimeout(getData, 10000);
	}
	getData();
	
</script>
@endpush