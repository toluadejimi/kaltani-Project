@extends('layouts.main')
@section('content')
    <div class="main-content">
        <div class="card mt-4 p-4">
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
                <div class="col-md-12 p-2">
                    <div class="card-header">
                        <h4>Fund Agent</h4>
                    </div>
                    <form action="/fund-agent" method="post" class="mb-4 p-2">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Select Agent</label>
                                    <select name="agent_id" id="" class="form-control">
                                        @forelse ($agents as $items)
                                         <option value="">Select Agent</option>
                                        <option value="{{$items->user_id}}">{{$items->org_name}}</option>
                                        @empty
                                        <option value="">No Record Found </option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" name="amount" class="form-control">
                                </div>
                            </div>
        
                        </div>
                        <div class="col-md-2">
                            <input type="submit" value="Create Location" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12 shadow-sm table-responsive">
                    <table id="myTable" class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Agent Name</th>
                                <th>Amount</th>
                                <th>Staff</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fund_transaction as $item)
                                <tr>
                                    <td>{{ $item->org_name }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->staff_id }}</td>
                                    <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td> 
                                    
                                    
                                </tr>
                            @empty
                                <tr colspan="20" class="text-center">
                                    <td colspan="20">No Record Found</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    @endsection
