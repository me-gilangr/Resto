@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('external/datatables/datatables.css') }}">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white">
					<div class="row">
						<h4 class="card-title col-md-6 col-lg-6">
							Data Kategori
						</h4>
						<div class="col-md-6 col-lg-6 text-right">
							{{-- <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalForm">Tambah Data</a> --}}
							<a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="kategori-table">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data_kategori as $item)
									<tr>
										<td>{{ $item->FK_KAT }}</td>
										<td>{{ $item->FN_KAT }}</td>
										<td width="30%" class="text-center">
											<form action="{{ route('kategori.destroy', $item->FK_KAT) }}" method="post">
												@csrf
												@method('DELETE')
												<a href="{{ route('kategori.edit', $item->FK_KAT) }}" class="btn btn-info btn-sm text-white">
													Edit Data
												</a>

												<button type="submit" class="btn btn-danger btn-sm">
													Hapus Data
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Tambah Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label>Nama Kategori : <span class="text-danger">*</span></label>
							<input type="text" name="FN_KAT" id="FN_KAT" class="form-control FN_KAT">
						</div>
					</div>
				</div>
			</div>
      <div class="modal-footer">
				<input type="hidden" name="FK_KAT" id="FK_KAT" class="FK_KAT">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup Form</button>
        <button type="button" class="btn btn-primary add">Tambah Data</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('external/datatables/datatables.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#kategori-table').DataTable({
			// processing: true,
			// serverSide: true,
		});
	});
</script>
@endsection