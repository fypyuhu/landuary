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
                <option value="{{$customer->id}}" {{$customer->id == $current->id ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col m6 s12">
              <label>Customer Number:</label>
              <div class="input-field">
                <input type="text" name="customer_number" id="customer_number" readonly="readonly" value="{{$current->customer_number}}" />
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col s12">
              <h6>Department Range:</h6>
            </div> 
            <div class="col m6 s12">
              <label>From:</label>
              <select name="department_from" id="department_from">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                	<option value="{{$department->id}}">{{$department->department_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col m6 s12">
              <label>To:</label>
              <select name="department_to" id="department_to">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                	<option value="{{$department->id}}">{{$department->department_name}}</option>
                @endforeach
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

<script>
$(document).ready(function () {
	$("#customer").jqxComboBox({width: '100%', autoDropDownHeight: true});
	$("#department_from, #department_to").jqxComboBox({width: '100%', autoDropDownHeight: true, {{count($departments) > 0 ? 'disabled: false' : 'disabled: true'}} });
	$(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy' });
	
	$('#pageForm').validate({
		rules: {
			customer: "required"
		}
	});
});
</script>