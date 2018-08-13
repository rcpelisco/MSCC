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
        <h1 class="display-inline-block">{{ $member->first_name . ' ' . $member->middle_name .' ' . $member->last_name }}</h1>
      </div>
      <div class="col-md-4 d-lg-none">
        <div class="row" style="margin-top: .5em;">
          @if($member->loans->last() != null)
            @if($member->loans->last()->balance() > 0)
            <div class="col-4">
              <button class="btn btn-primary btn-block btn-sm" id="paymentModalButton">Pay</button>
            </div>
            @else
            <div class="col-4">
              <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#addLoanModal">Add Loan</button>
            </div>
            @endif
          @else
            <div class="col-4">
              <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#addLoanModal">Add Loan</button>
            </div>
          @endif
          <div class="col-4">
            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-block btn-sm">Edit</a>
          </div>
          <div class="col-4">
              <button class="btn btn-danger btn-block btn-sm">Delete</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-none d-md-block">
        <div class="pull-right" style="margin-top: .5em;">
          {!! Form::open(['action' => ['MembersController@destroy', $member->id], 'method' => 'post', 'style' => 'margin: 0px;']) !!}
          {{ Form::hidden('_method', 'delete') }}
          @if($member->loans->last() != null)
            @if($member->loans->last()->balance() > 0)
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#paymentModal">Pay</button>
            @else
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLoanModal">Add Loan</button>
            @endif
          @else
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLoanModal">Add Loan</button>
          @endif
          
          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
    <hr class="my-2">
    @if($member->loans->last())
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            @include('members.extra.latest_loan')
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
              @include('members.extra.personal_info')
          </div>
        </div>
      </div>
      <div class="col-8">
        @include('members.extra.payments')
      </div>
    </div>
    @else
    <p>No active loan yet ... </p>
    @endif
  </div>
</div>
<!-- Modals -->
@include('members.modal.add_loan')
@include('members.modal.payment')
@include('members.modal.edit_payment')
@include('members.modal.edit_loan')
@include('members.modal.edit_member')

@endsection
@section('javascripts')
<script>
  $(function() {
    @if($errors->isNotEmpty())
      setTimeout(function() {
        $('#editPaymentModal').modal()
      }, 750)
    @endif

    $('.editPaymentButton').click(function() {
      let id = $(this).attr('data-id')
      asyncEditPayment(id)
    })

    Number.prototype.pad = function(size) {
      var s = String(this);
      while (s.length < (size || 2)) {s = "0" + s;}
      return s;
    }

    function bindDataEditPaymentModal(data) {
      let date = new Date(data.date_payment)
      date = date.getFullYear() + '-' 
        + (date.getMonth() + 1).pad() 
        + '-' + date.getDate().pad()
      $('form#editPayment').attr('action', '/payments/' + data.id)
      $('#editPayment input[name="amount_payment"]').val(data.amount_payment)
      $('#editPayment input[name="date_payment"]').val(date)
      $('#editPayment input[name="or_number"]').val(data.or_number)
      $('#editPayment input[name="amount_payment"]').val(data.amount_payment)
    }

    function asyncEditPayment(id) {
      $.ajax({
        url: '/payments/' + id + '/async_edit',
        type: 'GET',
        data: '<?php csrf_field() ?>'
      }).done(function(data) {
        bindDataEditPaymentModal(data)
      }).done(function() {
        $('#editPaymentModal').modal()
      })
    }
  })
</script>
@endsection