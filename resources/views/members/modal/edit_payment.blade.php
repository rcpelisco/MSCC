
@if($member->loans->last() != null)
<div class="modal fade" id="editPaymentModal" tabindex="-2" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- <form action="" method="POST"></form> --}}
      {!! Form::open(['action' => ['PaymentsController@update', 1], 'method' => 'post', 'style' => 'margin: 0px;', 'id' => 'editPayment']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="editPaymentModalLabel">Payment form <small>edit</small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        @if($errors->isNotEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
              {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

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
            {{ Form::text('amount_payment', '', ['class' => 'form-control' , 'placeholder' => '1000', 'required']) }}
          </div>
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
@endif