<div>
	<ul class="list-group" style="border-radius: 0px;">
		@foreach ($data_pemasakan as $item)
		<li class="list-group-item">
			<div class="row">
				<div class="col-12 d-flex justify-content-between align-items-center">
					{{ $loop->iteration }}. &ensp;
					Menu 
					{{ $item->menuHeader->FN_MENU }}

					<span class="badge badge-info pl-2 pr-2 text-md float-right">{{ $item->pesananDetail->FJML }} &ensp; Porsi</span>
				</div>
				<div class="col-12">
					<ul>
						@foreach ($item->detail as $item3)
							<li>
								{{ $item3->produk->FN_NAMA }}
								&ensp; || &ensp;
								{{ $item->pesananDetail->FJML }} Porsi
							</li>
						@endforeach
					</ul>
				</div>
				<div class="col-6">
					Atas Nama : {{ $item->pesananHeader->FATAS_NAMA }}
				</div>
				<div class="col-6 text-right">
					Meja &ensp; : &ensp; 
					@foreach ($item->pesananHeader->meja as $item2)
					<b>
						{{ $item2->FNO_MEJA }} 
					</b>
					@endforeach
				</div>
			</div>
		</li>
		@endforeach
	</ul>
</div>

@push('script')
<script>
	document.addEventListener('livewire:load', function(event) {
		window.livewire.emit('get_pemasakan');
	});
</script>
@endpush