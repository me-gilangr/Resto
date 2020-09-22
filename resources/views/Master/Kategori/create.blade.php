@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						Form Kategori
					</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('kategori.store') }}" method="post">
						@csrf
						<div class="form-group">
							<label for="">Nama Kategori : </label>
							<input type="text" name="FN_NAMA" id="FN_NAMA" class="form-control" placeholder="Masukan Nama Kategori..." required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">
								Tambah Data
							</button>
							<button type="reset" class="btn btn-danger">
								Reset Input
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection