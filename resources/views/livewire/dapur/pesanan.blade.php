<div>
	<div class="row">
		@if ($data_pesanan != null)
			@foreach ($data_pesanan as $value)
				<div class="col-12">
					<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fa fa-utensils"></i></span>
						<div class="info-box-content">
							<span class="info-box-text"><h4>{{ print_r($value['menu']) }}</h4></span>
							<table>
								<tr>
									<td><b>Jumlah</b></td>
									<td>:</td>
									<td>3 Item</td>
								</tr>
								<tr>
									<td><b>Keterangan</b></td>
									<td>:</td>
									<td>Tidak Ada Keterangan.</td>
								</tr>
								<tr>
									<td colspan="3" class="pb-2"><b>Data Masakan &ensp; : </b></td>
								</tr>
								<tr>
									<td class="p-2" colspan="3" style="border: 1px solid #000000;"><b><u>Nasi Goreng Spesial</u> <small class="badge badge-success float-right"><i class="fa fa-utensils"></i> &ensp; 3 Item</small></b></td>
								</tr>
							</table>
						</div>
						<span class="info-box-number">Meja : P01</span>
					</div>
					<button class="btn btn-danger btn-sm btn-block" wire:click="getPesanan()">
						GET PESANAN
					</button>
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
