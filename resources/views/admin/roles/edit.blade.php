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
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Type</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="type" id="type" class="form-control selectric" required>
                                <option value="">:: Select Type::</option>
                                <option value="Admin" <?php if($role->type=="Admin"){ echo 'selected'; } ?>>Admin</option>
                                <option value="Vendor" <?php if($role->type=="Vendor"){ echo 'selected'; } ?>>Vendor</option>
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
                        <tr>
                            <td>Products Management</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-list]', 'product-list', $role->hasPermissionTo('product-list')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-create]', 'product-create', $role->hasPermissionTo('product-create')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-edit]', 'product-edit', $role->hasPermissionTo('product-edit')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[product-delete]', 'product-delete', $role->hasPermissionTo('product-delete')) }}
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
                                    {{ Form::checkbox('permission[vendor-list]', 'vendor-list', $role->hasPermissionTo('vendor-list')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-create]', 'vendor-create', $role->hasPermissionTo('vendor-create')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-edit]', 'vendor-edit', $role->hasPermissionTo('vendor-edit')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[vendor-delete]', 'vendor-delete', $role->hasPermissionTo('vendor-delete')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Delete</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Shop</td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-list]', 'shop-list', $role->hasPermissionTo('shop-list')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-create]', 'shop-create', $role->hasPermissionTo('shop-create')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-edit]', 'shop-edit', $role->hasPermissionTo('shop-edit')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[shop-delete]', 'shop-delete', $role->hasPermissionTo('shop-delete')) }}
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
                                    {{ Form::checkbox('permission[category-list]', 'category-list', $role->hasPermissionTo('category-list')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-create]', 'category-create', $role->hasPermissionTo('category-create')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-edit]', 'category-edit', $role->hasPermissionTo('category-edit')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[category-delete]', 'category-delete', $role->hasPermissionTo('category-delete')) }}
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
                                    {{ Form::checkbox('permission[rider-list]', 'rider-list', $role->hasPermissionTo('rider-list')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>List</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-create]', 'rider-create', $role->hasPermissionTo('rider-create')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Create</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-edit]', 'rider-edit', $role->hasPermissionTo('rider-edit')) }}
                                    <div class="state p-info">
                                        <i class="icon material-icons">done</i>
                                        <label>Edit</label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="pretty p-icon p-jelly p-round p-bigger">
                                    {{ Form::checkbox('permission[rider-delete]', 'rider-delete', $role->hasPermissionTo('rider-delete')) }}
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
                                    {{ Form::checkbox('permission[order-list]', 'order-list', $role->hasPermissionTo('order-list')) }}
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
                                    {{ Form::checkbox('permission[ride-list]', 'ride-list', $role->hasPermissionTo('ride-list')) }}
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
                                    {{ Form::checkbox('permission[account-list]', 'account-list', $role->hasPermissionTo('account-list')) }}
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
