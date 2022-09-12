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
                <form action="/sorted" method="post" id="add_form">
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
                                        <label for="">Clean Clear</label>
                                        <input type="number" name="Clean_Clear" class="form-control" value="{{$item->Clean_Clear}}" required>
                                    </div>
                            </div>
                            <div class="col-md-4">                           
                                <div class="form-group">
                                    <label for="">Green Colour</label>
                                    <input type="number" name="Green_Colour" class="form-control" value="{{$item->Clean_Clear}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">                           
                                <div class="form-group">
                                    <label for="">Others</label>
                                    <input type="number" name="Others" class="form-control" value="{{$item->Clean_Clear}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">                           
                                <div class="form-group">
                                    <label for="">Clean Clear</label>
                                    <input type="number" name="Clean_Clear" class="form-control" value="{{$item->Clean_Clear}}" required>
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
@endsection