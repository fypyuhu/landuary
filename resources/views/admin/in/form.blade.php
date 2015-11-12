<form method="post" action="/admin/in/create" id="pageForm">
<div class="row no-rightmargin">
  <div class="col s12 m5 margin-right-md">
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
                <input id="name" type="text" name="name" value="{{$current_customer->name}}" placeholder="Name" readonly="readonly">
              </div>
            </div>
          </div>
        </fieldset>
      
      <fieldset id="cartAjaxResponse">    
          <legend>Cart Information</legend>
          <div class="row">
            <div class="col m4 s12">
              <div class="input-field" id="exchange-cart-div">
                  <select name="cart_number_dropdown" id="cart_number_dropdown">
                    <option value="">Cart Number</option>
                    @foreach($carts as $cart)
                    <option value="{{$cart->id}}">{{$cart->cart_number}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="input-field" id="non-tracked-cart-div" style="display:none;">
                <input id="cart_number_textfield" type="text" name="cart_number_textfield" placeholder="Cart Number">
              </div>
            </div>
            <div class="col m4 s12">
              <div class="input-field">
                <input id="tare_weight" type="text" name="tare_weight" placeholder="Tare Weight">
              </div>
            </div>
            <div class="col m4 s12">
              <div class="input-field">
                  <input id="receiving_date" type="text" name="receiving_date" placeholder="Receiving Date" class="dateInput">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col m6 s12">
              <input type="checkbox" name="is_exchange_cart" id="is_exchange_cart" value="1" checked="checked">
              <label for="is_exchange_cart">Exchange Cart</label>
            </div>
            <div class="col m4 s12 pull-right">
              <label for="status">Status</label>
              <div class="input-field">
                <input type="text" name="status" id="status" placeholder="Cart Status" readonly="readonly" value="In">
              </div>
            </div>
          </div>
      </fieldset>
      
      <div class="row">
        <div class="col pull-right">
          <button type="submit" class="waves-effect btn">Save</button>
          <button type="reset" class="waves-effect btn">Clear</button>
        </div>
      </div>
  </div>
  
  <div class="col s12 m6">
      <fieldset>
          <legend>Items List:</legend>
          <div class="row box">
              {{csrf_field()}}
              <div class="row no-topmargin">
                <div class="col m8 s12">
                  <select name="item_id" id="item_id">
                    <option value="">Item Number</option>
                    @foreach ($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                    <input id="quantity" type="text" name="quantity" placeholder="Quantity">
                  </div>
                </div>
              </div>
              <div class="row">
                <button class="waves-effect btn" id="button-add-item">Add</button>
                <button class="waves-effect btn">Remove</button>
              </div>
              <div class="row layout_table">
                <div class="row heading">
                    <div class="col s3">Item Number</div>
                    <div class="col s5">Item Description</div>
                    <div class="col s2 right-align">Quantity</div>
                    <div class="col s2 right-align">Weight</div>
                </div>
                <div class="row records_list no-item">
                    <h5 class="center-align">No Items have been added to this cart yet.</h5>
                </div>
                <div id="add-item-list"></div>
                <!--<div class="row records_list">
                    <div class="col s3">Item 1</div>
                    <div class="col s5">Lorem Ipsum doller sit</div>
                    <div class="col s2 right-align">4</div>
                    <div class="col s2 right-align">4 KG</div>
                </div>-->
              </div>
          </div>
          <div class="row" id="weights-div">
            <div class="col m4 s12">
              <label>Gross Weight</label>
              <div class="input-field">
                <input id="gross_weight" type="text" name="gross_weight" placeholder="Gross Weight">
              </div>
            </div>
            <div class="col m4 s12">
              <label>Net Weight</label>
              <div class="input-field">
                <input id="net_weight" type="text" name="net_weight" placeholder="Net Weight">
              </div>
            </div>
          </div>
      </fieldset>
  </div>
</div>
</form>
    
<script>
    $(document).ready(function () {
		$("#customer, #cart_number_dropdown").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$("#department").jqxComboBox({ width: '100%', autoDropDownHeight: true, {{count($depts) > 0 ? 'disabled: false' : 'disabled: true'}} });
		$("#item_id").jqxComboBox({ width: '100%', autoDropDownHeight: true, {{count($items) > 0 ? 'disabled: false' : 'disabled: true'}} });
	});
</script>