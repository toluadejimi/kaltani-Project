@extends('layouts.main')
@section('content')
    <div class="main-content">
        <!-- Row start -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4> Edit Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="/factoryUpdate/{{$item->id}}" method="post">
                            @csrf
                            <div class="row d-flex">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for=""> Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$item->name}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$item->address}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" name="city" class="form-control" value="{{$item->city}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control" value="{{$item->state}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        

    </div>
    <!-- Dashboard wrapper end -->

</div>
<!-- Main Container end -->
    </div>

    
@endsection