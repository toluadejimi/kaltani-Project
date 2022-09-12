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
            <h4> Create Sorting</h4>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <form action="/itemBailed" method="post" id="add_form">
                    @csrf
                    <div class="row d-flex p-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> Select Date</label>
                                    <input type="date" name="sort_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Collection Center</label>
                                    <select name="location" id="" class="form-control">
                                        @forelse ($collection as $items)
                                        <option value="{{$items->id}}">{{$items->name}}</option>
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
                                    <label for=""> Select Items</label>
                                    <select name="item" id="" class="form-control">
                                        {{-- {{$bailingItems}} --}}
                                        @forelse ($bailingItems as $items)
                                        <option value="{{$items->id}}">{{$items->item}}</option>
                                        @empty
                                        <option value="">No Record Found </option>
                                        @endforelse
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Enter Weight(Kg)</label>
                                    <input type="number" name="item_weight" id="" class="form-control">
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
            <h4>Latest Bailed</h4>
            <table id="myTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th >Collection Centers</th>
                        <th >Bailed Items</th>
                        <th >Weight(Kg)</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bailing as $item)
                    <tr>
                        <td >{{$item->location->name}}</td>
                        <td >{{$item->bailed()}}</td>
                        <td>
                            {{$item->item_weight}}
                        </td>
                        <td  >
                            <form action="" method="post">
                                <a href="/{{$item->id}}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr colspan="20" class="text-center">
                            <td colspan="20">
                                Bailed Record Not Found
                            </td>
                        </tr>
                    @endforelse
                    
                    
                </tbody>
            </table>
        </div>
    
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".add_item_btn").click(function(e){
            e.preventDefault();
            $("#show_item").prepend(`
            <div class="row d-flex pl-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Select Items</label>
                                <select name="sort_item[]" id="" class="form-control">
                                @forelse ($bailingItems as $items)
                                <option value="{{$items->id}}">{{$items->item}}</option>
                                @empty
                                <option value="">No Record Found </option>
                                @endforelse
                                
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="">Enter Weight(Kg)</label>
                                    <input type="number" name="sort_item_weight[]" id="" class="form-control">
                                </div>
                        </div>
                        <div class="col-md-4 p-4">
                            <button class="btn btn-danger remove_item_btn">
                                Remove
                            </button>
                        </div>
                    </div>
            `);
        });
        $(document).on('click','.remove_item_btn',function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
</script>

@endsection
