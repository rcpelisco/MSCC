@extends('layouts.master')

@section('title', 'MSCC')

@section('breadcrumbs', Breadcrumbs::render('members'))

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i> Condensed Table</div>
        <div class="card-body">
          <table class="table table-responsive-sm table-sm">
            <thead>
              <tr>
                <th>Name</th>
                <th>Contact no.</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                <tr>
                  <td><a href="{{ route('members.show', $member->id) }}">
                    {{ $member->first_name . ' ' . $member->middle_name .' ' . $member->last_name }}
                  </a></td>
                  <td>{{ $member->contact_no }}</td>
                  <td>{{ $member->address }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('javascripts')
<script>
$(function() {
    $('.table').DataTable();
})
</script>
@endsection