<div>
	<form wire:submit.prevent="{{ !$edit ? 'tambah()':'updateData("'.$edit->FNO_PRODUK.'")' }}">	
		<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalCreateLabel">
							{{ !$edit ? 'Form Tambah Produk':'Form Edit Produk' }}
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								@if ($edit != false)
								<label for="">Kategori Produk <span class="text-danger">*</span></label>
								<input type="text" wire:model.lazy="FN_KATEGORI" name="FN_KATEGORI" id="FN_KATEGORI" class="form-control borad-0 mb-2 {{ $errors->has('FN_KATEGORI') ? 'is-invalid':'' }}" placeholder="Masukan Nama Kategori..." disabled required>
								<span class="invalid-feedback">
									{{ $errors->first('FN_KATEGORI') }}
								</span>
								@else
								<div class="form-group" wire:ignore>
									<label for="">Kategori Produk : <span class="text-danger">*</span></label>
									<select wire:model="FNO_KATEGORI" name="FNO_KATEGORI" id="FNO_KATEGORI" class="form-control {{ $errors->has('FNO_KATEGORI') ? 'is-invalid':'' }}" required>
										<option value="">-- Pilih Kategori --</option>
										@foreach ($kategori as $item)
											<option value="{{ $item->FNO_KATEGORI }}" {{ $item->FNO_KATEGORI == $FNO_KATEGORI ? 'selected':'' }}>{{ $item->FN_KATEGORI }}</option>
										@endforeach
									</select>
									<span class="text-danger">
										{{ $errors->first('FNO_KATEGORI') }}
									</span>
								</div>
								@endif								
								<div class="form-group">
									<label for="">Kode Produk : <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text borad-0">{{ $FNO_KATEGORI !== '' ? $FNO_KATEGORI:'SILAHKAN PILIH KATEGORI' }}</span>
										</div>
										<input type="text" wire:model.lazy="FNO_PRODUK" name="FNO_PRODUK" id="FNO_PRODUK" class="form-control borad-0 {{ $errors->has('FNO_PRODUK') ? 'is-invalid':'' }}" placeholder="Masukan Kode Produk..." minlength="3" maxlength="3" {{ !$edit ? 'autofocus':'disabled' }} required>
										<span class="invalid-feedback">
											{{ $errors->first('FNO_PRODUK') }}
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="">Nama Produk : <span class="text-danger">*</span></label>
									<input type="text" wire:model.lazy="FN_NAMA" name="FN_NAMA" id="FN_NAMA" class="form-control borad-0 {{ $errors->has('FN_NAMA') ? 'is-invalid':'' }}" placeholder="Masukan Nama Produk..." maxlength="50" autofocus required>
									<span class="invalid-feedback">
										{{ $errors->first('FN_NAMA') }}
									</span>
								</div>
								<div class="form-group row">
									<label class="col-12">Area Pembuatan : <span class="text-danger">*</span></label>
									<div class="col-md-6 col-lg-6 col-xl-6  pl-2 pr-2">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" wire:model="DAPUR" name="area" id="Dapur" value="D">
											<label for="Dapur" class="custom-control-label">Area Dapur</label>
										</div>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-6  pl-2 pr-2">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" wire:model="BAR" name="area" id="Bar" value="B">
											<label for="Bar" class="custom-control-label">Area Bar</label>
										</div>
									</div>
									<div class="col-12">
										<span class="text-danger">
											{{ $err_area }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">
							{{ !$edit ? 'Tambah Data':'Simpan Perubahan' }}
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

@push('script')
<script>
	$(document).ready(function() {
		window.livewire.on('tutupModal', function(){
			$('#modalCreate').modal('hide');
		});

		window.livewire.on('bukaModal', function(){
			$('#modalCreate').modal('show');
		});

		$('#modalCreate').on('hidden.bs.modal', function (e) {
			window.livewire.emit('editFalse');
		})
		
		$('#modalCreate').on('shown.bs.modal', function(e) {
      $('input:text:visible:first', this).focus();
    });
	});
</script>
@endpush