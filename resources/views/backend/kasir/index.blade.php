@extends('backend.layouts.master')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card card-danger card-outline">
			<div class="card-header">
				<h4 class="card-title"> <span class="fa fa-coins text-danger"></span> &ensp; Data Transaksi Saat Ini </h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
							<table class="table" id="pesanan-table" style="width: 100%;">
								<thead>
									<tr>
										<th>Meja</th>
										<th>Tgl Pesanan</th>
										<th>Atas Nama</th>
										<th>Menu</th>
										<th>Total</th>
										<th width="15%">Aksi</th>
									</tr>
								</thead>
								<tbody id="isi">

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {
		function getData(table, trashed = false) {
			var column = [
				{ "data": 'MEJA', "name": 'MEJA', "orderable": true, "searchable": true, "className": "p17", },
				{ "data": 'TGL_PESAN', "name": 'TGL_PESAN', "orderable": true, "searchable": true, "className": "p17", },
				{ "data": 'FATAS_NAMA', "name": 'FATAS_NAMA', "orderable": true, "searchable": true, "className": "p17", },
				{ "data": 'MENU', "name": 'MENU', "orderable": true, "searchable": true, "className": "p17", },
				{ "data": 'TOTAL', "name": 'TOTAL', "orderable": true, "searchable": true, "className": "p17", },
				{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
			];

			$(table).DataTable().clear();
			$(table).DataTable().destroy();
			$(table).DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					"url": "{{ route('datatable.pesanan') }}",
					"dataType": "json",
					"type": "POST",
					"data": {
						_token: "{{ csrf_token() }}",
						trashed:trashed,
					},
				},
				columns: column,
			});
		}
		
		getData('#pesanan-table');
	});
</script>
@endsection