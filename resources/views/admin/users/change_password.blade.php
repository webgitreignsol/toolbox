@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Change Your Password</h4>
              </div>
              {!! Form::open(array('route' => 'users.change.password','method'=>'POST')) !!}
                <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                  <div class="col-sm-12 col-md-7">
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                  </div>
                </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New Password</label>
                        <div class="col-sm-12 col-md-7">
                            {!! Form::password('new_password', array('placeholder' => 'New Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Confirm Password</label>
                  <div class="col-sm-12 col-md-7">
                    {!! Form::password('new_password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                  </div>
                </div>
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
