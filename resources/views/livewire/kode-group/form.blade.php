<div>
	<form wire:submit.prevent="{{ !$edit ? 'tambah()':'updateData("'.$edit->FK_GROUP.'")' }}">	
		<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalCreateLabel">
							{{ !$edit ? 'Form Tambah Group':'Form Edit Group' }}
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="">Kode Group : <span class="text-danger">*</span></label>
									<input type="text" wire:model.lazy="FK_GROUP" name="FK_GROUP" id="FK_GROUP" class="form-control borad-0 {{ $errors->has('FK_GROUP') ? 'is-invalid':'' }}" placeholder="Masukan Kode Group..." minlength="1" maxlength="1" {{ !$edit ? 'autofocus':'disabled' }} required>
									<span class="invalid-feedback">
										{{ $errors->first('FK_GROUP') }}
									</span>
								</div>
								<div class="form-group">
									<label for="">Nama Group : <span class="text-danger">*</span></label>
									<input type="text" wire:model.lazy="FN_GROUP" name="FN_GROUP" id="FN_GROUP" class="form-control borad-0 {{ $errors->has('FN_GROUP') ? 'is-invalid':'' }}" placeholder="Masukan Nama Group..." maxlength="20" autofocus required>
									<span class="invalid-feedback">
										{{ $errors->first('FN_GROUP') }}
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