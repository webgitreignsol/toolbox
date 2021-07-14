@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Update Commission
                        </div>
                        {!! Form::model($commission, ['method' => 'PUT','route' => ['commission.update', $commission->id]]) !!}
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Value</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('value', null, array('placeholder' => 'Value','class' => 'form-control')) !!}
                                </div>
                                Last Modified
                                <br>
                                {{ (!empty($commission->updated_at)) ? $commission->updated_at : '- -' }}
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                <div class="col-sm-12 col-md-7">
                                    {!! Form::text('percent', null, array('placeholder' => 'Type','class' => 'form-control')) !!}
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
