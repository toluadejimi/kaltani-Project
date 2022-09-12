@extends('layouts.main')
@section('content')
    <div class="main-content">
        <!--<div class="card mt-4 p-4">-->
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
            <!--<div class="row">-->
            <!--    <div class="col-md-12 p-2">-->
            <!--        <div class="card-header">-->
            <!--            <h4> Create Factory</h4>-->
            <!--        </div>-->
            <!--        <form action="/createFactory" method="post" class="mb-4 p-2">-->
            <!--            @csrf-->
            <!--            <div class="row d-flex">-->
            <!--                <div class="col-md-3">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for=""> Name</label>-->
            <!--                        <input type="text" name="name" class="form-control">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col-md-3">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="">Address</label>-->
            <!--                        <input type="text" name="address" class="form-control">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col-md-3">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="">City</label>-->
            <!--                        <input type="text" name="city" class="form-control">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col-md-3">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="">State</label>-->
            <!--                        <input type="text" name="state" class="form-control">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col-md-2">-->
            <!--                    <input type="submit" value="Create Factory" class="btn btn-primary">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </form>-->
            <!--    </div>-->
            <!--</div>-->
        <!--</div>-->
            <div class="row mt-4 p-4">
                <div class="col-md-12 shadow-sm table-responsive">
                    <div class="card-header">
                        <h6> Collection Center List</h6>
                    </div>
                    <table id="myTable" class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Sate</th>
                                <!--<th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collectioncenter as $item)
                                <tr>
                                    <td><a href="/collection_center_details/{{$item->id}}">{{$item->name}}</a></td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->state }}</td>
                                   
                                </tr>
                            @empty
                                <tr colspan="20" class="text-center">
                                    <td colspan="20">No Record Found</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    @endsection
