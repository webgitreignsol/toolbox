@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Riders Lists</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                          <th>Role</th>
                          <th>Status</th>
                          <th>Approval</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $key => $user)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                   <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                          <td>
                              <form name="formStatus" id="formStatus" method="post" action="{{ route('rider.status',$user->id) }}">
                                  @csrf
                                  @method('PUT')
                                  @if($user->status == 0)
                                      <button class="btn btn-danger btn-sm">Deactive</button>
                                  @else
                                      <button class="btn btn-info btn-sm">Active</button>
                                  @endif
                              </form>
                          </td>
                          <td>
                              <form name="formApprove" id="formApprove" method="post" action="{{ route('rider.approve',$user->id) }}">
                                  @csrf
                                  @method('PUT')
                                  @if($user->approve == 'No')
                                      <button class="btn btn-danger btn-sm">No</button>
                                  @else
                                      <button class="btn btn-info btn-sm">Yes</button>
                                  @endif
                              </form>
                          </td>
                        <td>
                            @can('user-edit')
                               <a class="btn btn-primary" href="{{ route('rider.edit',$user->id) }}">Edit</a>
                            @endcan
                            @can('user-delete')
                            <button class="btn btn-danger" type="button" onclick="deleteItem({{ $user->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('rider.destroy', $user->id) }}" method="post"
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
