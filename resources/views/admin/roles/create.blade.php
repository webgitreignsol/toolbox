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

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Type</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="type" id="type" class="form-control selectric" required>
                                <option value="">:: Select Type ::</option>
                                <option value="Admin">Admin</option>
                                <option value="Vendor">Vendor</option>
                            </select>
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
                            <td>Users</td>
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
                            <td>Products Management</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-list]', 'product-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-create]', 'product-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-edit]', 'product-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-delete]', 'product-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Vendors Management</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-list]', 'vendor-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-create]', 'vendor-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-edit]', 'vendor-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-delete]', 'vendor-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Shops</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-list]', 'shop-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-create]', 'shop-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-edit]', 'shop-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-delete]', 'shop-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-list]', 'category-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-create]', 'category-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-edit]', 'category-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-delete]', 'category-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Riders</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-list]', 'rider-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-create]', 'rider-create') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-edit]', 'rider-edit') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-delete]', 'rider-delete') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Orders</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[order-list]', 'order-list') }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
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
                            <td>My Account</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[account-list]', 'account-list') }}
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
