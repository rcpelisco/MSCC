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
                <th></th>
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
                  <td>
                    <button class="btn btn-danger btn-delete-member" type="submit" data-id="{{ $member->id }}"
                      data-name="{{ $member->first_name . ' ' . $member->middle_name . ' ' . $member->last_name }}">
                      <i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('members.modal.delete_member_prompt')
@endsection

@section('javascripts')
<script>
$(function() {
    $('.table').DataTable()
    $('body').on('click', '.btn-delete-member', function() {
      let id = $(this).attr('data-id')
      let name = $(this).attr('data-name')
      console.log(id + " " + name)
      $('#deleteMemberPromptModal #memberName').html(name)
      $('#deleteMemberPromptModal form').attr('action', '/members/' +id)
      $('#deleteMemberPromptModal').modal()
    })
})
</script>
@endsection