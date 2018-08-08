@extends('layouts.master')

@section('title', 'MSCC')

@section('breadcrumbs', Breadcrumbs::render('members.create'))

@section('content')
<h1>Create Member</h1>
<div class="row">
  <div class="col-md-6">
    {!! Form::open(['action' => 'MembersController@store' , 'method' => 'post']) !!}
      <div class="card">
        <div class="card-header">
          <strong>Basic Information</strong>
          <small>Form</small>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                {{Form::label('first_name' , 'First Name')}}
                {{Form::text('first_name' , '', ['class' => 'form-control' , 'placeholder' => 'First Name'])}}
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                {{Form::label('middle_name' , 'Middle Name')}}
                {{Form::text('middle_name' , '', ['class' => 'form-control' , 'placeholder' => 'Middle Name'])}}
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                {{Form::label('last_name' , 'Last Name')}}
                {{Form::text('last_name' , '', ['class' => 'form-control' , 'placeholder' => 'Last Name'])}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                {{Form::label('address' , 'Address')}}
                {{Form::text('address' , '', ['class' => 'form-control' , 'placeholder' => 'Address'])}}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {{Form::label('contact_no' , 'Contact No.')}}
                {{Form::text('contact_no' , '', ['class' => 'form-control' , 'placeholder' => 'Contact No.'])}}
              </div>
            </div>
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