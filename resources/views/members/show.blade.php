@extends('layouts.master')

@section('title', 'MSCC')

@section('stylesheets')
<style type="text/css">
.display-inline-block {
  display: inline-block;
}
</style>
@endsection

@section('breadcrumbs', Breadcrumbs::render('members.show', $member))

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <h1 class="display-inline-block">{{ $member->first_name . ' ' . $member->last_name }}</h1>
      </div>
      <div class="col-md-4 d-lg-none">
        <div class="row" style="margin-top: .5em;">
          <div class="col-4">
            <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#exampleModal">Add Loan</button>
          </div>
          <div class="col-4">
            <button class="btn btn-warning btn-block btn-sm">Edit</button>
          </div>
          <div class="col-4">
              <button class="btn btn-danger btn-block btn-sm">Delete</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-none d-md-block">
        <div class="pull-right" style="margin-top: .5em;">
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Loan</button>
          <button class="btn btn-warning btn-sm">Edit</button>
          <button class="btn btn-danger btn-sm">Delete</button>
        </div>
      </div>
    </div>
    <hr class="my-2">
    @if($member->loans->last())
    <div class="row">
      <div class="col-md-4">
        <h3>Latest Loan</h3>
        
        <div class="row">
          <div class="col-6">
            Date Released: 
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ $member->loans->last()->date_released->format('F d, Y') }}
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            Maturity Date:
          </div>
          <div class="col-6">
            <span class="pull-right">
              {{ $member->loans->last()->date_mature->format('F d, Y') }}
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            Principal: 
          </div>
          <div class="col-5">
            &#8369; <span class="pull-right">@convert($member->loans->last()->principal)</span>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            Balance: 
          </div>
          <div class="col-5">
            &#8369; <span class="pull-right">@convert($member->loans->last()->balance())</span>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            Monthly Payment: 
          </div>
          <div class="col-5">
            &#8369; <span class="pull-right">@convert($member->loans->last()->monthlyPayment())</span>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            Days PAR: 
          </div>
          <div class="col-5">
            <span class="pull-right">{{ $member->loans->last()->daysPAR() }}</span>
          </div>
        </div>
        <hr>
      </div>
      <div class="col-md-4">
        <h3>Payments</h3>
        <table class="table table-sm">
          <thead>
            <td>Date</td>
            <td>OR Number</td>
            <td>Amount</td>
          </thead>
          <tbody>
            @foreach($member->loans->last()->payments as $payment)
              <tr>
                <td>
                  <small>
                    {{ $payment->date_payment->format('F d, Y') }}
                  </small>
                </td>
                <td>
                  <small>
                    {{ $payment->or_number }}
                  </small>
                </td>
                <td>
                  <small>
                    {{ $payment->amount_payment }}
                  </small>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        {!! Form::open(['action' => ['LoansController@pay', $member->loans->last()->id] , 'method' => 'post']) !!}
          <div class="card">
            <div class="card-header">
              <strong>Payment</strong>
              <small>Form</small>
            </div>
            <div class="card-body">
              <div class="form-group">
                {{ Form::label('date_payment' , 'Payment Date') }}
                {{ Form::date('date_payment' , '', ['class' => 'form-control', 'required']) }}
              </div>
              <div class="form-group">
                {{ Form::label('or_number' , 'OR Number') }}
                {{ Form::text('or_number' , '', ['class' => 'form-control' , 'placeholder' => '####', 'required']) }}
              </div>
              <div class="form-group">
                {{ Form::label('amount_payment' , 'Amount') }}
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-peso">&#8369;</i>
                    </span>
                  </div>
                  {{ Form::text('amount_payment' , '', ['class' => 'form-control' , 'placeholder' => '1000', 'required']) }}
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="pull-right">
                <button class="btn btn-sm btn-danger" type="reset">
                  <i class="fa fa-ban"></i> Reset</button>
                <button class="btn btn-sm btn-primary" type="submit">
                  <i class="fa fa-dot-circle-o"></i> Pay</button>
              </div>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
    @else
    <p>No active loan yet ... </p>
    @endif
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(['action' => ['LoansController@store', $member->id] , 'method' => 'post']) !!}

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          {{ Form::label('principal' , 'Principal') }}
          {{ Form::text('principal' , '', ['class' => 'form-control' , 'placeholder' => 'Enter Principal']) }}
        </div>
        <div class="form-group">
          {{ Form::label('date_released' , 'Date Released') }}
          {{ Form::date('date_released' , '', ['class' => 'form-control' , 'placeholder' => 'Date Released']) }}
        </div>
        <div class="form-group">
          {{ Form::label('months_to_pay' , 'Months to Pay') }}
          {{ Form::text('months_to_pay' , '', ['class' => 'form-control' , 'placeholder' => 'Months to Pay']) }}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-danger" type="reset">
            <i class="fa fa-ban"></i> Reset</button>
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-dot-circle-o"></i> Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('javascripts')
<script>
$(function() {
    
})
</script>
@endsection