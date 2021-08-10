@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit User</h4>
              </div>
              {!! Form::model($product, ['method' => 'PUT','route' => ['product.update', $product->id] , 'enctype' => 'multipart/form-data']) !!}
                <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                  <div class="col-sm-12 col-md-7">
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                  </div>
                </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                        <div class="col-sm-12 col-md-7">
                            {!! Form::file('image', null, array('placeholder' => 'Image','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                        <div class="col-sm-12 col-md-7">
                            {!! Form::text('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Shop</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="shop_id" id="shop_id" class="form-control selectric" required>
                                <option value="">:: Select Shop ::</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}" <?php if($product->shop_id== $shop->id){ echo 'selected'; } ?>>{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Category</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="category" id="category" class="form-control selectric" required>
                                <option value="">:: Select Category ::</option>
                                <option value="Old" <?php if($product->category=="Old"){ echo 'selected'; } ?>>Old</option>
                                <option value="New" <?php if($product->category=="New"){ echo 'selected'; } ?>>New</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                        <div class="col-sm-12 col-md-7">
                            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                        </div>
                    </div>
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
