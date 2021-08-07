<form action="{{route('Accounts.migration.store')}}" method="post">
    @csrf
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white">Change Opening Date</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_head required">Opening Date</label>
                    <input required="" type="text" class="form-control" id="opening_date" name="opening_date" placeholder="Opening Date" value="{{$opening_date}}">
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Save</button>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#opening_date").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
});
</script>