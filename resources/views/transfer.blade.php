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
            <h4> Create Transfer</h4>
        </div>
        <div class="row">
            <div class="col-md-12 p-2">
                <form action="/transferd" method="post" id="add_form">
                    @csrf
                    <div class="row d-flex p-4">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Collection Center</label>
                                    <select name="collection_id" id="" class="form-control">
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
                                    <label for="">Select Factory</label>
                                    <select name="factory_id" id="" class="form-control">
                                        @forelse ($factory as $items)
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
                                        <label for="">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="0" required>
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
            <h4>Latest Transfer</h4>
            <table id="myTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th >From</th>
                        <th >To</th>
                        <th>Clean Clear</th>
                        <th>Green Colour</th>
                        <th>Others</th>
                        <th>Trash</th>
                        <th >Clean Clear Qty</th>
                        <th >Green Colour Qty</th>
                        
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transfer as $item)
                    <tr>
                        <td ><a href="/viewTransfer/{{$item->id}}">{{$item->location->name}}</a></td>
                        <td ><a href="/viewTransfer/{{$item->id}}">{{$item->factory->name}}</a></td>
                        <td >{{$item->Clean_Clear}}kg</td>
                            <td >{{$item->Green_Colour}}kg</td>
                            <td >{{$item->Others}}kg</td>
                            <td >{{$item->Trash}}kg</td>
                        <td >{{$item->clean_clear_qty}}</td>
                        <td >{{$item->green_color_qty}}</td>
                        
                       
                        <td  >
                            <form action="/tranferDeleted/{{$item->id}}" method="post">
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
<script>

$(document).ready(function(){  

$("select").on('focus', function () {
      $("select").find("option[value='"+ $(this).val() + "']").attr('disabled', false);
  }).change(function() {

      $("select").not(this).find("option[value='"+ $(this).val() + "']").attr('disabled', true);

  });


});
    $(document).ready(function(){
        $(".add_item_btn").click(function(e){
            var map = {}
            e.preventDefault();
            $("#show_item").prepend(`
            <div class="row d-flex pl-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> Select Items</label>
                                <select name="transfer_item[]" id="transfer_item" onchange="myFunction()" class="form-control" required>
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
                                    <input type="number" name="item_weight[]" id="" class="form-control" required>
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
