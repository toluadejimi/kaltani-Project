@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="card mt-4">
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

            <div class="card-header">
                <h4> Create Users</h4>
            </div>
            <div class="col-md-12 ">
                <form action="/updatepassword" method="post" class="mb-4 p-2">
                    @csrf
                    
                    <div class="row d-flex p-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-md-2">
                        <input type="submit" value="Update Password" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
     
    </div>
</div>
@endsection