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
            <h4> Create Sorted Transfer</h4>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <form action="/sorted_transfers" method="post" id="add_form">
                    @csrf
                    <div class="row d-flex p-4">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">From Collection Center</label>
                                    <select name="toLocation" id="" class="form-control">
                                        @forelse ($collection as $items)
                                        <option value="{{$items->id}}">{{$items->name}}</option>
                                        @empty
                                        <option value="">No Record Found </option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">To Collection Center</label>
                                    <select name="fromLocation" id="" class="form-control">
                                        @forelse ($collection as $items)
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
                                    <select name="item_id" id="" class="form-control">
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
                                        <label for="">Clean Clear</label>
                                        <input type="number" name="Clean_Clear" class="form-control" value="0" required>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Green Colour</label>
                                        <input type="number" name="Green_Colour" class="form-control" value="0" required>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Others</label>
                                        <input type="number" name="Others" class="form-control" value="0" required>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Trash</label>
                                        <input type="number" name="Trash" class="form-control" value="0" required>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Caps</label>
                                    <input type="number" name="Caps" class="form-control" value="0" required>
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
            <h4>Latest Sorted Transfer</h4>
            <table id="myTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th >From</th>
                        <th >To</th>
                        <th >Weight(Kg)</th>
                        <th >Date</th>
                        <th >Time</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sortedTransfer as $item)
                    <tr>
                        <td >{{$item->formlocation->name ?? ""}}</td>
                        <td >{{$item->tolocation->name ?? ""}}</td>
                        <td >
                            {{($item->Clean_Clear + $item->Green_Colour + $item->Others + $item->Trash + $item->Caps)}}
                        </td>
                        <td>
                            {{$item->created_at->format('D, d M Y ')}}
                          </td>
                          <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                        <td  >
                            <form action="/sortedTransferDeleted/{{$item->id}}" method="post">
                                @csrf
                                   @method('DELETE')
                                
                                <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr colspan="20" class="text-center">
                            <td colspan="20">
                                No Record Found
                            </td>
                        </tr>
                    @endforelse
                    
                    
                </tbody>
            </table>
        </div>
    
    </div>
</div>


@endsection
