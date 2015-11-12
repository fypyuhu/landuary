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

    <div class="row no-rightmargin" id="loadAjaxFrom">
    	<form method="post" action="/admin/receiving-manifest/create" id="pageForm">
          {{csrf_field()}}
          <div class="col s12 m7">
              <fieldset>
                  <legend>Receiving Manifest:</legend>
                  <div class="row">
                    <div class="col m6 s12">
                      <label>From Customer:</label>
                      <select name="customer" id="customer">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                      </select>
                      <label for="customer" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                      <label>Customer Number:</label>
                      <div class="input-field">
                      	<input type="text" name="customer_number" id="customer_number" readonly="readonly" />
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                  	<div class="col s12">
                      <h6>Department Range:</h6>
                    </div> 
                    <div class="col m6 s12">
                      <label>From:</label>
                      <select name="department_range_1" id="department_range_1">
                        <option value="">Select Department</option>
                      </select>
                    </div>
                    <div class="col m6 s12">
                      <label>To:</label>
                      <select name="department_range_2" id="department_range_2">
                        <option value="">Select Department</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col s12">
                      <h6>Date Range:</h6>
                    </div> 
                    <div class="col m6 s12">
                      <label>From:</label>
                      <div class="input-field">
                        <input id="name" type="text" name="name">
                      </div>
                    </div>
                    <div class="col m6 s12">
                      <label>To:</label>
                      <div class="input-field">
                        <input id="name" type="text" name="name">
                      </div>
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
	$(document).ready(function () {
		$("#customer").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$("#department_range_1, #department_range_2").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		
		$("body").on('change', '#customer', function(e){
			$('.loading').css('display', 'block');
			var cus_id = $(this).val();
			var url = "{{url('admin/receiving-manifest/ajax-form')}}";
			$.ajax({
				url: url,
				type: 'GET',
				data: { customer_id: cus_id },
				success: function(response)
				{
					$('#loadAjaxFrom').html(response);
					$('.loading').css('display', 'none');
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