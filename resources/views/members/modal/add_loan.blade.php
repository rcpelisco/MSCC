<div class="modal fade" id="addLoanModal" tabindex="-1" role="dialog" aria-labelledby="addLoanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(['action' => ['LoansController@store', $member->id], 'method' => 'post', 'style' => 'margin: 0px;']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="addLoanModalLabel">Modal title</h5>
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