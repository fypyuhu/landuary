<fieldset>
  <legend>Customer Information:</legend>
  <div class="row">
    <div class="col m6 s12">
      <select name="customer" id="customer">
        <option value="" disabled selected>Customer</option>
        @foreach ($customers as $customer)
        <option value="{{$customer->id}}">{{$customer->customer_number}}</option>
        @endforeach
      </select>
    </div>
    <div class="col m6 s12">
      <select name="department" id="department">
      	<option value="" disabled selected>Dept</option>
      	@foreach ($depts as $dept)
        <option value="{{$dept->id}}">{{$dept->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="col s12">
      <div class="input-field">
        <input id="name" type="text" name="name" placeholder="Name" readonly="readonly">
      </div>
    </div>
  </div>
</fieldset>