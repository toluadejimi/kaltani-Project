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
                        <h4> Create Role</h4>
                    </div>
                    <div class="card-body">
                        <form action="/createRole" method="post">
                            @csrf
                            <div class="col-md-6">

                                <label for="" class="mr-4">Role Title</label>
                                <div class="form-group mr-4">
                                    <input type="text" name="name" class="form-control">
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
                <h4>Role List</h4>
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Role Title</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($role as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>
                                <form action="/roleDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/manage/role_edit/{{$item->id}}" class="btn btn-info"><i class="fa-light fa-pen-to-square"></i></a>
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