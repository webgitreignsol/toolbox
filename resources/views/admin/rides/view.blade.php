@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Rides Lists</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Passenger</th>
                        <th>Driver</th>
                        <th>Drop Off</th>
                        <th>Pick Up</th>
                        <th>Time</th>
                        <th>Ride Type</th>
                        <th>Fare</th>
                        <th>Status</th>
                        <th>Actio n</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                        <td>1</td>
                        <td>{{ $ride->user->name }}</td>
                        <td>{{ $ride->user->name }}</td>
                        <td>{{ $ride->drop_off }}</td>
                        <td>{{ $ride->pick_up }}</td>
                        <td>{{ $ride->time }}</td>
                        <td>@if($ride->type == 0)
                         Shared 
                         @else 
                         Private 
                         @endif</td>
                        <td>{{ $ride->fare }}</td>
                        <td>@if($ride->status == 0 )
                            Completed 
                            @elseif($ride->status == 1 )
                             Cancelled
                            @else
                             Active   
                            @endif 
                        </td>                                        
                        <td>
                            <a href="{{ route('rides.view', $ride->id) }}" class="btn btn-primary">View </a>
                        
                        </td>
                      </tr>
                      
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

@push('js')
    <!-- Sweet Alert Js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.all.min.js"></script>

    
@endpush