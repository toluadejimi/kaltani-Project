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
                <h4> Collection Report</h4>
            </div>
            <div class="col-md-12 ">
                <form action="/collectionFilter" method="get" class="mb-4 p-2">
                    <div class="row d-flex p-2">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Date From</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Date To</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Factory</label>
                                <select name="location_id" id="" class="form-control">
                                    <option value="">Any</option>
                                    @forelse ($location as $items)
    
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
                <table id="example"  class="table table-striped stripe display nowrap mb-0">
                        <div class="card-header">
                            KALTANI MIS REPORT
                        </div>
                    <h6>COLLECTIONS REPORT</h6>
                    <thead>
                        <tr>
                            <th>Collection Center</th>
                            <th>Available Weight</th>
                            <th>State</th>
                            <!--<th>Staff</th>-->
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collection as $item)
                        <tr>
                            <td>{{$item->location->name}}</td>
                            <td>{{$item->item_weight}}kg</td>
                            <td>{{$item->location->state}}</td>
                            <!--<td>{{$item->user_id}} {{$item->user->last_name ?? ""}}</td>-->
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
                     
                      <td colspan="1">Total</td>
                      <td>{{ number_format($collection->sum('item_weight'),2) }}kg</td>
                    </tr>
                </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    Date: {{\Carbon\Carbon::now()}}
                </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $collection->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection