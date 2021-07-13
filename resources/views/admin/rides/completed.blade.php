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
                      @foreach ($rides as $ride)                     
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $ride->passenger->name }}</td>
                        <td>{{ $ride->driver->name }}</td>
                        <td>{{ $ride->drop_off }}</td>
                        <td>{{ $ride->pick_up }}</td>
                        <td>{{ $ride->time }}</td>
                        <td>@if($ride->type == 0)
                            Shared 
                            @else 
                            Private 
                            @endif
                        </td>
                        <td>{{ $ride->fare }}</td>
                        <td>@if($ride->status == 0 )
                            Accepted 
                            @elseif($ride->status == 1 )
                            Completed
                            @else
                            Accepted   
                            @endif 
                        </td>                                        
                        <td>
                            <a href="#" class="btn btn-primary">View </a>                           
                        </td>
                      </tr>
                      @endforeach
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

    <script type="text/javascript">
        function deleteItem(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush