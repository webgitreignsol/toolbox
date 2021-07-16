@extends('admin.layouts.master')


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Ride Revenue</h4>
                        </div>
                        {!! Form::model($order, ['method' => 'PUT','route' => ['reports.update', $order->id]]) !!}
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ride Fare</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('ride_fare', null, array('placeholder' => 'Ride Fare','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Taxes</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('taxes', null, array('placeholder' => 'Ride Fare','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Parent Ride</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('parent_id', null, array('placeholder' => 'Parent Ride','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Driver</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="driver_id" id="driver_id" class="form-control selectric" required>
                                        <option value="">:: Select Driver ::</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" <?php if($order->driver_id==$user->id){ echo 'selected'; } ?>>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Passenger</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="passenger_id" id="passenger_id" class="form-control selectric" required>
                                        <option value="">:: Select Passenger ::</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" <?php if($order->passenger_id== $user->id){ echo 'selected'; } ?>>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Type</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="type" id="type" class="form-control selectric" required>
                                        <option value="">:: Select Type ::</option>
                                        <option value="0" <?php if($order->type=="0"){ echo 'selected'; } ?>>Shared</option>
                                        <option value="1" <?php if($order->type=="1"){ echo 'selected'; } ?>>Private</option>
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
