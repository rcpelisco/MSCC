
<div class="modal fade" id="editMemberModal" tabindex="-2" role="dialog" aria-labelledby="editMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {!! Form::open(['action' => ['MembersController@update', $member->id], 'method' => 'put']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberModalLabel">Member's form <small>edit</small></h5>
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

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              {{Form::label('first_name' , 'First Name')}}
              {{Form::text('first_name' , $member->first_name, ['class' => 'form-control' , 'placeholder' => 'First Name'])}}
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              {{Form::label('middle_name' , 'Middle Name')}}
              {{Form::text('middle_name' , $member->middle_name, ['class' => 'form-control' , 'placeholder' => 'Middle Name'])}}
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              {{Form::label('last_name' , 'Last Name')}}
              {{Form::text('last_name' , $member->last_name, ['class' => 'form-control' , 'placeholder' => 'Last Name'])}}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('address' , 'Address')}}
              {{Form::text('address' , $member->address, ['class' => 'form-control' , 'placeholder' => 'Address'])}}
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              {{Form::label('contact_no' , 'Contact No.')}}
              {{Form::text('contact_no' , $member->contact_no, ['class' => 'form-control' , 'placeholder' => 'Contact No.'])}}
            </div>
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