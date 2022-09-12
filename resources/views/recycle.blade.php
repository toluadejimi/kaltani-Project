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
                <div class="col-md-12">
                    <div class="card-header">
                        <h4> Create Recycle</h4>
                    </div>
                    <form action="/addrecycle" method="post" class="mb-4 ">
                        @csrf
                        <div class="row d-flex">
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Weight Out</label>
                                    <input type="text" name="item_weight_output" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Costic Soda</label>
                                    <input type="text" name="costic_soda" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Detergent </label>
                                    <input type="text" name="detergent" class="form-control">
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
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Weight In</th>
                                <th>Costic soda</th>
                                <th>Detergent</th>
                                <th>Weight Out</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recycled as $item)
                                <tr>
                                    <td>{{ $item->factory->name }}</td>
                                    <td>{{ $item->item_weight_input }}kg</td>
                                    <td>{{ $item->costic_soda }}kg</td>
                                    <td>{{ $item->detergent }}kg</td>
                                    <td>{{ $item->item_weight_output }}kg</td>
                                    <td>{{$item->created_at->format('D, d M Y ')}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
                                    <td>
                                        <form action="/recycleDelete/{{$item->id}}" method="post">
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
                    </table>
                </div>
                
            </div>
        </div>
    @endsection
