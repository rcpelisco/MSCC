<div class="col-md-4">
  <h3 class="display-inline-block">Latest Loan</h3>
  <a href="{{ route('loans.edit', $member->loans->last()->id) }}" class="btn btn-sm btn-warning pull-right" style="margin-top: 5px;">Edit</a>
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
      Interest: 
    </div>
    <div class="col-5">
      &#8369; <span class="pull-right">@convert($member->loans->last()->balance() * .02)</span>
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
      <span class="pull-right">{{ $member->loans->last()->daysPAR() }}</span>
    </div>
  </div>
  <hr>
</div>