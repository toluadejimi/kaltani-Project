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
                        <h4> Create Item</h4>
                    </div>
                    <div class="card-body">
                        <form action="/createItem" method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="" class="mr-4">Item Title</label>
                                <div class="form-group mr-4">
                                    <input type="text" name="item" class="form-control">
                                </div>
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-12 shadow-sm">
                <h4>Item List</h4>
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
                                <form action="/itemDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/item_edit/{{$item->id}}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
                                    @csrf
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