@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

										You are logged in!

										<br>
										
										{!! QrCode::size(200)->generate('http://192.168.1.36:8000/welcome?meja=1') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
