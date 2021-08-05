@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Cancelled Rides Lists</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                          <th>Shop</th>
                          <th>Drop Off</th>
                          <th>Pick Up</th>
                        <th>Customer</th>
                        <th>Rider</th>
                          <th>Reason</th>
                          <th>Cancell By</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($rides as $key => $ride)
                      <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $ride->shop->name }}</td>
                          <td>{{ $ride->drop_off }}</td>
                          <td>{{ $ride->pick_up }}</td>
                          <td>{{ $ride->customer->name }}</td>
                          <td>{{ $ride->rider->name }}</td>
                          <td>{{ $ride->cancel_reason }}</td>
                          <td>{{ $ride->cancell->name }}</td>
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
@endpush
