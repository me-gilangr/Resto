<div>
  <div class="row" style="font-family: system-ui;">
    <div class="col-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-table"></i> &ensp; Data Kategori
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
            <table class="table" id="kategori-table" style="width: 100%;">
              <thead>
                <tr>
                  <th>Kode Kategori</th>
                  <th>Nama Kategori</th>
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
					<h4 class="modal-title">Data Kategori Terhapus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive" wire:ignore>
						<table  class="table table-hover" id="kategori-trashed" style="width: 100%;" >
							<thead>
								<tr>
                  <th>Kode Kategori</th>
									<th>Nama Kategori</th>
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

@livewire('kategori.form')

@push('script')
<script>
	$(document).ready(function() {
		function getData(table,trashed = false) {
			if (trashed == 'true') {
				var column = [
					{ "data": 'FNO_KATEGORI', "name": 'FNO_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_KATEGORI', "name": 'FN_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'deleted_at', "name": 'deleted_at', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			} else {
				var column = [
					{ "data": 'FNO_KATEGORI', "name": 'FNO_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_KATEGORI', "name": 'FN_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
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
					"url": "{{ route('datatable.kategori') }}",
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

		getData('#kategori-table');

		$('#test').on('click', function() {
			$('#kategori-table').DataTable().clear();
			$('#kategori-table').DataTable().destroy();
			getData('#kategori-table');
		});

		window.livewire.on('updatedDataTable', function(){
			$('#modalTrashed').modal('hide');
			getData('#kategori-table');
			getData('#kategori-trashed', true);
		});
		
		$("#isi").on('click', '.edit', function(){
			var kode = $(this).data('id');
			var param1 = $(this).data('param1');
			window.livewire.emit('edit', kode, param1);
		});

		$('#isi').on('click', '.hapus', function() {
			var kode = $(this).data('id');
			var param1 = $(this).data('param1');
			window.livewire.emit('hapus', kode, param1);
		});

		$("#isi-trashed").on('click', '.restore', function(){
			var kode = $(this).data('id');
			var param1 = $(this).data('param1');
			window.livewire.emit('restore', kode, param1);
		});

		$('#trashed').on('click', function() {
			$('#modalTrashed').modal('show');
			getData('#kategori-trashed', true);
		});
	});
</script>
@endpush