@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Create New Role</h4>
              </div>
              {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role Name</label>
                  <div class="col-sm-12 col-md-7">
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                  </div>
                </div>

                <table class="table table-bordered table-striped text-center mb-3 table-responsive-xl">
                    <thead>
                    <tr>
                        <th>Model</th>
                        <th>List</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Roles</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-list]', 'role-list') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-create]', 'role-create') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-edit]', 'role-edit') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-delete]', 'role-delete') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Permissions</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-list]', 'permission-list') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-create]', 'permission-create') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-edit]', 'permission-edit') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-delete]', 'permission-delete') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                  </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Admins</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-list]', 'user-list') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-create]', 'user-create') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-edit]', 'user-edit') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-delete]', 'user-delete') }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    <tr>
                        <td>Drivers</td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[driver-list]', 'driver-list') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[driver-create]', 'driver-create') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[driver-edit]', 'driver-edit') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[driver-delete]', 'driver-delete') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Passengers</td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[passenger-list]', 'passenger-list') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[passenger-create]', 'passenger-create') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[passenger-edit]', 'passenger-edit') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="pretty p-icon p-jelly p-round p-bigger">
                                {{ Form::checkbox('permission[passenger-delete]', 'passenger-delete') }}
                                <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                        <tr>
                            <td>Car Type</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[car-list]', 'car-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[car-create]', 'car-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[car-edit]', 'car-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[car-delete]', 'car-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Rides</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[ride-list]', 'ride-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Setting</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[setting-list]', 'setting-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>

                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Reports</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[report-list]', 'report-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>

                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
</section>
@endsection
