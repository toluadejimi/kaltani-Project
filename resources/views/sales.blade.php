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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-solid fa-money-bill-transfer"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sales Naira</h4>
                  </div>
                  <div class="card-body">
                    {{number_format($salesngn, 2)}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-solid fa-money-bill-transfer"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sales Dollars</h4>
                  </div>
                  <div class="card-body">
                    {{number_format($salesusd, 2)}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-solid fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Weight</h4>
                  </div>
                  <div class="card-body">
                    {{$salesweight}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-solid fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Freight</h4>
                  </div>
                  <div class="card-body">
                    {{$salesfreight}}
                  </div>
                </div>
              </div>
            </div>
            
          </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4> Create Sales</h4>
                    </div>
                    <form action="/addsales" method="post" class="mb-4 ">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Weight</label>
                                    <input type="text" name="item_weight" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Price Per Ton</label>
                                    <input type="text" name="price_per_ton" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Freight</label>
                                    <input type="text" name="freight" class="form-control" value="0">
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Currency</label>
                                    <select name="currency" id="" class="form-control">
                                        <option value="NGN">NGN</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                           <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Factory</label>
                                <select name="factory_id" id="" class="form-control">
                                    @forelse ($factory as $items)
                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                    @empty
                                    <option value="">No Record Found </option>
                                    @endforelse
                                </select>
                            </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="submit" value="Create" class="btn btn-primary">
                            </div>
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
                                <th>Factory</th>
                                <th>Customer</th>
                                <th>Price/Ton</th>
                                <th>Weight</th>
                                <th>Freight(₦)</th>
                                <th>Amount(USD)</th>
                                <th>Amount(NGN)</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $item)
                                <tr>
                                    <td>{{ $item->location->name }}</td>
                                    <td>{{$item->customer_name}}</td>
                                    <td>{{$item->price_per_ton}}</td>
                                    <td>{{ $item->item_weight }}kg</td>
                                    <td>{{number_format( $item->freight) }}</td>
                                    <td>{{ number_format($item->amount_usd) }}</td>
                                    <td>{{ number_format($item->amount_ngn) }}</td>
                                    <td>{{$item->created_at->format('D, d M Y ')}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                                    <td>
                                        <form action="/salesDelete/{{$item->id}}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa-light fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr colspan="20" class="text-center">
                                    <td colspan="20">No Record Found</td>
                                </tr>
                            @endforelse


                        </tbody>
                        <tr>
                 
                            <td colspan="3">Total</td>
                            <td>{{ number_format($sales->sum('item_weight'),2) }}Kg</td>
                            <td>₦{{ number_format($sales->sum('freight'),2) }}</td>
                            <td>${{ number_format($sales->sum('amount_usd'),2) }}</td>
                            <td>₦{{ number_format($sales->sum('amount_ngn'),2) }}</td>
                          </tr>
                    </table>
                </div>
                
            </div>
        </div>
        
    @endsection
