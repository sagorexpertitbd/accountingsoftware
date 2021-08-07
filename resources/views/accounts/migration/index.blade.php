@extends('expert.master')

@section('title', 'Subsidiary Ledger - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-share"></i><span> Accounts Migration</span>
            </div>

            <div class="card">

            <div class="card-header">
              <div style="display:inline-block; padding-top:5px;">
                <i class="fa fa-table"></i> Subsidiary Ledger List
              </div> 
              <button type="button" class="btn btn-dark btn-sm waves-effect waves-light pull-right" id="addNew"> 
                <span>Change</span>
              </button>
              <span class="pull-right" style="margin-top: 6px; margin-right: 15px;">Opening Date: {{$opening_date}}</span>
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%">SN</th>
                        <th>Ledger Code</th>
                        <th>Subsidiary Ledger</th>
                        <th>General Ledger</th>
                        <th>Account Type</th>
                        <th>Opening Date</th>
                        <th>Opening Amount</th>
                        
                        <th width="8%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($subsidiaryLedger as $subsidiaryLedger)
                    <?php
                    if(array_key_exists($subsidiaryLedger->id, $openingData)) {
                      $openingDt = $openingData[$subsidiaryLedger->id];
                      $amount = ($openingDt->acc_type<=2) ? $openingDt->debit_amount-$openingDt->credit_amount : $openingDt->credit_amount-$openingDt->debit_amount;

                      $date = new DateTime($openingDt->transaction_date);
                      $date = $date->format('d/m/Y');
                    } else {
                      $date = '---';
                      $amount = 0;
                    }
                    
                    ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$subsidiaryLedger->ledger_code}}</td>
                        <td>{{$subsidiaryLedger->ledger_head}}</td>
                        <td>{{$subsidiaryLedger->general_ledger_head}}</td>
                        <td>{{$subsidiaryLedger->type_name}}</td>
                        <td>{{$date}}</td>
                        <td>
@if($set_currency->currency_position==2){{$set_currency->symbol}}@endif 
{{$amount}} 
@if($set_currency->currency_position==1){{$set_currency->symbol}}@endif 
{{$set_currency->currency_text}}</td>
   
                        <td>
                          <button type="button" class="btn btn-warning btn-sm waves-effect waves-light edit" data="{{$subsidiaryLedger->id}}"> 
                            <i class="fa fa-edit"></i> <span>Migrate</span>
                          </button>
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
      </div><!--End Row-->
	  
       <!--End Dashboard Content-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   

  @include('expert.copyright')

  @endsection

  @section('js')
    <script>
    $(document).ready(function() {
        dataTableLoad({
            curUrl: "{{route('Accounts.migration.index')}}",
            addUrl: "{{route('Accounts.migration.create')}}"
        });
    });
    </script>
  @endsection