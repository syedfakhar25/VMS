
@extends('template.master')
@section('title')
    Show Vehicle
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicle
            </h6>

        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12" align="center">
                    <h1>{{$vehicle->vehicle_type}} -- {{$vehicle->model}}</h1>
                    <p class="title">CEO & Founder, Example</p>
                    <p>Harvard University</p>
                    
                </div>
            </div>
        </div>
    </div>

@endsection


