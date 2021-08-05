@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Shops Lists</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                          <th>Status</th>
                          <th>Approval</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($shops as $key => $shop)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $shop->name }}</td>
                        <td>{{ $shop->description }}</td>
                          <td>
                              <form name="formStatus" id="formStatus" method="post" action="{{ route('shop.status',$shop->id) }}">
                                  @csrf
                                  @method('PUT')
                                  @if($shop->status == 0)
                                      <button class="btn btn-danger btn-sm">Deactive</button>
                                  @else
                                      <button class="btn btn-info btn-sm">Active</button>
                                  @endif
                              </form>
                          </td>
                          <td>
                              <form name="formApprove" id="formApprove" method="post" action="{{ route('shop.approve',$shop->id) }}">
                                  @csrf
                                  @method('PUT')
                                  @if($shop->approve == 'No')
                                      <button class="btn btn-danger btn-sm">No</button>
                                  @else
                                      <button class="btn btn-info btn-sm">Yes</button>
                                  @endif
                              </form>
                          </td>
                        <td>
                            @can('shop-edit')
                               <a class="btn btn-primary" href="{{ route('shop.edit',$shop->id) }}">Edit</a>
                            @endcan
                            @can('shop-delete')
                            <button class="btn btn-danger" type="button" onclick="deleteItem({{ $shop->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <form id="delete-form-{{ $shop->id }}" action="{{ route('shop.destroy', $shop->id) }}" method="post"
                                  style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
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
