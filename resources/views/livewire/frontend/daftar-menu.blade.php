<div>
	<div class="row">
		@foreach ($menu as $item)
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="card">
				<div class="card-body">
					{{-- <span style="
						border: 1px solid rgb(202 202 202 / 77%); 
						background-color: #f3f3f3; 
						border-radius: .25rem; 
						padding: 2px 24px; 
						font-family: revert; 
						font-weight: 500; 
						font-size: 14px;
					">
						{{ $item->FN_KATEGORI }}
					</span> --}}
					<div class="card" style="width: 100%; margin-bottom: 0px;">
						<div class="card-img-top" wire:click="test('{{ $item->FNO_H_MENU }}')">
							<div class="image-preview" id="imagePreview">
								<img src="{{ asset('images/Menu/'.$item->FGAMBAR) }}" alt="Image Preview" class="image-preview__image" style="max-height: 300px;">
							</div>
						</div>
						<div class="card-body" style="
							border: 1px solid rgb(0 0 0 / 16%);
							border-bottom-left-radius: 0px; 
							border-bottom-right-radius: 0px;
							padding: 10px 15px 10px 15px;
						">
							<p class="card-text mb-1" style="
								max-height: 80px;
								overflow: auto;
								font-size: 14px;
							">{{ $item->FN_MENU }}</p>
							<p class="card-text mb-1" style="
								font-size: 12px;
								font-weight: 600;
							">{{ 'Rp. '.number_format($item->FHARGAJUAL, 0, ',', '.') }}</p>
							<hr class="mb-2 mt-1">
							<button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
								<i class="fa fa-shopping-cart"></i> &ensp; Masukan Daftar Pesan
							</button>
						</div>
					</div>
				</div>
			</div>
			
			{{-- <div class="info-box pr-3 pl-3 pt-0 pb-0" style="border-radius: 10px !important;">
				<span class="info-box-icon text-secondary"><i class="fa fa-utensils"></i></span>
	
				<div class="info-box-content pt-0 pr-0">
					<span class="info-box-text text-center">Daftar Makanan</span>
					<div class="progress">
						<div class="progress-bar bg-secondary" style="width: 100%"></div>
					</div> 
				</div>
			</div> --}}
		</div>
		@endforeach
	</div>
	
	<div class="modal fade" wire:ignore.self id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalDetailLabel">
						Detail Menu
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<ul class="list-group">
								<li class="list-group-item">
									<div class="d-block d-md-none d-lg-none d-xl-none">
										<div class="image-preview" id="imagePreview">
											<img src="{{ $detail['FGAMBAR'] != null ? asset('images/Menu/'.$detail['FGAMBAR']):asset('images/Menu/no-image.png') }}" alt="Image Preview" class="image-preview__image" style="max-height: 300px;">
										</div>
									</div>
									<div class="d-none d-md-block d-lg-block d-xl-block">
										<div class="image-preview" id="imagePreview" style="height: 200px; width: 250px;">
											<img src="{{ $detail['FGAMBAR'] != null ? asset('images/Menu/'.$detail['FGAMBAR']):asset('images/Menu/no-image.png') }}" alt="Image Preview" class="image-preview__image" style="max-height: 2ool;">
										</div>
									</div>
								</li>
								<li class="list-group-item text-center" style="border-bottom: 0px;"><h5 class="bold">{{ $detail['FN_MENU'] }}</h5></li>
								<li class="list-group-item text-center" style="border-top: 0px;">
									<div class="row">
										<div class="col-6">
											<b>Harga &ensp; : </b>
										</div>
										<div class="col-6">
											<b>{{ 'Rp. ' . number_format($detail['FHARGAJUAL'], 0, ',', '.') }}</b>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group row">
						<label class="col-5 col-form-label justify-content-center col-form-label-sm">Jumlah Pesan &ensp; : </label>
						<div class="col-7 justify-content-center">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text d-flex justify-content-center" id="basic-addon1" style="
										background-color: #ff0404;
										color: #ffffff;
									" wire:click="minus()">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<input type="number" wire:model="jml" class="form-control" min="1" style="text-align: center;" required>
								<div class="input-group-append">
									<span class="input-group-text d-flex justify-content-center" id="basic-addon2" style="
										background-color: #04ff32;
										color: #ffffff;
									" wire:click="plus()">
										<i class="fa fa-plus"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 mt-2">
							<label for="">Keterangan : <small class="text-secondary">* Opsional</small></label>
						</div>
						<div class="col-12">
							<textarea wire:model="ket" rows="1" class="form-control" placeholder="*Boleh di-Kosongkan"></textarea>
						</div>
					</div>
					<button class="btn btn-outline-success btn-block pr-2 pl-2" wire:click="addCart('{{ $detail['FNO_H_MENU'] }}')">
						<i class="fa fa-shopping-cart"></i> &ensp; Masukan Daftar Pesan
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

@push('script')
<script>
	$(document).ready(function() {
		window.livewire.on('tutupModal', function(){
			$('#modalDetail').modal('hide');
		});

		window.livewire.on('bukaModal', function(){
			$('#modalDetail').modal('show');
		});
	});
</script>
@endpush
