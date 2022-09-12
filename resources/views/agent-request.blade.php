@extends('layouts.main')
@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Agent Request</h1>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-solid fa-user-tie"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pending Request</h4>
                  </div>
                  <div class="card-body">
                    {{$pending_request}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-solid fa-user-tie"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Approved Agent</h4>
                  </div>
                  <div class="card-body">
                    {{$approved_agent}}
                  </div>
                </div>
              </div>
            </div>
            
            
            
            
          
          
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Latest Request</h4>
                  
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table id="myTable" class="table table-striped mb-0">
                      <thead>
                        <tr>
                          <th>Customer Name</th>
                          <th>Organization Name</th>
                          <th>Address</th>
                          <th>State</th>
                          <th>Lga</th>
                          <th>City</th>
                           <th>Phone</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($agent_list as $item)
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->org_name}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->state}}</td>
                            <td>{{$item->lga }}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->phone}}</td>
                            @if($item->status =='0')         
                             <td><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>         
                             @else
                             <td><span class="badge rounded-pill bg-success">Completed</span></td>        
                             @endif
                            <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>  
                            <td>
                                <form action="/userDelete/{{$item->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/agent_request_update/{{$item->id}}" class="btn btn-success"><i class="fa-light fa-thumbs-up"></i></a>
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa-light fa-trash-can"></i></button>
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
            </div>
          </div>
        </section>
      </div>

            
    <!-- Main Container end -->

    
@endsection