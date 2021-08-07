<form action="{{route('Accounts.migration.update', $subsidiaryLedger->id)}}" method="put">
    @csrf
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Migration</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ledger_code">Subsidiary Ledger Code</label>
                    <input readonly="" type="text" class="form-control" id="ledger_code" name="ledger_code" placeholder="Subsidiary Ledger Code" value="{{$subsidiaryLedger->ledger_code.' - '.$subsidiaryLedger->ledger_head}}">
                    <input type="hidden" id="ledger_code_exist" value="{{$subsidiaryLedger->ledger_code}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="opening_amount">Opening Amount</label>
                    <input required="" type="text" class="form-control" id="opening_amount" name="opening_amount" placeholder="Enter Subsidiary Ledger Name" value="{{$openingAmount}}">
                </div>
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                    <label for="opening_date">Opening Date</label>
                    <input readonly="" required="" type="text" class="form-control" id="opening_date" name="opening_date" placeholder="Enter Subsidiary Ledger Name" value="{{$opening_date}}">
                </div>
            </div>      
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Save</button>
    </div>
</form>