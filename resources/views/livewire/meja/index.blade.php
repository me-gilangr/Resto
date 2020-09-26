<div>
  <div class="row" style="font-family: system-ui;">
    <div class="col-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-table"></i> &ensp; Data Meja
          </h4>
          <div class="card-tools">
            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#modalTrashed">
              <i class="fas fa-trash"></i> &ensp; Data Terhapus
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalCreate">
              <i class="fas fa-plus"></i> &ensp; Tambah Data
            </button>
          </div>
        </div>
        <div class="card-body text-sm">
          <div class="table-responsive">
            <table class="table" id="meja-table">
              <thead>
                <tr>
                  <th>Nomor Meja</th>
                  <th>Jenis Meja</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@livewire('meja.form')

@push('script')
<script>
	$(document).ready(function() {
		function getData(table,trashed = false) {
			if (trashed == 'true') {
				var column = [
					{ "data": 'FNO_MEJA', "name": 'FNO_MEJA', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FJENIS', "name": 'FJENIS', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			} else {
				var column = [
					{ "data": 'FNO_MEJA', "name": 'FNO_MEJA', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": 'FJENIS', "name": 'FJENIS', "orderable": true, "searchable": true, "className": "p17", },
					{ "data": "action", "name": "action", "searchable": false, "orderable": false, "className": "text-center" },
				]
			}

			$(table).DataTable().clear();
			$(table).DataTable().destroy();
			$(table).DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					"url": "{{ route('datatable.meja') }}",
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

		getData('#meja-table');

	});
</script>
@endpush