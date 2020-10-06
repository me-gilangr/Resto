<div>
	<div class="row pr-3 pl-3">
		<div class="col-5">
			<div class="form-group" wire:ignore>
				<label for="">Kode Group : <span class="text-danger">*</span></label>
				<select name="FK_GROUP" id="FK_GROUP" class="select2 form-control" data-placeholder="Pilih Kode Group..." style="width: 100%;" required>
					<option value=""></option>
					@foreach ($kodeGroup as $item)
						<option value="{{ $item->FK_GROUP }}">{{ $item->FK_GROUP }} - {{ $item->FN_GROUP }} </option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-7">
			<div class="form-group" wire:ignore>
				<label for="">Kategori : <span class="text-danger">*</span></label>
				<select name="FNO_KATEGORI" id="FNO_KATEGORI" class="select2 form-control" style="width: 100%;" data-placeholder="Pilih Kategori..." disabled required>
					<option value=""></option>
				</select>
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<label for="">Kode Menu : <span class="text-danger">*</span></label>
				<div class="input-group-prepend">
					<span class="input-group-text borad-0 kodeDepan" wire:ignore>KODE GROUP - KATEGORI</span>
					<input type="text" wire:model.lazy="FNO_H_MENU" name="FNO_H_MENU" id="FNO_H_MENU" class="form-control borad-0 {{ $errors->has('FNO_H_MENU') ? 'is-invalid':'' }}" placeholder="Masukan Kode Menu..." minlength="2" maxlength="2" required>
				</div>
				<span class="text-danger">
					{{ $errors->first('FNO_H_MENU') }}
				</span>
			</div>
		</div>
	</div>
</div>

@push('script')
<script>
	$(document).ready(function() {
		function updateSpan() {
			if (FK_GROUP !== '' && FNO_KATEGORI !== '') {
				$('.kodeDepan').text(FNO_KATEGORI);
			} else {
				$('.kodeDepan').text('KODE GROUP - KATEGORI');
			}
		}

		$('#FK_GROUP').on('change', function() {
			@this.set('FNO_KATEGORI', '');
			FK_GROUP = $(this).val();
			FNO_KATEGORI = '';
			$('#FNO_H_MENU').val('');
			updateSpan();
			$("#FNO_KATEGORI").prop('disabled', true);
			$.ajax({
				url: "{{ route('json.kategori') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					FK_GROUP : FK_GROUP,
				},
				success: function(data) {
					@this.set('FK_GROUP', FK_GROUP);
					$('#FNO_KATEGORI').empty();
					$('#FNO_KATEGORI').append(`
						<option value="">== Pilih ==</option>
					`);
					data.forEach(item => {
						updateSpan();
						$('#FNO_KATEGORI').append(`
							<option value="${item.FNO_KATEGORI}">${item.FNO_KATEGORI} - ${item.FN_KATEGORI}</option>
						`);
					});
					$("#FNO_KATEGORI").prop('disabled', false);
				}
			});
		});

		$('#FNO_KATEGORI').on('change', function() {
			$('#FNO_H_MENU').val('');
			FNO_KATEGORI = $(this).val();
			@this.set('FNO_KATEGORI', FNO_KATEGORI);
			updateSpan();
		});
	});
</script>
@endpush