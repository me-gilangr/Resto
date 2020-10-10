@extends('backend.layouts.master-top')

@section('css')
<style>
  .list-group-item:first-child {
    border-radius: 0px !important;
  } 
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
		<div class="card card-info">
      <div class="card-header">
        <h4 class="card-title">Daftar Masak</h4>
      </div>
      <div class="card-body p-0">
        <ul class="list-group" style="border-radius: 0px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte A
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte B
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte C
            <span class="badge badge-info pl-2 pr-2 text-md">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng A
            <span class="badge badge-info pl-2 pr-2 text-md">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng B
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng C
            <span class="badge badge-info pl-2 pr-2 text-md">5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Lemon Tea A
            <span class="badge badge-info pl-2 pr-2 text-md">3</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-6 col-xl-6">
    {{-- <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="card card-success">
          <div class="card-header text-center">
            <h4 style="float: none !important;">P03</h4>
          </div> 
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Caffee Latte A
              <span class="badge badge-primary badge-pill pl-2 pr-2">1x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Caffee Latte B
              <span class="badge badge-primary badge-pill pl-2 pr-2">2x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Caffee Latte C
              <span class="badge badge-primary badge-pill pl-2 pr-2">1x</span>
            </li>
          </ul>
        </div>
      </div>  
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="card card-success">
          <div class="card-header text-center">
            <h4 style="float: none !important;">P02</h4>
          </div> 
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Nasi Goreng A
              <span class="badge badge-primary badge-pill pl-2 pr-2">1x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Nasi Goreng B
              <span class="badge badge-primary badge-pill pl-2 pr-2">2x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Nasi Goreng C
              <span class="badge badge-primary badge-pill pl-2 pr-2">3x</span>
            </li>
          </ul>
        </div>
      </div>  
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
        <div class="card card-success">
          <div class="card-header text-center">
            <h4 style="float: none !important;">P11</h4>
          </div> 
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Caffee Latte A
              <span class="badge badge-primary badge-pill pl-2 pr-2">1x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Nasi Goreng C
              <span class="badge badge-primary badge-pill pl-2 pr-2">2x</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Lemon Tea A
              <span class="badge badge-primary badge-pill pl-2 pr-2">3x</span>
            </li>
          </ul>
        </div>
      </div>  
		</div> --}}
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Data Pesanan</h4>
					</div>
					<div class="card-body">
						@livewire('dapur.pesanan')
					</div>
				</div>
			</div>
		</div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="card card-info">
      <div class="card-header">
        <h4 class="card-title">Daftar Masak</h4>
      </div>
      <div class="card-body p-0">
        <ul class="list-group" style="border-radius: 0px;">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte A
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte B
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Caffee Latte C
            <span class="badge badge-info pl-2 pr-2 text-md">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng A
            <span class="badge badge-info pl-2 pr-2 text-md">1</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng B
            <span class="badge badge-info pl-2 pr-2 text-md">2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Nasi Goreng C
            <span class="badge badge-info pl-2 pr-2 text-md">5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Lemon Tea A
            <span class="badge badge-info pl-2 pr-2 text-md">3</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
