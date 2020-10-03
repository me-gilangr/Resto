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
			@foreach ($kategori as $item)
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-body" style="margin-top: -30px !important;">
            <span style="
              border: 1px solid rgb(202 202 202 / 77%); 
              background-color: #f3f3f3; 
              border-radius: .25rem; 
              padding: 2px 24px; 
              font-family: revert; 
              font-weight: 500; 
              font-size: 14px;
            ">
              {{ $item->FN_KATEGORI }}
            </span>

            <div id="carouselMakanan" class="carousel slide" data-ride="carousel" style="margin-top: 20px;"> 
              <div class="carousel-inner">
								@php
									$no = 1;
								@endphp
								@foreach ($menu as $item2)
									@if ($item2->detail[0]->produk->FNO_KATEGORI == $item->FNO_KATEGORI)
										<div class="carousel-item {{ $no == 1 ? 'active':'' }}">
											<div class="card" style="width: 100%;">
												<img src="{{ asset('images/Menu/'.$item2->FGAMBAR) }}" class="card-img-top img-fluid" alt="Foto Menu"
													style="
														border-top-left-radius: 5px;
														border-top-right-radius: 5px;
														max-height: 150px;
														min-height: 100px;
														align-items: center;
													"
												>
												<div class="card-body" style="
													border: 1px solid rgb(0 0 0 / 16%);
													border-bottom-left-radius: 5px; 
													border-bottom-right-radius: 5px;
													padding: 10px 15px 10px 15px;
												">
													<p class="card-text mb-1">{{ $item2->FN_MENU }}</p>
													<p class="card-text mb-1">{{ 'Rp. '.number_format($item2->FHARGAJUAL, 0, ',', '.') }}</p>
													<hr class="mb-2 mt-1">
													<button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
														<i class="fa fa-shopping-cart"></i> &ensp; Masukan Daftar Pesan
													</button>
												</div>
											</div>
										</div>
									@endif
								@php
									$no++;
								@endphp
								@endforeach
                {{-- <div class="carousel-item active">
                  <div class="card" style="width: 100%;">
                    <img src="{{ asset('images/Menu/Latte.jpg') }}" class="card-img-top img-fluid" alt="Foto Menu"
                      style="
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
                        max-height: 150px;
                        min-height: 100px;
                      "
                    >
                    <div class="card-body" style="
                      border: 1px solid rgb(0 0 0 / 16%);
                      border-bottom-left-radius: 5px; 
                      border-bottom-right-radius: 5px;
                      padding: 10px 15px 10px 15px;
                    ">
                      <p class="card-text mb-1">Coffee Latte A</p>
                      <p class="card-text mb-1">Rp. 20.000</p>
                      <hr class="mb-2 mt-1">
                      <button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
                        <i class="fa fa-shopping-cart"></i> Masukan Keranjang
                      </button>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="card" style="width: 100%;">
                    <img src="{{ asset('images/Menu/Latte.jpg') }}" class="card-img-top img-fluid" alt="Foto Menu"
                      style="
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
                        max-height: 150px;
                        min-height: 100px;
                      "
                    >
                    <div class="card-body" style="
                      border: 1px solid rgb(0 0 0 / 16%);
                      border-bottom-left-radius: 5px; 
                      border-bottom-right-radius: 5px;
                      padding: 10px 15px 10px 15px;
                    ">
                      <p class="card-text mb-1">Coffee Latte B</p>
                      <p class="card-text mb-1">Rp. 25.000</p>
                      <hr class="mb-2 mt-1">
                      <button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
                        <i class="fa fa-shopping-cart"></i> Masukan Keranjang
                      </button>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="card" style="width: 100%;">
                    <img src="{{ asset('images/Menu/Latte.jpg') }}" class="card-img-top img-fluid" alt="Foto Menu"
                      style="
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
                        max-height: 150px;
                        min-height: 100px;
                      "
                    >
                    <div class="card-body" style="
                      border: 1px solid rgb(0 0 0 / 16%);
                      border-bottom-left-radius: 5px; 
                      border-bottom-right-radius: 5px;
                      padding: 10px 15px 10px 15px;
                    ">
                      <p class="card-text mb-1">Coffee Latte C</p>
                      <p class="card-text mb-1">Rp. 30.000</p>
                      <hr class="mb-2 mt-1">
                      <button class="btn btn-xs btn-outline-success float-right pr-2 pl-2">
                        <i class="fa fa-shopping-cart"></i> Masukan Keranjang
                      </button>
                    </div>
                  </div>
                </div> --}}
              </div>
              <a class="carousel-control-prev" href="#carouselMakanan" style="bottom: 120px;" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselMakanan" style="bottom: 120px;" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
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
