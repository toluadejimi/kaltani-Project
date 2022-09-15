@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="card mt-4">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Order ID</h4>
                <p>{{$order_id}}</p>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Weight (KG)</h4>
                <p>{{$weight}}</p>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
          
            <div class="card-wrap">
              <div class="card-header">
                <h4>Amount (NGN)</h4>
                <p>{{$amount}}</p>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Collection Center</h4>
                <p>{{$collection_center}}</p>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Recycler</h4>
                <p>{{$customer}}</p>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
          
            <div class="card-wrap">
              <div class="card-header">
                <h4>Status</h4>
              
                @if($status =='0')         
                             <div><span class="badge rounded-pill bg-warning text-dark">Pending</span></br></div>         
                             @else
                             <div><span class="badge rounded-pill bg-success">Completed</span></div>        
                             @endif
            </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
          
            <div class="card-wrap">
              <div class="card-header">
                <h4>Recycler Image</h4>
                <div><img src="{{ url('public/upload/customer/'.$image)}}"  width="300px" height="300px"/></div>
              </div>
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-wrap">
              <div class="card-header">
                <h4>Agent Image</h4>
                <div><img src="{{ url('public/upload/agent/'.$agent_image)}}"  width="300px" height="300px"/></div>
              </div>
              <div class="card-body">
                

              </div>
            </div>
          </div>
        </div>
        


        
        



        </div>

          <div>
                                <form action="/dropoffDelete/{{$id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can">Delete</i></button>
                                </form>
          </div>

      </div>
      
       
        
          
      
      </div>

      
    </div>
        
</div>
@endsection
