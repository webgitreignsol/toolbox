@extends('admin.layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Driver Sessions</h4>
              </div>
              {!! Form::model($session, ['method' => 'post','route' => ['session.update', $session->id]]) !!}
                <div class="card-body">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control"  placeholder="Name" value="{{ $session->driver->name }}" readonly>                   
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Time</label>
                  <div class="col-sm-12 col-md-7">
                   <input type="time" class="form-control" name="start_time" value="{{ $session->start_time }}">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">End Time</label>
                  <div class="col-sm-12 col-md-7">
                   <input type="time" class="form-control" name="end_time" value="{{ $session->end_time }}">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                  <div class="col-sm-12 col-md-7">
                    <select name="status" class="form-control selectric">
                      @if($session->status == 1)
                      <option selected value="1">Active</option>
                      <option value="0">Inactive</option>                      
                      @else
                      <option value="1">Active</option>
                      <option selected value="0">Inactive</option>
                      @endif
                      
                     
                    </select>
                                
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
