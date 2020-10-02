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
								<div class="form-group" wire:ignore>
									<label for="">Kategori Produk : <span class="text-danger">*</span></label>
									@if (!$edit)
										<select wire:model="FNO_KATEGORI" name="FNO_KATEGORI" id="FNO_KATEGORI" class="form-control {{ $errors->has('FNO_KATEGORI') ? 'is-invalid':'' }}" required>
											<option value="">-- Pilih Kategori --</option>
											@foreach ($kategori as $item)
												<option value="{{ $item->FNO_KATEGORI }}" {{ $item->FNO_KATEGORI == $FNO_KATEGORI ? 'selected':'' }}>{{ $item->FN_KATEGORI }}</option>
											@endforeach
										</select>
									@else
										<input type="text" wire:model.lazy="FN_KATEGORI" name="FN_KATEGORI" id="FN_KATEGORI" class="form-control borad-0 {{ $errors->has('FN_KATEGORI') ? 'is-invalid':'' }}" placeholder="Masukan Nama Kategori..." disabled required>
										<span class="invalid-feedback">
											{{ $errors->first('FN_KATEGORI') }}
										</span>
									@endif
									<span class="invalid-feedback">
										{{ $errors->first('FNO_KATEGORI') }}
									</span>
								</div>								
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
									<input type="text" wire:model.lazy="FN_NAMA" name="FN_NAMA" id="FN_NAMA" class="form-control borad-0 {{ $errors->has('FN_NAMA') ? 'is-invalid':'' }}" placeholder="Masukan Nama Produk..." maxlength="20" autofocus required>
									<span class="invalid-feedback">
										{{ $errors->first('FN_NAMA') }}
									</span>
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