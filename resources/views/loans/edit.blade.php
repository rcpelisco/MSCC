@extends('layouts.master')

@section('title', 'MSCC')

@section('breadcrumbs', Breadcrumbs::render('loans.edit', $loan))

@section('content')
<h1>Edit Loan</h1>
<div class="row">
  <div class="col-md-3">
    {!! Form::open(['action' => ['LoansController@update', $loan->id], 'method' => 'post']) !!}
      <div class="card">
        <div class="card-header">
          <strong>Edit Loan</strong>
          <small>Form</small>
        </div>
        <div class="card-body">
          <div class="form-group">
            {{ Form::label('principal' , 'Principal') }}
            {{ Form::text('principal' , $loan->principal, ['class' => 'form-control' , 'placeholder' => 'Enter Principal']) }}
          </div>
  
          <div class="form-group">
            {{ Form::label('date_released' , 'Date Released') }}
            {{ Form::date('date_released' , $loan->date_released, ['class' => 'form-control' , 'placeholder' => 'Date Released']) }}
          </div>
  
          <div class="form-group">
            {{ Form::label('months_to_pay' , 'Months to Pay') }}
            {{ Form::text('months_to_pay' , $loan->months_to_pay, ['class' => 'form-control' , 'placeholder' => 'Months to Pay']) }}
          </div>
        </div>
        <div class="card-footer">
          <div class="pull-right">
            <button class="btn btn-sm btn-danger" type="reset">
              <i class="fa fa-ban"></i> Reset</button>
            <button class="btn btn-sm btn-primary" type="submit">
              <i class="fa fa-dot-circle-o"></i> Submit</button>
          </div>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection