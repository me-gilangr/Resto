<div>
	<div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="keranjangModalLabel" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="keranjangModalLabel"><i class="fa fa-shopping-basket text-danger"></i> &ensp; Menu Yang Akan di-Pesan.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-0">
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<td class="pl-3"><b>Nama Menu</b></td>
									<td class="text-center">Jumlah</td>
									<td class="text-center">Aksi</td>
								</tr>
							</thead>
							<tbody id="isi-cart">
								@forelse ($cart as $item)
									<tr>
										<td class="pl-3">
											{{ $item['name'] }} <br>
											<span class="badge badge-primary badge-pill">Rp. {{ number_format($item['price'], 0, ',', '.') }}</span> 
										</td>
										<td class="text-center">
											<div class="row">
												<div class="col-3 mx-auto text-center">
													<button class="btn btn-xs btn-outline-danger" style="border-radius: 50%; padding: 3px 9px;" wire:click="minusQty('{{ $item['id'] }}')">
														<b>&minus;</b>
													</button>
												</div>
												<div class="col-6 text-center">
													{{ $item['quantity'] }} Item <br> 
												</div>
												<div class="col-3 mx-auto text-center">
													<button class="btn btn-xs btn-outline-success" style="border-radius: 50%; padding: 3px 9px;" wire:click="addQty('{{ $item['id'] }}')">
														<b>&plus;</b>
													</button>
												</div>
												<div class="col-12 mt-2">
													<span class="badge badge-success badge-pill">Sub Total : Rp. {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</span>
												</div>
											</div>
										</td>
										<td class="text-center" style="vertical-align: inherit;">
											<button class="btn btn-xs btn-danger" wire:click="deleteItem('{{ $item['id'] }}')">
												<span class="fa fa-trash"></span>
											</button>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="3" class="text-center">
											Belum Ada Data Pemesanan
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					{{-- <ul class="list-group">
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<p>
								Nama Menu
							</p>
							<span class="badge badge-primary badge-pill">Jumlah</span> 
							<button class="btn btn-xs btn-danger">
								<span class="fa fa-trash"></span>
							</button>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							<p>
								Caffee Latte A <br>
								Harga : Rp. <u>20.000</u> <br>
								SubTotal : Rp. <u>20.000</u>
							</p>
							<span class="badge badge-primary badge-pill">1</span>
							<button class="btn btn-xs btn-danger">
								<span class="fa fa-trash"></span>
							</button>
						</li> 
					</ul> --}}
				</div>
				<div class="modal-footer"> 
					<div class="row">
						<div class="col-6 text-center">
							<b>Total &ensp; : </b>
						</div>
						<div class="col-6 text-center">
							<b>Rp. {{ number_format($total, 0, ',', '.') }}</b>
						</div>
						<div class="col-12 mt-4 text-right">
							<button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Tutup</button>
							<button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-paper-plane"></i> &ensp; Lakukan Pemesanan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('script')
<script>
	window.livewire.on('tutupCart', function(){
		$('#keranjangModal').modal('hide');
	});

	window.livewire.on('bukaCart', function(){
		$('#keranjangModal').modal('show');
	});

	function numberFormat(bilangan) {
		var	number_string = bilangan.toString(),
			sisa 	= number_string.length % 3,
			rupiah 	= number_string.substr(0, sisa),
			ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
				
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		return rupiah;
	}

	$(document).ready(function() {
		window.livewire.on('reDraw', function(){
			$('#isi-cart').empty();
			$.ajax({
				url: "{{ route('json.cart') }}",
				method: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					id: "{{ auth()->check() ? auth()->user()->id:date('Ymd') }}",
				},
				success: function (data) {
					console.log(data);
					var cart = Object.values(data);
					$('#isi-cart').empty();
					cart.forEach(item => {
						$('#isi-cart').append(`
							<tr>
								<td class="pl-3">
									${item.name} <br>
									<span class="badge badge-primary badge-pill">Rp. `+ numberFormat(item.price) +`</span> 
								</td>
								<td class="text-center">
									<div class="row">
										<div class="col-3 mx-auto text-center">
											<button class="btn btn-xs btn-outline-danger minus" data-id="`+ item.id +`" style="border-radius: 50%; padding: 3px 9px;" wire:click="minusQty('`+ item.id +`')">
												<b>&minus;</b>
											</button>
										</div>
										<div class="col-6 text-center">
											`+ item.quantity +` Item <br> 
										</div>
										<div class="col-3 mx-auto text-center">
											<button class="btn btn-xs btn-outline-success add" data-id="`+ item.id +`" style="border-radius: 50%; padding: 3px 9px;" wire:click="addQty('`+ item.id +`')">
												<b>&plus;</b>
											</button>
										</div>
										<div class="col-12 mt-2">
											<span class="badge badge-success badge-pill">Sub Total : Rp. `+ numberFormat((item.quantity * item.price)) +`</span>
										</div>
									</div>
								</td>
								<td class="text-center" style="vertical-align: inherit;">
									<button class="btn btn-xs btn-danger del" data-id="`+ item.id +`" wire:click="deleteItem('`+ item.id +`')">
										<span class="fa fa-trash"></span>
									</button>
								</td>
							</tr>
						`);
					});
				}
			});
		});

		$('#isi-cart').on('click', '.add', function() {
			window.livewire.emit('addQtyE', $(this).data('id'));
		});

		$('#isi-cart').on('click', '.minus', function() {
			window.livewire.emit('minusQtyE', $(this).data('id'));
		});

		$('#isi-cart').on('click', '.del', function() {
			window.livewire.emit('delItem', $(this).data('id'));
		});
	});
</script>
@endpush