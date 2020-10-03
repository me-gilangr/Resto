@extends('backend.layouts.master')

@push('css')
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<style>
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			background-color: #ba2121;
			padding: 0px 15px;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
			margin-left: 10px;
			color: #ffffff;
		}

		.image-preview {
			min-height: 300px;
			max-height: 300px;
			border: 2px solid #dddddd;
			margin: 0 auto;
			margin-bottom: 10px !important;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: bold;
			color: #cccccc;
		}

		.image-preview__image {
			display: none;
			width: 100%;
			max-height: 300px;
		}
		
		.image-preview__now {
			display: none;
			width: 100%;
			max-height: 300px;
		}
	</style>
@endpush

@section('content')
<div class="row" style="font-family: system-ui;">
	<div class="col-12">
		<div class="card card-outline card-danger">
			<div class="card-header">
				<h4 class="card-title"><i class="fa fa-edit"></i> &ensp; Form Tambah Data Menu</h4>
				<div class="card-tools">
					<a href="{{ route('menu.index') }}" class="btn btn-sm btn-outline-danger">
						<i class="fa fa-arrow-left"></i> &ensp; Kembali
					</a>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('menu.update', $edit->FNO_H_MENU) }}" method="post" enctype="multipart/form-data">
					@csrf 
					@method('PUT')
					<div class="row">
						<div class="col-md-4 col-lg-4 col-xl-4">
							<h5 class="pl-2"><i class="fa fa-edit text-primary"></i> &ensp; Gambar / Foto Menu</h5>
							<hr>
							<div class="row pr-3 pl-3">
								<div class="col-12">
									<div class="image-preview" id="imagePreview" style="{{ $edit->FGAMBAR != null ? "background-color: #413d3d;":"" }}">
										<img src="{{ $edit->FGAMBAR != null ? asset('images/Menu/'.$edit->FGAMBAR):'' }}" alt="Image Preview" class="image-preview__now" style="{{ $edit->FGAMBAR != null ? 'display:block;':'display:none;' }}">
										<img src="" alt="Image Preview" class="image-preview__image">
										<span class="image-preview__default-text" style="{{ $edit->FGAMBAR != null ? 'display: none;':'display: block;' }}">Klik Untuk Mengupload Gambar</span>
									</div>
									<div class="form-group">
                    <div class="custom-file">
                      <input type="file" name="FGAMBAR" id="FGAMBAR" class="custom-file-input" id="customFile" value="{{ old('FGAMBAR') }}" required>
                      <label class="custom-file-label" for="customFile">Upload Gambar</label>
                    </div>
                  </div>
								</div>
							</div>
						</div>
						<div class="col-md-8 col-lg-8 col-xl-8">
							<h5 class="pl-2"><i class="fa fa-edit text-primary"></i> &ensp; Detail Menu</h5>
							<hr>
							<div class="row pr-3 pl-3">
								<div class="col-12">
									<div class="form-group">
										<label for="">Nama Menu : <span class="text-danger">*</span></label>
										<input type="text" name="FN_MENU" id="FN_MENU" class="form-control borad-0 {{ $errors->has('FN_MENU') ? 'is-invalid':'' }}" placeholder="Masukan Nama Menu..." maxlength="50" value="{{ $edit->FN_MENU }}" autofocus required>
										<span class="invalid-feedback">
											{{ $errors->first('FN_MENU') }}
										</span>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xl-3">
									<div class="form-group">
										<label for="">Harga Pokok : <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text borad-0">Rp. </span>
											</div>
											<input type="number" name="FHARGAPOKOK" id="FHARGAPOKOK" class="form-control borad-0 {{ $errors->has('FHARGAPOKOK') ? 'is-invalid':'' }}" min="1" placeholder="Masukan Harga Pokok..." value="{{ $edit->FHARGAPOKOK }}" required>
											<span class="invalid-feedback">
												{{ $errors->first('FHARGAPOKOK') }}
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-lg-2 col-xl-2">
									<div class="form-group">
										<label for="">Margin : <span class="text-danger">*</span></label>
										<input type="number" name="FMARGIN" id="FMARGIN" class="form-control borad-0 {{ $errors->has('FMARGIN') ? 'is-invalid':'' }}" min="1" value="1.00" step="0.01" placeholder="Masukan Harga Pokok..." value="{{ $edit->FMARGIN }}" required>
										<span class="invalid-feedback">
											{{ $errors->first('FMARGIN') }}
										</span>
									</div>
								</div>
								<div class="col-md-3 col-lg-3 col-xl-3">
									<div class="form-group">
										<label for="">Pajak : <span class="text-danger">*</span></label>
										<input type="number" name="FPAJAK" id="FPAJAK" class="form-control borad-0 {{ $errors->has('FPAJAK') ? 'is-invalid':'' }}" min="0.1" value="0.1" step="0.01" placeholder="Masukan Pajak..." value="{{ $edit->FPAJAK }}" required>
										<span class="invalid-feedback">
											{{ $errors->first('FPAJAK') }}
										</span>
									</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label for="">Harga Jual : <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text borad-0">Rp. </span>
											</div>
											<input type="number" name="FHARGAJUAL" id="FHARGAJUAL" class="form-control disabled borad-0 {{ $errors->has('FHARGAJUAL') ? 'is-invalid':'' }}" min="1" step="0.01" placeholder="0" readonly value="{{ $edit->FHARGAJUAL }}" required>
											<span class="invalid-feedback">
												{{ $errors->first('FHARGAJUAL') }}
											</span>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group {{ $errors->has('produk') ? 'text-danger':'' }}">
										<label for="">Pilih Data Produk : </label>
										<select class="select2" name="produk[]" id="produk" multiple="multiple" data-placeholder="== Pilih Data Produk ==" data-dropdown-css-class="select2-red" style="width: 100%;">
											<option value=""></option>
											@php
												$items = $edit->detail()->pluck('FNO_PRODUK')->toArray();
											@endphp
											@foreach ($produk as $item)
												<option value="{{ $item->FNO_PRODUK }}" {{ in_array($item->FNO_PRODUK, $items) ? 'selected':'' }}>{{ $item->FN_NAMA }}</option>
											@endforeach
										</select>
										<span class="text-danger">
											{{ $errors->first('produk') }}
										</span>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-1">
									<button type="submit" class="btn btn-success btn-block">
										<i class="fa fa-check"></i> &ensp;
											Simpan Perubahan
									</button>
								</div>
								<div class="col-md-6 col-lg-6 col-xl-6 mt-1">
									<button type="reset" class="btn btn-danger btn-block">
										<i class="fa fa-undo"></i> &ensp;
										Reset Input
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script>
	const upload = document.getElementById("FGAMBAR");
	const previewContainer = document.getElementById("imagePreview");
	const previewImage = previewContainer.querySelector(".image-preview__image");
	const previewNow = previewContainer.querySelector(".image-preview__now");
	const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

	upload.addEventListener("change", function() {
		const file = this.files[0];

		// console.log(file);
		if (file) {
			const reader = new FileReader();

			previewDefaultText.style.display = "none";
			previewImage.style.display = "block";
			previewNow.style.display = "none";

			reader.addEventListener("load", function() {
				previewImage.setAttribute("src", this.result);
				previewContainer.style.backgroundColor = "#413d3d";
			});

			reader.readAsDataURL(file);
		} else {
			previewDefaultText.style.display = null;
			previewImage.style.display = null;
			previewImage.style.display = "block";
			previewImage.setAttribute("src", "");
			previewContainer.style.backgroundColor = null;
		}
	});
</script>

<script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
	$(document).ready(function() {
		function hitungHarga() {
			var hargaPokok = $('#FHARGAPOKOK').val();
			var margin = $('#FMARGIN').val();
			var pajak = $('#FPAJAK').val();
			var hargaJual = 0;

			var hitungMargin = (hargaPokok * margin);
			var hitungPajak = (hitungMargin * pajak);
			hargaJual = (hitungMargin + hitungPajak);

			$('#FHARGAJUAL').val(hargaJual);
		}

		$('#FHARGAPOKOK').on('input', function() {
			hitungHarga();
		});

		$('#FMARGIN').on('input', function() {
			hitungHarga();
		});
		
		$('#FPAJAK').on('input', function() {
			hitungHarga();
		});

		$('.select2').select2()

		$('#produk').on('change', function() {
			console.log($(this).val());
		});

		$('#imagePreview').on('click', function() {
			$('#FGAMBAR').trigger('click');
		});
	});
</script>
@endpush