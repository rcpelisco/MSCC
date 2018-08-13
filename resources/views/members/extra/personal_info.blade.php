<h3 class="display-inline-block">Personal Info</h3>
<button class="btn btn-warning btn-sm pull-right" style="margin-top: -3px;"
  data-toggle="modal" data-target="#editMemberModal">Edit</button>
<div class="row">
  <div class="col-4">
    Name: 
  </div>
  <div class="col-8">
    {{ $member->first_name . ' ' . $member->middle_name . ' ' . $member->last_name }}
  </div>
</div>
<div class="row">
  <div class="col-4">
    Address:
  </div>
  <div class="col-8">
    {{ $member->address }}
  </div>
</div>
<div class="row">
  <div class="col-4">
    Contact no: 
  </div>
  <div class="col-8">
    {{ $member->contact_no }}
  </div>
</div>