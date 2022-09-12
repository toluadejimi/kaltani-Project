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
                <h4>Bailed Sales Report</h4>
            </div>
            <div class="col-md-12 ">
                <form action="/salesFilter" method="get" class="mb-4 p-2">
                    
                    
                    <div class="row d-flex p-2">
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Location</label>
                                <select name="location_id" id="" class="form-control">
                                    <option value="">Any</option>
                                    @forelse ($collection as $items)
    
                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                    @empty
                                    <option value="">No Record Found </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 shadow-sm">
                
                <div class="card">
                    
                    <div class="">
                    <div class="col shadow-sm table-responsive">
                <table id="example"  class="table table-striped stripe mb-0">
                        <div class="card-header">
                            KALTANI MIS REPORT
                        </div>
                    <h6>BAILED SALES REPORT</h6>
                    <thead>
                        <tr>
                            <th>Location</th>
                                <th>Customer</th>
                                <th>Price/Ton</th>
                                <th>Clean Clear(KG)</th>
                            <th>Green Colour(KG)</th>
                            <th>Others(KG)</th>
                            <th>Trash(KG)</th>
                                <th>Freight(₦)</th>
                                <th>Amount(USD)</th>
                                <th>Amount(NGN)</th>
                                <th>Date</th>
                                <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $item)
                        <tr>
                            <td>{{ $item->location->name }}</td>
                                    <td>{{$item->customer_name}}</td>
                                    <td>{{$item->price_per_ton}}</td>
                                    <td >{{$item->Clean_Clear}}kg</td>
                            <td >{{$item->Green_Colour}}kg</td>
                            <td >{{$item->Others}}kg</td>
                            <td >{{$item->Trash}}kg</td>
                                    <td>{{number_format( $item->freight) }}</td>
                                    <td>{{ number_format($item->amount_usd) }}</td>
                                    <td>{{ number_format($item->amount_ngn) }}</td>
                                    <td>{{$item->created_at->format('D, d M Y ')}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">
                                <td colspan="20">No Record Found</td>
                            </tr>
                        @endforelse
                        
                        
                    </tbody>
                    <tr>
                 
                            <td colspan="3">Total</td>
                             <td colspan="3">{{ number_format($sales->sum('Clean_Clear'),2) }}Kg</td>
                            <td >₦{{ number_format($sales->sum('freight'),2) }}</td>
                            <td>${{ number_format($sales->sum('amount_usd'),2) }}</td>
                            <td>₦{{ number_format($sales->sum('amount_ngn'),2) }}</td>
                          </tr>
                </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    Date: {{\Carbon\Carbon::now()}}
                </div>
                <div class="d-flex justify-content-center">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection