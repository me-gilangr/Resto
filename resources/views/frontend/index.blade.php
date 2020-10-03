@extends('frontend.layouts.master')

@section('css')
<style>
  .carousel-caption {
    bottom: -15px !important;
  }

  .carousel-caption > h5, .carousel-caption > p {
    background: rgba(0, 0, 0, 0.75);
    color: white;
    margin: 0;
  }

	.image-preview {
		min-height: 200px;
		max-height: 200px;
		border: 2px solid #dddddd;
		margin: 0 auto;
		margin-bottom: 10px !important;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: bold;
		color: #cccccc;
		background-color: #413d3d;
	}

	.image-preview__image {
		display: block;
		width: 100%;
		max-height: 300px;
	}
</style>
@endsection

@section('content')
<div class="row"> 
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 pb-4">
    <div id="carouselMain" class="carousel slide" data-ride="carousel"> 
      <div class="carousel-inner" style="border-radius: 10px !important;">
        <div class="carousel-item active">
          <img src="{{ asset('images/Menu/Latte.jpg') }}" class="d-block w-100 img-fluid" style="min-height: 220px !important; max-height: 300px !important;" alt="Img Menu">
          <div class="carousel-caption d-block">
            <h5>Coffee Latte</h5>
            <p>Kopi Nikmat. Temani Obrolanmu.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/Menu/Latte.jpg') }}" class="d-block w-100 img-fluid" style="min-height: 220px !important; max-height: 300px !important;" alt="Img Menu">
          <div class="carousel-caption d-block">
            <h5>Coffee Latte</h5>
            <p>Kopi Nikmat. Temani Obrolanmu.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/Menu/Latte.jpg') }}" class="d-block w-100 img-fluid" style="min-height: 220px !important; max-height: 300px !important;" alt="Img Menu">
          <div class="carousel-caption d-block">
            <h5>Coffee Latte</h5>
            <p>Kopi Nikmat. Temani Obrolanmu.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
    <div class="row">
			@foreach ($menu as $item)
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body">
            {{-- <span style="
              border: 1px solid rgb(202 202 202 / 77%); 
              background-color: #f3f3f3; 
              border-radius: .25rem; 
              padding: 2px 24px; 
              font-family: revert; 
              font-weight: 500; 
              font-size: 14px;
            ">
              {{ $item->FN_KATEGORI }}
            </span> --}}
						<div class="card" style="width: 100%; margin-bottom: 0px;">
							<div class="card-img-top">
								<div class="image-preview" id="imagePreview">
									<img src="{{ asset('images/Menu/'.$item->FGAMBAR) }}" alt="Image Preview" class="image-preview__image">
								</div>
							</div>
							<div class="card-body" style="
								border: 1px solid rgb(0 0 0 / 16%);
								border-bottom-left-radius: 0px; 
								border-bottom-right-radius: 0px;
								padding: 10px 15px 10px 15px;
							">
								<p class="card-text mb-1">{{ $item->FN_MENU }}</p>
								<p class="card-text mb-1">{{ 'Rp. '.number_format($item->FHARGAJUAL, 0, ',', '.') }}</p>
								<hr class="mb-2 mt-1">
								<button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
									<i class="fa fa-shopping-cart"></i> &ensp; Masukan Daftar Pesan
								</button>
							</div>
						</div>
          </div>
        </div>
        
        {{-- <div class="info-box pr-3 pl-3 pt-0 pb-0" style="border-radius: 10px !important;">
          <span class="info-box-icon text-secondary"><i class="fa fa-utensils"></i></span>
    
          <div class="info-box-content pt-0 pr-0">
            <span class="info-box-text text-center">Daftar Makanan</span>
            <div class="progress">
              <div class="progress-bar bg-secondary" style="width: 100%"></div>
            </div> 
          </div>
        </div> --}}
      </div>
			@endforeach
    </div>
  </div>
</div>

{{-- Modul --}}
{{-- https://ourcodeworld.com/articles/read/1093/how-to-access-the-htdocs-directory-of-xampp-from-a-computer-or-mobile-device-in-the-same-local-area-network-lan --}}
{{-- https://superuser.com/questions/92549/is-xampp-safe-for-use-inside-a-firewall --}}
@endsection
