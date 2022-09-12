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
        <div class="card-header">
            <h4> Create Collection</h4>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <form action="/collect" method="post" id="add_form">
                    @csrf
                    <div class="row d-flex p-4">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Collection Center</label>
                                    <select name="location" id="" class="form-control">
                                        @forelse ($center as $items)
                                        <option value="{{$items->id}}">{{$items->name}}</option>
                                        @empty
                                        <option value="">No Record Found </option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Item</label>
                                    <select name="item" id="" class="form-control">
                                        @forelse ($item as $items)
                                        <option value="{{$items->id}}">{{$items->item}}</option>
                                        @empty
                                        <option value="">No Record Found </option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div id="show_item">
                        <div class="row d-flex pl-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Select Date</label>
                                    <input type="date" name="created_at" class="form-control">
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Enter Weight(Kg)</label>
                                    <input type="number" name="item_weight" id="" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" name="amount" id="" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Price Per Kg</label>
                                    <input type="text" name="price_per_kg" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Transport</label>
                                    <input type="text" name="transport" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Loader</label>
                                    <input type="text" name="loader" class="form-control" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Others</label>
                                    <input type="text" name="others" class="form-control" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-md-2 p-4">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12 shadow-sm table-responsive">
            <h4>Latest Collected</h4>
            <table id="myTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        
                        <th >Location</th>
                        <th >Items Weight(Kg)</th>
                        <th >Amount</th>
                        <th >Date</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($collections as $item)
                    <tr>
                        
                        <td>
                            <a href="/collectionDetails/{{$item->id}}">{{$item->location->name}}</a>
                        </td>
                        <td >{{$item->item_weight}}kg</td>
                        <td >₦{{number_format($item->amount, 2)}}</td>
                        <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                        <td  >
                            <form action="/deleteCollection/{{$item->id}}" method="post">
                                @csrf
                                    @method('DELETE')
                                
                                <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr colspan="20" class="text-center">
                            <td colspan="20">
                                 Record Not Found
                            </td>
                        </tr>
                    @endforelse
                    
                    
                </tbody>
            </table>
        </div>
    
    </div>
</div>


@endsection
