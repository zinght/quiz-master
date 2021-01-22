<div class="modal" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="{{$formurl}}" id="delete_user_form" method="post" >
        @csrf
        <div class="modal-dialog modal-lg modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete {{$delete_type}}: {{$delete_title}} ?</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Are you sure you wish to delete {{$delete_type}}: {{$delete_title}}?  Once done this cannot be reverted!
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger float-right" >Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $( document ).ready(function() {

    });
</script>
