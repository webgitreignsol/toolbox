@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Role</h4>
              </div>
              {!! Form::model($role, ['method' => 'PUT','route' => ['roles.update', $role->id]]) !!}
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
                                  {{ Form::checkbox('permission[role-list]', 'role-list', $role->hasPermissionTo('role-list')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-create]', 'role-create', $role->hasPermissionTo('role-create')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div> 
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-edit]', 'role-edit', $role->hasPermissionTo('role-edit')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[role-delete]', 'role-delete', $role->hasPermissionTo('role-delete')) }}
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
                                  {{ Form::checkbox('permission[permission-list]', 'permission-list', $role->hasPermissionTo('permission-list')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-create]', 'permission-create', $role->hasPermissionTo('permission-create')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div> 
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-edit]', 'permission-edit', $role->hasPermissionTo('permission-edit')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[permission-delete]', 'permission-delete', $role->hasPermissionTo('permission-delete')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                  </div>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>Users</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-list]', 'user-list', $role->hasPermissionTo('user-list')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>List</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-create]', 'user-create', $role->hasPermissionTo('user-create')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Create</label>
                                  </div>
                                </div> 
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-edit]', 'user-edit', $role->hasPermissionTo('user-edit')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Edit</label>
                                  </div>
                                </div>
                            </td>
                            <td>
                               <div class="pretty p-icon p-jelly p-round p-bigger">
                                  {{ Form::checkbox('permission[user-delete]', 'user-delete', $role->hasPermissionTo('user-delete')) }}
                                  <div class="state p-info">
                                    <i class="icon material-icons">done</i>
                                    <label>Delete</label>
                                  </div>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-primary">Update</button>
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