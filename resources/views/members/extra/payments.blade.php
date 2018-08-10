<div class="col-8">
  <h3>Payments</h3>
  <table class="table table-sm">
    <thead>
      <td><small><strong>Date</strong></small></td>
      <td><small><strong>OR Number</strong></small></td>
      <td><small class="pull-right"><strong>Principal</strong></small></td>
      <td><small class="pull-right"><strong>Interest</strong></small></td>
      <td><small class="pull-right"><strong>Penalty</strong></small></td>
      <td><small class="pull-right"><strong>Balance <br> &#8369; <span class="pull-right">{{ number_format($member->loans->last()->principal, 2) }}</strong></span></small></td>
      <td></td>
    </thead>
    <tbody>
      @php
        $balance = $member->loans->last()->principal
      @endphp
      @foreach($member->loans->last()->payments as $payment)
        <tr>
          <td><small>{{ $payment->date_payment->format('F d, Y') }}</small></td>
          <td><small>{{ $payment->or_number }}</small></td>
          <td><small>&#8369;<span class="pull-right">@convert($payment->amount_payment)</span></small></td>
          <td><small>&#8369;<span class="pull-right">{{ 0.00 }}</span></small></td>
          <td><small>&#8369;<span class="pull-right">{{ 0.00 }}</span></small></td>
          @php
            $balance -= $payment->amount_payment;
          @endphp
          <td><small>&#8369;<span class="pull-right">@convert($balance)</span></small></td>
          <td>
            <div class="dropdown show pull-right">
              <a class="btn btn-outline-secondary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                {!! Form::open(['action' => ['PaymentsController@destroy', $payment->id] , 'method' => 'delete', 'style' => 'margin: 0px;']) !!}
                  <button class="dropdown-item editPaymentButton" data-id="{{ $payment->id }}" type="button"><i class="fa fa-pencil"></i> Edit</button>
                  <button class="dropdown-item" type="submit"><i class="fa fa-trash"></i>Delete</button>
                {!! Form::close() !!}
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>