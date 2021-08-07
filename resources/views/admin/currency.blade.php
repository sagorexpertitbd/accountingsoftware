@extends('expert.master')

@section('title', 'Currency Setting - '.$settingsinfo->company_name.' - '.$settingsinfo->soft_name.'')

@section('content')

@include('expert.sidebar')

@include('expert.topbar')

<style type="text/css">
  table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
}
</style>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card bg-dark">
      		<div class="card-header border-0 bg-transparent text-white">
                <i class="fa fa-university"></i><span> Currency Setting</span>
            </div>

            <div class="card">

          

            <div class="card-body">

          <?php if (session('message')): ?>
              <div class="alert alert-{{session('class')}} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
                <div class="alert-message"><span>{{session('message')}}</span></div>
              </div>
        <?php endif; ?>

  <form action="{{url('admin/currencyupdate')}}" id="currencyform" enctype="multipart/form-data" method="post">
    @csrf
    

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_role"> Currency</label>
                    <select required="" type="text" class="form-control" id="currency" name="currency">
                        <option value="{{$currency_setting->currency}}">{{$currency_setting->name}} - {{$currency_setting->currency_name}} </option>
                        <option disabled="" value="">----------------------</option>
                        @foreach($currencies as $currenciesdata)
                        <option value="{{$currenciesdata->id}}">
                            {{$currenciesdata->name}} - {{$currenciesdata->currency_name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            
            <div class="col-md-3">
              <div id="showcursymbol_result">
                <div class="form-group">
                    <label for="symbol">Symbol</label>
                    <input required="" type="text" class="form-control" id="symbol" name="symbol" placeholder="Enter Symbol" value="{{$currency_setting->symbol}}" required="">
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div id="show_cur_text">
                <div class="form-group">
                    <label for="symbol">Currency Text</label>
                    <input required="" type="text" class="form-control" id="currency_text" name="currency_text" placeholder="Enter Currency Text" value="{{$currency_setting->currency_text}}" required="">
                </div>
              </div>
            </div>
            
    

            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_role"> Currency Position </label>
                    <select required="" type="text" class="form-control" id="currency_position" name="currency_position">
                        <option value="@if($currency_setting->currency_position==1)
                          1
                          @else
                          2
                          @endif">@if($currency_setting->currency_position==1)
                          Before
                          @else
                          After
                          @endif
                        </option>
                        <option disabled="">------------------</option>
                        <option value="1">Before</option>
                        <option value="2">After</option>
                    </select>
                </div>
            </div>

            
            
            

            
            
        </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-dark">
          <i class="fa fa-check-square-o"></i> Update 
        </button>
    </div>
</form>
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
  <script type="text/javascript">
    $(document).ready(function() {
        $("#currency").select2();
        $("#currency_position").select2();
    });

    $("#currency").on('change',function(){
    //alert($(this).val());
    var id = document.getElementById("currency").value;
        $.ajax({
            url: "{{url('admin/showcursymbol')}}",
            data: {id: id},
            success: function(data){
        $("#currencyform").find("#showcursymbol_result").html(data);
        showcurrency_text(id);
        }
        });

    });

    function showcurrency_text (id) {
      //alert(id);
       
        $.ajax({
            url: "{{url('admin/showcurtext')}}",
            data: {id: id},
            success: function(data){
        $("#currencyform").find("#show_cur_text").html(data);
        }
        });

    }

    
</script>
@endsection

