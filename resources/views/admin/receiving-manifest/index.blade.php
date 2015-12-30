@extends('master')
@section('content')
<!-- Main Content -->
  <section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Receiving Manifest</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Receiving Manifest</a>
            </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
	
    @if (session('status'))
        <div class="row">
            <div class="col m5 s12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        </div>
        <a href="/admin/receiving-manifest/receipt/{{$rec_id}}" id="newtab_link" target="_blank" style="display:none;">Link</a>
    @endif
    
    <div class="row no-rightmargin" id="loadAjaxFrom">
    	<form method="post" action="/admin/receiving-manifest/create" id="pageForm">
          {{csrf_field()}}
          <div class="col s12 m7">
              <fieldset>
                  <legend>Receiving Manifest:</legend>
                  @if (session('status'))
                        <div class="row alert alert-danger">
                            {{ session('status') }}
                        </div>
                  @endif
                  <div class="row">
                    <div class="col m4 s12">
                      <label>From Customer:</label>
                      <select name="customer" id="customer">
                        <option value="-1">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}" {{isset($current_customer) && $customer->id == $current_customer ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
                        @endforeach
                      </select>
                      <label for="customer" class="error"></label>
                    </div>
                    <div class="col m4 s12">
                      <label>Customer Number:</label>
                      <div class="input-field">
                      	<input type="text" name="customer_number" id="customer_number" readonly="readonly" />
                      </div>
                    </div>
                    <div class="col m4 s12">
                      <label>Department:</label>
                      <select name="department" id="department">
                        <option value="-1">Select Department</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col s12">
                      <h6>Date Range:</h6>
                    </div> 
                    <div class="col m6 s12">
                      <label>From:</label>
                      <div id="date_from" type="text" name="date_from" class="calendar"></div>
                    </div>
                    <div class="col m6 s12">
                      <label>To:</label>
                      <div id="date_to" type="text" name="date_to" class="calendar"></div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <button type="submit" class="waves-effect btn">Save &amp; Print</button>
                  </div>
              </fieldset>
          </div>
        </form>
    </div>

  </section>
  
<!-- /Main Content -->
@endsection

@section('js')
<script>
	$( window ).load(function() {
		@if (session('status'))
			$("#newtab_link")[0].click();
			
			$('.loading').show();
			var cus_id = $('#customer').val();
			var url = "{{url('admin/receiving-manifest/ajax-form')}}";
			$.ajax({
				url: url,
				type: 'GET',
				data: { customer_id: cus_id },
				success: function(response)
				{
					$('#loadAjaxFrom').html(response);
					$('.loading').hide();
				}
			});
		@endif	
	});
	
	$(document).ready(function () {
		$("#customer").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
		$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		$(".calendar").jqxDateTimeInput({ width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy' });
		
		$("body").on('change', '#customer', function(e){
			$('.loading').show();
			var cus_id = $(this).val();
			var url = "{{url('admin/receiving-manifest/ajax-form')}}";
			$.ajax({
				url: url,
				type: 'GET',
				data: { customer_id: cus_id },
				success: function(response)
				{
					$('#loadAjaxFrom').html(response);
					$('.loading').hide();
				}
			});
		});
		
		$('#pageForm').validate({
			rules: {
				customer: "required"
			}
		});
	});
</script>
@endsection