<div>
	@php
		// SELECT C.FNO_D_PESAN,E.FN_MENU, A.FNO_PRODUK,B.FN_NAMA,A.FJML
		// FROM t10_d_pemasakan AS A INNER JOIN t00_m_produk AS B
		// ON A.FNO_PRODUK=B.FNO_PRODUK
		// INNER JOIN t10_h_pemasakan as C
		// ON C.FNO_H_PEMASAKAN=A.FNO_H_PEMASAKAN
		// INNER JOIN t10_d_pesanan AS D
		// ON D.FNO_D_PESAN=C.FNO_D_PESAN
		// INNER JOIN t00_h_menu AS E
		// ON E.FNO_H_MENU=D.FNO_H_MENU
	@endphp	
	<ul class="list-group" style="border-radius: 0px;">
		@foreach ($data_pemasakan as $item)
			@foreach ($item->detail as $itemx)
				@foreach ($itemx->produk->groupBuat as $itemxx)
					@if ($itemxx->FTEMPAT == 'B' && $itemx->FSTATUS == 0)
						<li class="list-group-item" style="border-top: 1px solid #000000b3;">
							<div class="row">
								<div class="col-12 d-flex justify-content-between align-items-center">
									{{ $loop->iteration }}. &ensp;
									Menu 
									{{ $item->pesananDetail->menuHeader->FN_MENU }}

									<span class="badge badge-info pl-2 pr-2 text-md float-right">{{ $item->pesananDetail->FJML }} &ensp; Porsi</span>
								</div>
								<div class="col-12">
									<ul>
										@forelse ($item->detail as $item3)
											@foreach ($item3->produk->groupBuat as $item4)
												@if ($item4->FTEMPAT == 'B')
													<li>
														{{ $item3->produk->FN_NAMA }}
														&ensp; || &ensp;
														{{ $item->pesananDetail->FJML }} Porsi
													</li>
												@endif
												@endforeach
										@empty
											<li>
												Belum Ada Daftar Yang Akan di-Masak.
											</li>
										@endforelse
									</ul>
								</div>
								<div class="col-6">
									Atas Nama : {{ $item->pesananDetail->header->FATAS_NAMA }}
								</div>
								<div class="col-6 text-right">
									Meja &ensp; : &ensp; 
									@foreach ($item->pesananDetail->header->meja as $item2)
									<b>
										{{ $item2->FNO_MEJA }} 
									</b>
									@endforeach
								</div>
								<div class="col-12 pt-2 pb-2">
									<button class="btn btn-success btn-block btn-sm" style="border-radius: 0px;" wire:click="selesai('{{ $item->FNO_H_PEMASAKAN }}')">
										Selesai
									</button>
								</div>
							</div>
						</li>
					@endif
				@endforeach
			@endforeach
		@endforeach
		<li class="list-group-item" style="border-top: 1px solid #000000b3;">
			<div class="row d-flex justify-content-between align-items-center">
				<div class="col-12 text-center">
					<h5>Data Pemasakan Bagian Bar</h5>
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