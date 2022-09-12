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
                <h4> Drop Off List</h4>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-duotone fa-truck-fast"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pending Drop Off</h4>
                  </div>
                  <div class="card-body">
                    {{$pending_drop_off}}
                  </div>
                </div>
              </div>
            </div>
            
             <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-sharp fa-pallet-boxes"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Weight Collected</h4>
                  </div>
                  <div class="card-body">
                    {{$total_weight}}
                  </div>
                </div>
              </div>
            </div>
         
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-solid fa-money-bill-transfer"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Amount Out</h4>
                  </div>
                  <div class="card-body">
                    {{number_format($money_out, 2)}}
                  </div>
                </div>
              </div>
            </div>
            
            
            
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
        </div>
         
        </div> 
         
         
         
         
         
         
         
         
         
         
         
        <div class="row">
            <div class="col-md-12 shadow-sm">
                <table id="myTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Weight</th>
                            <th>Amount</th>
                            <th>Collection Center</th>
                            <th>Customer</th>
                            <th>Plastic Waste Image</th>
                            <th>Status</th>
                             <th>Date</th>
                             <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dropofflist as $item)
                        <tr>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->weight}}</td>
                            <td>NGN {{number_format($item->amount, 2)}}</td>
                            <td>{{$item->collection_center}}</td>
                            <td>{{$item->customer}}</td>
                            <td><img src="{{ url('upload/customer/'.$item->image)}}"  width="50px" height="50px"/></td>
                             @if($item->status =='0')         
                             <td><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>         
                             @else
                             <td><span class="badge rounded-pill bg-success">Completed</span></td>        
                             @endif

                             <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>

                            <td>
                                <form action="/dropoffDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
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