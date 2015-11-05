@extends('master')
@section('content') 
  <div class="loading"><img src="{{URL::asset('images/ajax-loader.gif')}}" alt="" /></div>
  <!-- Main Content -->
  <section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Outgoing Carts</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Outgoing Carts</a>
            </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
	
    <div id="loadAjaxFrom">
	<form method="post" action="" id="pageForm">
    <div class="row no-rightmargin">
      <div class="col s12 m5 margin-right-md">
          <fieldset>
              <legend>Customer Information:</legend>
              <div class="row">
                <div class="col m6 s12">
                  <select name="customer" id="customer">
                    <option value="">Customer</option>
                    @foreach ($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->customer_number}}</option>
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
                    <input id="customer_name" type="text" name="customer_name" placeholder="Name" readonly="readonly">
                  </div>
                </div>
              </div>
            </fieldset>
          
          <fieldset id="cartAjaxResponse">    
              <legend>Cart Information</legend>
              <div class="row">
                <div class="col m4 s12">
                  <div class="input-field" id="exchange-cart-div">
                      <select name="cart_number" id="cart_number_dropdown">
                        <option value="">Cart Number</option>
                        @foreach($carts as $cart)
                        <option value="{{$cart->id}}">{{$cart->cart_number}}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="input-field" id="non-tracked-cart-div" style="display:none;">
                  	<input id="cart_number_textfield" type="text" name="cart_number" placeholder="Cart Number">
                  </div>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                    <input id="tare_weight" type="text" name="tare_weight" placeholder="Tare Weight" readonly="readonly">
                  </div>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                      <input id="ship_date" type="text" name="ship_date" placeholder="Ship Date">
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
              <button class="waves-effect btn">Save</button>
              <button class="waves-effect btn">Clear</button>
              <button class="waves-effect btn">Exit</button>
            </div>
          </div>
      </div>
      
      <div class="col s12 m6">
          <fieldset id="itemAjaxResponse">
              <legend>Items List:</legend>
              <div class="row box">
                  {{csrf_field()}}
                  <div class="row no-topmargin">
                    <div class="col m8 s12">
                      <select name="item_id" id="item_id">
                        <option value="">Item Number</option>
                      </select>
                      <label for="item_id" class="error"></label>
                    </div>
                    <div class="col m4 s12">
                      <div class="input-field">
                        <input id="quantity" type="text" name="quantity" placeholder="Quantity">
                      </div>
                      <label for="quantity" class="error"></label>
                    </div>
                  </div>
                  <div class="row">
                    <button type="submit" class="waves-effect btn" id="button-add-item">Add</button>
                    <button class="waves-effect btn">Edit</button>
                    <button class="waves-effect btn">Remove</button>
                    <button class="btn btn-disabled">Clear</button>
                  </div>
                  <div class="row layout_table">
                    <div class="row heading">
                        <div class="col s3">Item Number</div>
                        <div class="col s5">Item Description</div>
                        <div class="col s2 right-align">Quantity</div>
                        <div class="col s2 right-align">Weight</div>
                    </div>
                    <div class="row records_list">
                        <h5 class="center-align">No Items have been added to this cart yet.</h5>
                    </div>
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
    </div>

  </section>
  <!-- /Main Content -->
  
@endsection

@section('js')
<script>
    $(document).ready(function () {
		$("#customer, #cart_number_dropdown").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$("#item_id").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		
		$( "body" ).on( "change", "#customer", function(e) {
			$('.loading').css('display', 'block');
			var cus_id = $(this).val();
			var url = "{{url('admin/out/ajax-form')}}";
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
		
		$( "body" ).on( "change", "#cart_number_dropdown", function(e) {
			$('.loading').css('display', 'block');
			var cart_id = $('#cart_number_dropdown').val();
			var url = "{{url('admin/out/cart-info')}}";
			$.ajax({
				url: url,
				type: 'GET',
				data: { cart_id: cart_id },
				success: function(response)
				{
					$('#cartAjaxResponse').html(response);
					$('#gross_weight').val($('#tare_weight').val());
					$('.loading').css('display', 'none');
				}
			});
		});
		
		$( "body" ).on( "click", "#button-add-item", function(e) {
			e.preventDefault();
			var item_id = $('#item_id').val();
			var stopProcess = false;
			
			$( ".item-cart" ).each(function() {
			  	if(item_id == $(this).val()) {
					stopProcess = true;
			  		return false;
				}
			});
			
			if(!stopProcess) {
				$('.loading').css('display', 'block');
				var quantity = $('#quantity').val();
				var url = "{{url('admin/out/add-item')}}";
				$.ajax({
					url: url,
					type: 'GET',
					data: { item_id: item_id, quantity: quantity },
					success: function(response)
					{
						$('.no-item').css('display', 'none');
						$('#add-item-list').append(response);
						$('.loading').css('display', 'none');
					}
				});
				
				var gross_weight_field_value = $('#gross_weight').val();
				var net_weight_field_value = $('#net_weight').val();
				var url = "{{url('admin/out/weights')}}";
				$.ajax({
					url: url,
					type: 'GET',
					data: { item_id: item_id, gross_weight: gross_weight_field_value, net_weight: net_weight_field_value },
					success: function(response)
					{
						$('#weights-div').html(response);
						$('.loading').css('display', 'none');
					}
				});
			} else {
				alert('This item is already in the cart please select another item.');
			}
		});
		
		$( "body" ).on( "click", "#is_exchange_cart", function(e) {
			if(!$(this).is(':checked')) {
				$('#exchange-cart-div').css('display', 'none');
				$('#non-tracked-cart-div').fadeIn('slow');
				$('#tare_weight').removeAttr('readonly');
			} else {
				$('#non-tracked-cart-div').css('display', 'none');
				$('#exchange-cart-div').fadeIn('slow');
				$('#tare_weight').attr('readonly');
			}
		});
		
		/*$("#pageForm").validate({
			rules: {
				customer_name: "required"
			},
			submitHandler: function (form) {
				$('.loading').css('display', 'block');
				var options = {
					success: showResponse
				};
				function showResponse(responseText, statusText, xhr, $form) {
					$('#itemAjaxResponse').html(responseText);
					$('.loading').css('display', 'none');
				}
				$(form).ajaxSubmit(options);
			}
		});*/
    });
</script>
@endsection