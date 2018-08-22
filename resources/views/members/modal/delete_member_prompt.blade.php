<div class="modal fade" id="deleteMemberPromptModal" tabindex="-1" role="dialog" aria-labelledby="deleteMemberPromptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="/members/" method="POST" style="margin: 0px">
      @csrf
      {{ method_field('DELETE') }}
      <div class="modal-header">
        <h5 class="modal-title" id="deleteMemberPromptModalLabel">Delete confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        Are you sure you want to delete <strong><span id="memberName"></span></strong>?
        <!-- <p class="lead">Are you sure you want to delete <strong><span id="memberName"></span></strong>?</p> -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        <button class="btn btn-primary" type="submit">Confirm</button>
      </div>
    </form>
    </div>
  </div>
</div>