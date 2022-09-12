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
                <form action="/createUser" method="post" class="mb-4 p-2">
                    @csrf
                    
                    <div class="row d-flex p-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row d-flex p-2">
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Location</label>
                                <select name="location_id" id="" class="form-control">
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
                        <div class="col">
                             <div class="form-group">
                                <label for="">Role</label>
                                <select name="role_id" id="" class="form-control">
                                    <option value="">Select Role</option>
                                    
                                    @forelse ($roles as $item)
                                        
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @empty
                                    <option value="">No Record Found</option>
                                    @endforelse
                                   
                                </select>
                            </div>
                        </div>
                        
                           <div class="col">
                             <div class="form-group">
                                <label for="">Select User Type</label>
                                <select name="user_type" id="" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="staff">Staff</option>
                                    <option value="customer">Customer</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="col-md-2">
                        <input type="submit" value="Create User" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 shadow-sm">
                <table id="myTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->role->name}}</td>
                            <td>{{$item->location->name ?? "No Location Found"}}</td>
                           
                            <td>
                                <form action="/userDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user_edit/{{$item->id}}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">No Users Found</tr>
                        @endforelse
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection