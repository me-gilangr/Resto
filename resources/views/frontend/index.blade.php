@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #ba2121;
		padding: 0px 15px;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
		margin-left: 10px;
		color: #ffffff;
	}
</style>

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
		min-height: 270px;
		max-height: 300px;
		border: 2px solid #dddddd;
		margin: 0 auto;
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
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 pb-4">
    <div id="carouselMain" class="carousel slide" data-ride="carousel"> 
			<div class="carousel-inner" style="border-radius: 10px !important;">
				@php
					$caro = 1;
				@endphp
				@foreach ($menu as $item)
					<div class="carousel-item {{ $caro == 1 ? 'active':'' }}">
						<div class="image-preview" id="imagePreview">
							<img src="{{ asset('images/Menu/'.$item->FGAMBAR) }}" alt="Image Preview" class="image-preview__image" style="max-height: 300px;">
						</div>
						<div class="carousel-caption d-block">
							<h5 style="margin-bottom: 20px;">{{ $item->FN_MENU }}</h5>
							{{-- <p>Kopi Nikmat. Temani Obrolanmu.</p> --}}
						</div>
					</div>
				@php
					$caro++;
				@endphp
				@endforeach
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
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
		@livewire('frontend.daftar-menu')
  </div>
</div>


@livewire('frontend.cart')

{{-- Modul --}}
{{-- https://ourcodeworld.com/articles/read/1093/how-to-access-the-htdocs-directory-of-xampp-from-a-computer-or-mobile-device-in-the-same-local-area-network-lan --}}
{{-- https://superuser.com/questions/92549/is-xampp-safe-for-use-inside-a-firewall --}}
@endsection

@section('script')
<script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
@endsection