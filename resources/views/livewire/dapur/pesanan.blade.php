<div>
	<div class="row">
		<div class="col-12">
			<button class="btn btn-info btn-block" wire:click="getPemasakan()">PEMASAKANNN</button>
		</div>
		@if ($data_pesanan != null)
			@foreach ($data_pesanan as $value)
				<div class="col-12">
					<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fa fa-utensils"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">
								<h4>
									{{ $value['menu']['header']['FN_MENU'] }}
									<div class="float-right">
										@php
											$count = count($value['header']['meja']);
											$cm = 0;
										@endphp
										@foreach ($value['header']['meja'] as $value3)
											@php
												$cm += 1;
											@endphp
											<u>{{ $value3['FNO_MEJA'] }}{{ $cm != $count ? ', ':'' }}</u>
										@endforeach
									</div>
								</h4>
							</span>
							<table>
								<tr>
									<td><b>Jumlah</b></td>
									<td>:</td>
									<td>{{ $value['FJML'] }} Item</td>
								</tr>
								<tr>
									<td><b>Keterangan</b></td>
									<td>:</td>
									<td>{{ $value['FKET'] != '' ? $value['FKET'] : '-' }}</td>
								</tr>
								<tr>
									<td colspan="3" class="pb-2"><b>Data Masakan &ensp; : </b></td>
								</tr>
								@foreach ($value['menu']['produk'] as $value2)
								<tr>
									<td class="p-2" colspan="3" style="border: 1px solid #000000;"><b><u>{{ $value2['FN_NAMA'] }}</u> <small class="badge badge-success float-right"><i class="fa fa-utensils"></i> &ensp; {{ $value['FJML'] }} Item</small></b></td>
								</tr>
								@endforeach
								<tr>
									<td colspan="3" class="pt-2">
										<button class="btn btn-success btn-sm btn-block" style="border-radius: 0;" wire:click="ambilPesanan('{{ $value['FNO_PESAN'] }}', '{{ $value['FNO_H_MENU'] }}')">
											Ambil Pesanan
										</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>

@push('script')
<script>
	document.addEventListener('livewire:load', function(event) {
		window.livewire.emit('get_pesanan');
	});
</script>
@endpush
