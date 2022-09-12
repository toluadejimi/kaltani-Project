@extends('layouts.main')
@section('content')
    <div class="main-content">
        <!-- Row start -->
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
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4> Create Bailing Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="/createBailingItem" method="post">
                            @csrf
                            <div class="row d-flex">
                                <div class="col-md-6">

                                    <label for="" class="mr-4">Bailing Item Title</label>
                                    <div class="form-group mr-4">
                                        <input type="text" name="bailing_item" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
    
                                    <div class="form-group">
                                        <label for=""> Select Items</label>
                                        <select name="item_id" id="" class="form-control">
                                            
                                            @forelse ($mainItems as $it)
                                            <option value="{{$it->id}}">{{$it->item}}</option>
                                            @empty
                                            <option value="">No Record Found </option>
                                            @endforelse
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-12 shadow-sm">
                <h4>Bailing Item List</h4>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Item Title</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{$item->item}}</td>
                            <td>
                                <form action="/bailedDelete/{{$item->id}}" method="post">
                                    @csrf
                                   @method('DELETE')
                                    <a href="/bailing_item_edit/{{$item->id}}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
                                </form>
                            </td>
                            
                        </tr>
                        @empty
                            <tr colspan="20" class="text-center">No Record Found</tr>
                        @endforelse
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
       
        

    </div>
    <!-- Dashboard wrapper end -->

</div>
<!-- Main Container end -->
    </div>

    
@endsection