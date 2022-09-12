@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="card mt-4">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-solid fa-cart-flatbed-boxes"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Materials Available</h4>
              </div>
              <div class="card-body">
                {{number_format($collected) ?? 0}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-solid fa-money-bill-transfer"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Sorted</h4>
              </div>
              <div class="card-body">
                {{number_format($sorted) ?? 0}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-solid fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Bailed</h4>
              </div>
              <div class="card-body">
                {{number_format($bailed) ?? 0}}
              </div>
            </div>
          </div>
        </div>
      </div>
      
        
        <div class="row">
            <div class="col-md-12 shadow-sm table-responsive">
                
                    <div class="row p-2">
                        <div class="col-md-8">
                            <p>Latest Sorting</p>
                        </div>
                        <div class="col align-self-end">
                            <p class="text-end">Available Stock: {{$sorted ?? 0}}KG</p>
                        </div>
                    </div>

                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                          <th >Clean Clear</th>
                            <th >Green Colour</th>
                            <th >Others</th>
                            <th >Trash</th>
                            <th >Total</th>
                            <th >Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse ($sorting as $item)
                        <tr>
                            <td>{{$item->Clean_Clear}}</td>
                            <td>{{$item->Green_Colour}}</td>
                            <td>{{$item->Others}}</td>
                            <td>{{$item->Trash}}</td>
                            <td>
                              {{($item->Clean_Clear + $item->Green_Colour + $item->Others + $item->Trash)}}
                            </td>
                            <td>
                              {{$item->created_at->format('D, d M Y ')}}
                            </td>
                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
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
        <div class="row">
          <div class="col-md-12 shadow-sm table-responsive">
              
                  <div class="row p-2">
                      <div class="col-md-8">
                          <p>Latest Bailed</p>
                      </div>
                      <div class="col align-self-end">
                          <p class="text-end">Available Stock:{{$bailed ?? 0}} KG</p>
                      </div>
                  </div>

              <table class="table table-striped mb-0">
                  <thead>
                      <tr>
                        <th >Clean Clear</th>
                            <th >Green Colour</th>
                            <th >Others</th>
                            <th >Trash</th>
                            <th >Total</th>
                            <th >Date</th>
                            <th>Time</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                      @forelse ($bailing as $item)
                        <tr>
                            <td>{{$item->Clean_Clear}}</td>
                            <td>{{$item->Green_Colour}}</td>
                            <td>{{$item->Others}}</td>
                            <td>{{$item->Trash}}</td>
                            <td>
                              {{($item->Clean_Clear + $item->Green_Colour + $item->Others + $item->Trash)}}
                            </td>
                            <td>
                              {{$item->created_at->format('D, d M Y ')}}
                            </td>
                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>
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
        
</div>
@endsection
