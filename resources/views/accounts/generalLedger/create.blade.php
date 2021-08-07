<form action="{{route('Accounts.general_ledger.store')}}" method="post">
    @csrf
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-plus"></i> Add New</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type_id">Account Type</label>
                    <select class="form-control" id="type_id" name="type_id" required="">
                        <option value="">Select Account Type</option>
                        @foreach($accTypes as $accType)                        
                        <option value="{{$accType->id}}">{{$accType->type_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ledger_code">General Ledger Code</label>
                    <input readonly="" type="text" class="form-control" id="ledger_code" name="ledger_code" placeholder="General Ledger Code">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_head">General Ledger Name</label>
                    <input required="" type="text" class="form-control" id="ledger_head" name="ledger_head" placeholder="Enter General Ledger Name">
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
    $("#type_id").change(function(){
        var type_id = $(this).val();
        if(type_id) {
            $.ajax({
                url: "{{url('accounts/general_ledger_code')}}",
                data: {typeId: type_id},
                dataType: "json",
                success: function(data){
                    $("#ledger_code").val(data.code);
                }
            });
        } else {
            $("#ledger_code").val("");
        }
    });
});
</script>