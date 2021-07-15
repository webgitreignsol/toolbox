@extends('admin.layouts.master')
@section('content')

@php
$i = 1;
@endphp
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Reports</h4>
              </div>

              <form action="{{ route('reports.search') }}" method="post">
                  @csrf
                  <div class="col-sm-12">
                     <div class="row">
                        <div class="col-sm-3 text-right">
                           <h4 style="margin-top: 1%;">Search</h4>
                        </div>
                        <div class="col-sm-3 ">
                           <input type="text" class="form-control datepicker" name="from_date">
                        </div>
                        <div class="col-sm-3">
                           <input type="text" class="form-control datepicker" name="from_to">
                        </div>
                        <div class="col-sm-3">
                           <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        </div>
                     </div>
                  </div>
               </form>
               <br>
               <br>
               <br>
               <div class="row" style="margin:10px;">
             <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Rides</h5>
                          <h2 class="mb-3 font-18"> @if(isset($searchRide)) {{$searchRide}}@else {{$ride}}@endif</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Passengers</h5>
                          <h2 class="mb-3 font-18">@if(isset($searchOrder)) {{$searchOrder}}@else {{count($orders)}}@endif</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Sales</h5>
                          <h2 class="mb-3 font-18">@if(isset($pluck)) {{$pluck}} @else {{$sum}} @endif</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Revenue</h5>
                          <h2 class="mb-3 font-18">@if(isset($pluck)) {{ $pluck * $searchrevenue /100 }}   @else {{ $sum * $revenue /100 }} @endif</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Passenger</th>
                        <th>Driver</th>
                        <th>Fare</th>
                        <th>Ride Type</th>
                        <th>Shared Ride</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(isset($logs))
                       @foreach ($logs as $order)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $order->passenger->name }}</td>
                        <td>{{ $order->driver->name }}</td>
                        <td>{{ $order->ride_fare }}</td>
                         <td>@if($order->type == 0)
                            Shared
                            @else
                            Private
                            @endif
                        </td>
                        <td>
                            @if($order->type == 1) N/A @else {{ $order->parent_id }}@endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary">View </a>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      @foreach ($orders as $order)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $order->passenger->name }}</td>
                        <td>{{ $order->driver->name }}</td>
                        <td>{{ $order->ride_fare }}</td>
                         <td>@if($order->type == 0)
                            Shared
                            @else
                            Private
                            @endif
                        </td>
                        <td>
                            @if($order->type == 1) N/A @else {{  $order->parent_id }}@endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary">View </a>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
@endsection

