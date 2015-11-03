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

    <div class="row no-rightmargin">
      <div class="col s12 m5 margin-right-md">
          <div id="customer-info">
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
                    <input id="name" type="text" name="name" placeholder="Name" readonly="readonly">
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
          
          <fieldset>    
              <legend>Cart Information</legend>
              <div class="row">
                <div class="col m4 s12">
                  <div class="input-field">
                      <select name="cart_number" id="cart_number">
                        <option value="" disabled selected>Cart Number</option>
                        @foreach($carts as $cart)
                        <option value="{{$cart->id}}">{{$cart->id}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                    <input id="tare_weight" type="text" name="tare_weight" placeholder="Tare Weight">
                  </div>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                      <select name="gender">
                        <option value="" disabled selected>Ship Date</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col m6 s12">
                  <input type="checkbox" name="exchange" id="exchange" checked="checked">
                  <label for="exchange">Exchange Cart</label>
                </div>
                <div class="col m4 s12 pull-right">
                  <label for="status">Status</label>
                  <div class="input-field">
                    <input type="text" name="status" id="status" disabled="disabled" value="Auto Fill">
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
                  <form method="post" action="{{url('admin/out/item')}}" id="itemForm">
                  {{csrf_field()}}
                  <div class="row no-topmargin">
                    <div class="col m8 s12">
                      <select name="item_id" id="item_id">
                        <option value="">Item Number</option>
                        @foreach($items as $item)
                        <option value="{{$item->id}}">{{$item->item_number}}</option>
                        @endforeach
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
                  </form>
                  <div class="row layout_table">
                    <div class="row heading">
                        <div class="col s3">Item Number</div>
                        <div class="col s5">Item Description</div>
                        <div class="col s2 right-align">Quantity</div>
                        <div class="col s2 right-align">Weight</div>
                    </div>
                    <div class="row records_list">
                        <div class="col s3">Item 1</div>
                        <div class="col s5">Lorem Ipsum doller sit</div>
                        <div class="col s2 right-align">4</div>
                        <div class="col s2 right-align">4 KG</div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col m4 s12">
                  <div class="input-field">
                    <input id="gross_weight" type="text" name="gross_weight" placeholder="Gross Weight">
                  </div>
                </div>
                <div class="col m4 s12">
                  <div class="input-field">
                    <input id="net_weight" type="text" name="net_weight" placeholder="Net Weight">
                  </div>
                </div>
              </div>
          </fieldset>
      </div>
    </div>

  </section>
  <!-- /Main Content -->
  
@endsection

@section('js')
<script>
    $(document).ready(function () {
		$("#customer, #cart_number, #item_id").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		
		$( "body" ).on( "change", "#customer", function(e) {
			$('.loading').css('display', 'block');
			var cus_id = $(this).val();
			var url = "{{url('admin/out/customer-info')}}";
			$.ajax({
				url: url,
				type: 'GET',
				data: { customer_id: cus_id },
				success: function(response)
				{
					$('#customer-info').html(response);
					$('.loading').css('display', 'none');
				}
			});
		});
		
		$("#itemForm").validate({
			rules: {
				item_id: "required",
				quantity: {
					required: true,
					digits: true,
				}
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
		});
    });
</script>
@endsection