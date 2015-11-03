<fieldset>
  <legend>Customer Information:</legend>
  <div class="row">
    <div class="col m6 s12">
      <select name="customer" id="customer">
        <option value="">Customer</option>
        @foreach ($customers as $customer)
        <option value="{{$customer->id}}" {{$customer->id == $current_customer->id ? 'selected="selected"' : ''}}>{{$customer->customer_number}}</option>
        @endforeach
      </select>
    </div>
    <div class="col m6 s12">
      <select name="department" id="department">
      	<option value="">Dept</option>
      	@foreach ($depts as $dept)
        <option value="{{$dept->id}}">{{$dept->department_name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="col s12">
      <div class="input-field">
        <input id="name" type="text" name="name" value="{{$current_customer->shipping_name}}" placeholder="Name" readonly="readonly">
      </div>
    </div>
  </div>
</fieldset>

<script>
    $(document).ready(function () {
		$("#customer, #cart_number, #item").jqxComboBox({width: '100%', autoDropDownHeight: true});
		@if (count($depts) > 0)
			$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: false});
		@else
			$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		@endif
	});
</script>