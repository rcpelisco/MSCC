@php
$loan = $member->loans->last()
@endphp
<h3 class="display-inline-block">Latest Loan</h3>
<button class="btn btn-sm btn-warning pull-right" style="margin-top: 0px;" 
  data-target="#editLoanModal" data-toggle="modal">Edit</button>
<div class="row">
  <div class="col-6">
    Date Released: 
  </div>
  <div class="col-6">
    <span class="pull-right">
      {{ $loan->date_released->format('F d, Y') }}
    </span>
  </div>
</div>
<div class="row">
  <div class="col-6">
    Maturity Date:
  </div>
  <div class="col-6">
    <span class="pull-right">
      {{ $loan->date_mature->format('F d, Y') }}
    </span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Principal: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert($loan->principal)</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Balance: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert($loan->balance())</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Monthly Payment: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert($loan->monthlyPayment())</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Expected Payment: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert($loan->expectedPayment())</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Months Passed: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">{{ $loan->monthsPassed() }}</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Interest: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert($loan->balance() * .02)</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Penalty: 
  </div>
  <div class="col-5">
    &#8369; <span class="pull-right">@convert(0)</span>
  </div>
</div>
<div class="row">
  <div class="col-7">
    Days PAR: 
  </div>
  <div class="col-5">
    <span class="pull-right">{{ $loan->daysPAR() }}</span>
  </div>
</div>