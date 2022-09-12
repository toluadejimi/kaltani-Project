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
                <h4> Recycled Report</h4>
            </div>
            <div class="col-md-12 ">
                <form action="/recycleFilter" method="get" class="mb-4 p-2">
                    
                    
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
                                <label for="">Select Factory</label>
                                <select name="factory" id="" class="form-control">
                                    <option value="">Any</option>
                                    @forelse ($factory as $items)
    
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
                
                <div id="report">
                <div class="card">
                        <div class="card-header">
                            Kaltani Ims Report
                        </div>
                    
                    <div class="card-body">
                    <h6>Recycled Report</h6>
                    <div class="col shadow-sm table-responsive">
                <table id="example" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th >Factory</th>
                            <th >Weight In(Kg)</th>
                            <th>Costic Soda</th>
                            <th>Detergent</th>
                            <th >Weight Out(Kg)</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recycled as $item)
                        <tr>
                            <td>{{ $item->factory->name }}</td>
                            <td>{{ $item->item_weight_input }}kg</td>
                            <td>{{ $item->costic_soda}}kg</td>
                            <td>{{ $item->detergent}}kg</td>
                            <td>{{ $item->item_weight_output }}kg</td>
                        <td>
                            {{$item->created_at->format('D, d M Y ')}}
                        </td>
                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">
                                <td colspan="20">No Record Found</td>
                            </tr>
                        @endforelse
                        
                        
                    </tbody>
                    <tr>
                 
                        <td colspan="2">Total</td>
                        <td>{{ number_format($recycled->sum('item_weight_output'),2) }}kg</td>
                      </tr>
                </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    Date: {{\Carbon\Carbon::now()}}
                </div>
                <div class="d-flex justify-content-center">
                    {{ $recycled->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection