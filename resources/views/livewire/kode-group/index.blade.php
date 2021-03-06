<div>
  <div class="row" style="font-family: system-ui;">
    <div class="col-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-table"></i> &ensp; Data Kode Group
          </h4>
          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-danger" id="trashed">
              <i class="fas fa-trash"></i> &ensp; Data Terhapus
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalCreate">
              <i class="fas fa-plus"></i> &ensp; Tambah Data
            </button>
          </div>
        </div>
        <div class="card-body text-sm">
          <div class="table-responsive" wire:ignore>
            <table class="table" id="kode-group-table" style="width: 100%;">
              <thead>
                <tr>
                  <th>Kode Group</th>
                  <th>Nama Group</th>
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
					<h4 class="modal-title">Data Kode Group Terhapus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive" wire:ignore>
						<table  class="table table-hover" id="kode-group-trashed" style="width: 100%;" >
							<thead>
								<tr>
                  <th>Kode Group</th>
									<th>Nama Group</th>
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

@livewire('kode-group.form')

@push('script')
<script>
	$(document).ready(function() {
		function getData(table,trashed = false) {
			if (trashed == 'true') {
				var column = [
					{ "data": 'FK_GROUP', "name": 'FK_GROUP', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_GROUP', "name": 'FN_GROUP', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'deleted_at', "name": 'deleted_at', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			} else {
				var column = [
					{ "data": 'FK_GROUP', "name": 'FK_GROUP', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_GROUP', "name": 'FN_GROUP', "orderable": true, "searchable": true, "className": "p17", },
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
					"url": "{{ route('datatable.kode-group') }}",
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

		getData('#kode-group-table');

		$('#test').on('click', function() {
			$('#kode-group-table').DataTable().clear();
			$('#kode-group-table').DataTable().destroy();
			getData('#kode-group-table');
		});

		window.livewire.on('updatedDataTable', function(){
			$('#modalTrashed').modal('hide');
			getData('#kode-group-table');
			getData('#kode-group-trashed', true);
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

		$('#trashed').on('click', function() {
			$('#modalTrashed').modal('show');
			getData('#kode-group-trashed', true);
		});
	});
</script>
@endpush