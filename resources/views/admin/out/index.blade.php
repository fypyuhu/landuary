@extends('master')
@section('content') 

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
    	<form action="#!">
          <div class="col s12 m5 margin-right-md">
          	  <div id="customer-info">
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
              <fieldset>
                  <legend>Items List:</legend>
                  <div class="row box">
                      <div class="row no-topmargin">
                        <div class="col m8 s12">
                          <select name="item" id="item">
                            <option value="" disabled selected>Item Number</option>
                            @foreach($items as $item)
                            <option value="{{$item->id}}">{{$item->item_number}}</option>
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
                        <button class="waves-effect btn">Add</button>
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
        </form>
    </div>

  </section>
  <!-- /Main Content -->
  
@endsection

@section('js')
<script>
    $(document).ready(function () {
		$( "body" ).on( "click", function(e) {
			$("#customer, #cart_number, #item").jqxComboBox({width: '100%', autoDropDownHeight: true});
			$("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
			
			$("#customer").on('change',function(){
				var cus_id = $(this).val();
				var url = "{{url('admin/out/customer-info')}}";
				$.ajax({
					url: url,
					type: 'GET',
					data: { customer_id: cus_id },
					success: function(response)
					{
						alert(response);
						$('#customer-info').html(response);
						$('#department').removeAttr('disabled');
					}
				});
			});
		});
    });
</script>
@endsection