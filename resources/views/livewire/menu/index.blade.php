<div>
  <div class="row" style="font-family: system-ui;">
    <div class="col-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-table"></i> &ensp; Data Meja
          </h4>
          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-danger" id="trashed">
              <i class="fas fa-trash"></i> &ensp; Data Terhapus
            </button>
            <a href="{{ route('menu.create') }}" class="btn btn-sm btn-outline-primary">
              <i class="fas fa-plus"></i> &ensp; Tambah Data
            </a>
          </div>
        </div>
        <div class="card-body text-sm">
          <div class="table-responsive" wire:ignore>
            <table class="table" id="menu-table" style="width: 100%;">
              <thead>
                <tr>
                  <th>Kode Menu</th>
                  <th>Nama Menu</th>
									<th>Harga Pokok</th>
									<th>Margin</th>
									<th>Pajak</th>
									<th>Harga Jual</th>
									<th>Status</th>
									<th>Tanggal Input</th>
                  <th>Aksi</th>
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
	
	<div class="modal fade" id="modalTrashed">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Data Meja Terhapus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive" wire:ignore>
						<table  class="table table-hover" id="menu-trashed" style="width: 100%;" >
							<thead>
								<tr>
                  <th>Kode Menu</th>
                  <th>Nama Menu</th>
									<th>Harga Pokok</th>
									<th>Margin</th>
									<th>Pajak</th>
									<th>Harga Jual</th>
									<th>Status</th>
									<th>Tanggal Hapus</th>
                  <th>Aksi</th>
								</tr>
							</thead>
							<tbody id="isi-trashed">
	
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>

@push('script')
<script>
	$(document).ready(function() {
		function getData(table,trashed = false) {
			if (trashed == 'true') {
				var column = [
					{ "data": 'FNO_H_MENU', "name": 'FNO_H_MENU', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_MENU', "name": 'FN_MENU', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FHARGAPOKOK', "name": 'FHARGAPOKOK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FMARGIN', "name": 'FMARGIN', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FPAJAK', "name": 'FPAJAK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FHARGAJUAL', "name": 'FHARGAJUAL', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FSTATUS', "name": 'FSTATUS', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'deleted_at', "name": 'deleted_at', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			} else {
				var column = [
					{ "data": 'FNO_H_MENU', "name": 'FNO_H_MENU', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_MENU', "name": 'FN_MENU', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FHARGAPOKOK', "name": 'FHARGAPOKOK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FMARGIN', "name": 'FMARGIN', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FPAJAK', "name": 'FPAJAK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FHARGAJUAL', "name": 'FHARGAJUAL', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FSTATUS', "name": 'FSTATUS', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'created_at', "name": 'created_at', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			}

			$(table).DataTable().clear();
			$(table).DataTable().destroy();
			$(table).DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					"url": "{{ route('datatable.menu') }}",
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

		getData('#menu-table');

		$('#test').on('click', function() {
			$('#menu-table').DataTable().clear();
			$('#menu-table').DataTable().destroy();
			getData('#menu-table');
		});

		window.livewire.on('updatedDataTable', function(){
			$('#modalTrashed').modal('hide');
			getData('#menu-table');
			getData('#menu-trashed', true);
		});
		
		$("#isi").on('click', '.edit', function(){
			var kode = $(this).data('id');
			window.livewire.emit('edit', kode);
		});

		$('#isi').on('click', '.hapus', function() {
			var kode = $(this).data('id');
			window.livewire.emit('hapus', kode);
		});

		$("#isi-trashed").on('click', '.restore', function(){
			var kode = $(this).data('id');
			window.livewire.emit('restore', kode);
		});

		$('#isi').on('click', '.activate', function() {
			var kode = $(this).data('id');
			window.livewire.emit('activate', kode);
		});

		$('#isi').on('click', '.deactivate', function() {
			var kode = $(this).data('id');
			window.livewire.emit('deactivate', kode);
		});

		$('#trashed').on('click', function() {
			$('#modalTrashed').modal('show');
			getData('#menu-trashed', true);
		});
	});
</script>
@endpush