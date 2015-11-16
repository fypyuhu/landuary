<legend>Cart Information</legend>
<div class="row">
    <div class="col m4 s12">
      <label>Cart Number</label>
      <div class="input-field" id="exchange-cart-div">
          <select name="cart_number_dropdown" id="cart_number_dropdown">
            <option value="">Cart Number</option>
            @foreach($carts as $cart)
            <option value="{{$cart->id}}" {{$cart->id == $current_cart->id ? 'selected="selected"' : ''}}>{{$cart->cart_number}}</option>
            @endforeach
          </select>
      </div>
      <div class="input-field" id="non-tracked-cart-div" style="display:none;">
        <input id="cart_number_textfield" type="text" name="cart_number">
      </div>
    </div>
    <div class="col m4 s12">
      <label>Tare Weight</label>
      <div class="input-field">
        <input id="tare_weight" type="text" name="tare_weight" readonly="readonly" value="{{$current_cart->tare_weight}}">
      </div>
    </div>
    <div class="col m4 s12">
      <label>Receiving Date</label>
      <div id="receiving_date" name="receiving_date" class="calendar"></div>
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
        <input type="text" name="status" id="status" readonly="readonly"  value="{{$current_cart->status}}">
      </div>
    </div>
</div>

<script>
    $(document).ready(function () {
		$("#cart_number_dropdown").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy' });
	});
</script>