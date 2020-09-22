@auth
	@if (auth()->user()->hasRole('Admin'))
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Master Data
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Menu Produk</a>
			</div>
		</li>
	@endif
@endauth
