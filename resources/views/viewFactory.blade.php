@extends('layouts.main')
@section('content')
<div class="main-content">
    <div class="card mt-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-solid fa-arrow-down-triangle-square"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Input</h4>
              </div>
              <div class="card-body">
                {{number_format($input ?? 0)}}kg
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-solid fa-arrow-up-triangle-square"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Output</h4>
              </div>
              <div class="card-body">
                {{number_format($output ?? 0)}}kg
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-solid fa-soap"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Costic Soda</h4>
              </div>
              <div class="card-body">
                {{number_format($soda ?? 0)}}kg
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-solid fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Detergent</h4>
              </div>
              <div class="card-body">
                {{number_format($detergent ?? 0)}}kg
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-md-12 shadow-sm table-responsive">
              
                  <div class="row p-2">
                      <div class="col-md-8">
                          <p>{{$factory->name}}</p>
                      </div>
                      <div class="col align-self-end">
                          <p class="text-end">Available Stock: {{$output ?? 0}} KG</p>
                      </div>
                  </div>

              <table class="table table-striped mb-0">
                  <thead>
                      <tr>
                        <th >Clean Clear</th>
                            <th >Green Colour</th>
                            <th >Others</th>
                            <th >Trash</th>
                            <th >Caps</th>
                            <th >Total</th>
                            <th >Date</th>
                            <th>Time</th>
                      </tr>
                  </thead>
                  <tbody>
                      
                      @forelse ($transfer as $item)
                        <tr>
                            <td>{{$item->Clean_Clear}}kg</td>
                            <td>{{$item->Green_Colour}}kg</td>
                            <td>{{$item->Others}}kg</td>
                            <td>{{$item->Trash}}kg</td>
                            <td>{{$item->Caps}}kg</td>
                            <td>
                              {{($item->Clean_Clear + $item->Green_Colour + $item->Others + $item->Trash)}}kg
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
