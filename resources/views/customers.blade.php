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
                <h4> Customer List</h4>
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
                            <th>Banance</th>
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
                            <td>NGN {{number_format($item->wallet, 2)}}</td>

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