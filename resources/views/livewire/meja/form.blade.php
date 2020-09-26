<div>
	<form wire:submit.prevent="{{ !$edit ? 'tambah()':'updateData("'.$edit->FK_SATUAN.'")' }}">	
		<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalCreateLabel">
							{{ !$edit ? 'Form Tambah Meja':'Form Edit Meja' }}
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="">Nomor Meja : <span class="text-danger">*</span></label>
									<input type="text" wire:model.lazy="FNO_MEJA" name="FNO_MEJA" id="FNO_MEJA" class="form-control borad-0 {{ $errors->has('FNO_MEJA') ? 'is-invalid':'' }}" placeholder="Masukan Nomor Meja..." maxlength="3" autofocus required>
									<span class="invalid-feedback">
										{{ $errors->first('FNO_MEJA') }}
									</span>
								</div>
								<div class="form-group">
									<label for="">Jenis Meja : <span class="text-danger">*</span></label>
									<input type="text" wire:model.lazy="FJENIS" name="FJENIS" id="FJENIS" class="form-control borad-0 {{ $errors->has('FJENIS') ? 'is-invalid':'' }}" placeholder="Masukan Jenis Meja..." maxlength="20" autofocus required>
									<span class="invalid-feedback">
										{{ $errors->first('FJENIS') }}
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
