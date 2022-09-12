@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-6 shadow-sm table-responsive">
        <div class="h4">
            <p>{{$location->name}}</p>
        </div>
        <div class="h5">
            <p>{{$location->address}}</p>
        </div>
        <div class="h4">
            <p>{{$location->city}}</p>
        </div>
        <div class="h4">
            <p>{{$location->state}}</p>
        </div>
    </div>
    
</div>
@endsection