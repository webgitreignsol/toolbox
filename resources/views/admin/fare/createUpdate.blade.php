@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Update Miles , Minutes And Commission
                        </div>
                        {!! Form::model($fare, ['method' => 'PUT','route' => ['fare.update', $fare->id]]) !!}
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Per Mile</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('per_mile', null, array('placeholder' => 'Per Mile','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Per Minute</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('per_minute', null, array('placeholder' => 'Per Minute','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Willgo Commission</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::number('willgo_commission', null, array('placeholder' => 'Willgo Commission','class' => 'form-control')) !!}
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
