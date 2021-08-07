<form action="{{route('Accounts.subsidiary_ledger.store')}}" method="post">
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
                    <label for="general_ledger_id">General Ledger</label>
                    <select class="form-control" id="general_ledger_id" name="general_ledger_id" required="">
                        <option value="">Select General Ledger</option>
                        @foreach($generalLedgers as $accTypeName=>$generalLedger)
                        <optgroup label="{{$accTypeName}}">
                        @foreach($generalLedger as $generalLedger)                        
                        <option value="{{$generalLedger->id}}">{{$generalLedger->ledger_code.' - '.$generalLedger->ledger_head}}</option>
                        @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ledger_code">Subsidiary Ledger Code</label>
                    <input readonly="" type="text" class="form-control" id="ledger_code" name="ledger_code" placeholder="Subsidiary Ledger Code">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_head">Subsidiary Ledger Name</label>
                    <input required="" type="text" class="form-control" id="ledger_head" name="ledger_head" placeholder="Enter Subsidiary Ledger Name">
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
    $("#general_ledger_id").select2();

    $("#general_ledger_id").change(function(){
        var general_ledger_id = $(this).val();
        if(general_ledger_id) {
            $.ajax({
                url: "{{url('accounts/subsidiary_ledger_code')}}",
                data: {glId: general_ledger_id},
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