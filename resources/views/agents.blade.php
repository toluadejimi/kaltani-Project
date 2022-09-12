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
                <h4> Agent List</h4>
            </div>
            
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 shadow-sm">
                <table id="myTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Orgnization Name</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>City</th>
                            <th>LGA</th>
                            <th>Phone</th>
                            <th>Balance</th>
                            <th>Customer Name</th>
                             <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>{{$item->org_name}}</td>
                            <td>{{$item->adddress}}</td>
                            <td>{{$item->statel}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->lga}}</td>
                            <td>{{$item->phone}}</td>
                            <td>NGN {{number_format($item->agent_wallet, 2)}}</td>
                            <td>{{$item->status}}</td>

                            <td>
                                <form action="/userDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/user_edit/{{$item->user_id}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">No Agent Found</tr>
                        @endforelse
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection