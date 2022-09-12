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
                <form action="/userEdit/{{$users->id}}" method="post" class="mb-4 p-2">
                    @csrf
                    
                    <div class="row d-flex p-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{$users->first_name}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{$users->last_name}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$users->email}}">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row d-flex p-2">
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{$users->phone}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Location</label>
                                <select name="location_id" id="" class="form-control">
                                    <option value="{{$users->location_id}}">{{$users->locations->name ?? 'none'}}</option>
                                    @forelse ($collection as $items)
                                    <option value="{{$items->id}}">{{$items->name}}({{$items->type}})</option>
                                    @empty
                                    <option value="">No Record Found </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex p-2">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role_id" id="" class="form-control">
                                    <option value="{{$users->role_id}}">{{$users->role->name ?? 'none'}}</option>
                                    @forelse ($role as $item)
                                        
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @empty
                                    <option value="">No Record Found</option>
                                    @endforelse
                                   
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Update User" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection