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
</style>
@endsection

@section('content')
<div class="row"> 
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 pb-3">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel"> 
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
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
    <div class="row">
      <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4">
        <div class="info-box pr-3 pl-3 pt-0 pb-0" style="border-radius: 10px !important;">
          <span class="info-box-icon text-secondary"><i class="fa fa-utensils"></i></span>
    
          <div class="info-box-content pt-0 pr-0">
            <span class="info-box-text text-center">Daftar Makanan</span>
            <div class="progress">
              <div class="progress-bar bg-secondary" style="width: 100%"></div>
            </div> 
          </div>
        </div>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4">
        <div class="info-box pr-3 pl-3 pt-0 pb-0" style="border-radius: 10px !important;">
          <span class="info-box-icon text-secondary"><i class="fa fa-coffee"></i></span>
    
          <div class="info-box-content pt-0 pr-0">
            <span class="info-box-text text-center">Daftar Makanan</span>
            <div class="progress">
              <div class="progress-bar bg-secondary" style="width: 100%"></div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection