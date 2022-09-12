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
                        <h4> Edit Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="/roleEdit/{{$role->id}}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="" class="mr-4">Role Title</label>
                                <div class="form-group mr-4">
                                    <input type="text" name="name" class="form-control" value="{{$role->name}}">
                                </div>
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
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