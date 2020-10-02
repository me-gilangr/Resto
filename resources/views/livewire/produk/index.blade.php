<div>
  <div class="row" style="font-family: system-ui;">
    <div class="col-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-table"></i> &ensp; Data Produk
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
            <table class="table" id="produk-table" style="width: 100%;">
              <thead>
                <tr>
									<th>Kode Produk</th>
									<th>Kategori Produk</th>
                  <th>Nama Produk</th>
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
					<h4 class="modal-title">Data Produk Terhapus</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive" wire:ignore>
						<table  class="table table-hover" id="produk-trashed" style="width: 100%;" >
							<thead>
								<tr>
									<th>Kode Produk</th>
									<th>Kategori Produk</th>
									<th>Nama Produk</th>
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

@livewire('produk.form')

@push('script')
<script>
	$(document).ready(function() {
		function getData(table,trashed = false) {
			if (trashed == 'true') {
				var column = [
					{ "data": 'FNO_PRODUK', "name": 'FNO_PRODUK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FNO_KATEGORI', "name": 'FNO_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_NAMA', "name": 'FN_NAMA', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'deleted_at', "name": 'deleted_at', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			} else {
				var column = [
					{ "data": 'FNO_PRODUK', "name": 'FNO_PRODUK', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FNO_KATEGORI', "name": 'FNO_KATEGORI', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FN_NAMA', "name": 'FN_NAMA', "orderable": true, "searchable": true, "className": "p17", },
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
					"url": "{{ route('datatable.produk') }}",
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

		getData('#produk-table');

		$('#test').on('click', function() {
			$('#produk-table').DataTable().clear();
			$('#produk-table').DataTable().destroy();
			getData('#produk-table');
		});

		window.livewire.on('updatedDataTable', function(){
			$('#modalTrashed').modal('hide');
			getData('#produk-table');
			getData('#produk-trashed', true);
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
			getData('#produk-trashed', true);
		});
	});
</script>
@endpush