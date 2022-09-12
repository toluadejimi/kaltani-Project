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
                <div class="col-md-12 p-2">
                    <div class="card-header">
                        <h4> Create Location</h4>
                    </div>
                    <form action="/createLocation" method="post" class="mb-4 p-2">
                        @csrf
                        <div class="row d-flex">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="f"> Factory</option>
                                        <option value="c"> Collection Center</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" value="Create Location" class="btn btn-primary">
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
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Sate</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($location as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->state }}</td>
                                    <td>
                                        @if ($item->type == 'f')
                                        Factory
                                        @elseif ($item->type == 'c')
                                        Collection Center
                                        @endif
                                    </td>
                                    <td>
                                        <form action="" method="post">
                    
                                            <a href="/{{ $item->id }}" class="btn btn-info"><i
                                                    class="fa-light fa-pen-to-square"></i></a>
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa-light fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr colspan="20" class="text-center">
                                    <td colspan="20">No Location Found</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    @endsection
