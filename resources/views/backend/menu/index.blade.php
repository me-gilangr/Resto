@extends('backend.layouts.master')	
@section('content')
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
@endsection