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
	
    @if (session('status'))
        <div class="row">
            <div class="col m5 s12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        </div>
        @if($cart_id)
        <a href="javascript:void(0)" id="newtab_link" onclick="window.open('/admin/out/receipt/{{$cart_id}}', 'Receipt', 'height=' + (screen.height-150) + ',width=' + (screen.width-150));" style="display:none;">Link</a>
        @endif
    @endif
    <div id="loadAjaxFrom">
        
            <div class="row no-rightmargin">
                <div class="col s12 m5 margin-right-md">
                    <fieldset>
                        <legend>Customer Information:</legend>
                        <div class="row">
                            <div class="col m6 s12">
                            	<label>Customer</label>
                                <select name="customer" id="customer">
                                    <option value="">Customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}" {{isset($current_customer) && $customer->id == $current_customer ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col m6 s12">
                            	<label>Department</label>
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
                            	<label>Customer Number</label>
                                <div class="input-field">
                                    <input id="customer_name" type="text" name="customer_name" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset id="cartAjaxResponse">    
                        <legend>Cart Information</legend>
                        <div class="row">
                            <div class="col m4 s12">
                            	<label>Cart Number</label>
                                <div class="input-field" id="exchange-cart-div" style="display:none;">
                                    <select name="cart_number_dropdown" id="cart_number_dropdown">
                                        <option value="">Cart Number</option>
                                        @foreach($carts as $cart)
                                        <option value="{{$cart->id}}">{{$cart->cart_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field" id="non-tracked-cart-div">
                                    <input id="cart_number_textfield" type="text" value="{{$initial_values->cart_number}}" readonly="readonly" name="cart_number_textfield">
                                </div>
                            </div>
                            <div class="col m3 s12">
                            	<label>Tare Weight</label>
                                <div class="input-field">
                                    <input id="tare_weight" type="text" value="{{$initial_values->standard_tare_weight}}" name="tare_weight">
                                </div>
                            </div>
                            <div class="col m5 s12">
                            	<label>Shipping Date</label>
                                <div id="ship_date" name="ship_date" class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <input type="checkbox" name="is_exchange_cart" id="is_exchange_cart" value="1" >
                                <label for="is_exchange_cart">Exchange Cart</label>
                            </div>
                            <div class="col m4 s12 pull-right" style="display:none;">
                                <label for="status">Status</label>
                                <div class="input-field">
                                    <input type="text" name="status" id="status" readonly="readonly" value="Ready">
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
                    <fieldset id="itemAjaxResponse">
                        <legend>Items List:</legend>
                        <div class="row box">
                            {{csrf_field()}}
                            <div class="row no-topmargin">
                                <div class="col m8 s12">
                                	<label>Item Name</label>
                                    <select name="item_id" id="item_id">
                                        <option value="">Item Name</option>
                                    </select>
                                    <label for="item_id" class="error"></label>
                                </div>
                                <div class="col m4 s12">
                                	<label>Quantity</label>
                                    <div class="input-field">
                                        <input id="quantity" type="text" name="quantity" placeholder="Quantity">
                                    </div>
                                    <label for="quantity" class="error"></label>
                                </div>
                            </div>
                            <div class="row">
                                <button class="waves-effect btn" id="button-add-item">Add</button>
                            </div>
                            <div class="row layout_table">
                                <div class="row heading">
                                    <div class="col s3">Item Number</div>
                                    <div class="col s3">Item Description</div>
                                    <div class="col s2 right-align">Quantity</div>
                                    <div class="col s2 right-align">Weight</div>
                                    <div class="col s2 right-align">Action</div>
                                </div>
                                <div class="row records_list">
                                    <h5 class="center-align">No Items have been added to this cart yet.</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="weights-div">
                            <div class="col m4 s12 loading-sm-parent">
                                <label>Gross Weight <img src="{{URL::asset('images/ajax-loader-sm.gif')}}" alt="" class="loading-sm" /></label>
                                <div class="input-field">
                                    <input id="gross_weight" value="" type="text" onblur="calculateNetWeight()" name="gross_weight">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <label>Net Weight</label>
                                <div class="input-field">
                                    <input id="net_weight" type="text" name="net_weight" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<a href="javascript:void(0);" class="waves-effect btn" style="background: #279977; height: 20px; line-height: 20px; font-size: 9px;" id="btn-get-weight">Get Weight</a>
                        </div>
                    </fieldset>
                </div>
            </div>
    </div>

</section>
<!-- /Main Content -->

@endsection

@section('js')
<script>
	$( window ).load(function() {
		@if (session('status'))
			$("#newtab_link")[0].click();
			
			var cus_id = $('#customer').val();
            $('.loading').show();
            var url = "{{url('admin/out/ajax-form')}}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {customer_id: cus_id},
                success: function (response)
                {
                    $('#loadAjaxFrom').html(response);
                    $('.loading').hide();
                }
            });
		@endif	
	});
	
    var my_groos_weight=0;
    var my_net_weight=0;
    $(document).ready(function () {
        $("#customer, #cart_number_dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $("#item_id").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
        
		$("body").on("click", "#btn-get-weight", function (e) {
			$('.loading-sm').show();
            var url = "{{url('admin/carts/machine-weight')}}";
            $.ajax({
                url: url,
                type: 'GET',
                //data: {customer_id: cus_id},
                success: function (response)
                {
                    $('#gross_weight').val(response);
                    $('.loading-sm').hide();
					calculateNetWeight();
                }
            });
		});
		
		$("body").on("change", "#customer", function (e) {
            var cus_id = $(this).val();
            if(cus_id==""){
                return;
            }
            $('.loading').show();
            var url = "{{url('admin/out/ajax-form')}}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {customer_id: cus_id},
                success: function (response)
                {
                    $('#loadAjaxFrom').html(response);
                    $('.loading').hide();
                }
            });
        });

        $("body").on("change", "#cart_number_dropdown", function (e) {
            var cart_id = $('#cart_number_dropdown').val();
            $('.loading').show();
            var url = "{{url('admin/out/cart-info')}}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {cart_id: cart_id},
                success: function (response)
                {
                    $('#cartAjaxResponse').html(response);
                    $('#gross_weight').val($('#tare_weight').val());
                    $('.loading').hide();
                }
            });
        });
		
        $("body").on("click", "#button-add-item", function (e) {
            
            e.preventDefault();
			$("#item_count").parent().siblings(".error").html("");
                        $("#item_count").parent().siblings(".error").hide();
			$("#quantity").keyup(function(e){
				if ($("#quantity").val() != "" || $("#quantity").val() > "0")
				{
					$('label[for="quantity"]').html('').hide();
				} else {
					$('label[for="quantity"]').html('Please add quantity').show();
				}
			});
			
            var item_id = $('#item_id').val();
            var stopProcess = false;
            if(!$("#item_id").jqxComboBox('getSelectedItem')){
                var stopProcess = true;
                return;
            }
			$('label[for="quantity"]').html('').hide();
            if ($("#quantity").val() == "" || $("#quantity").val() == "0")
            {
                $('label[for="quantity"]').html('Please add quantity').show();
                return;
            }
            $(".item-cart").each(function () {
                if (item_id == $(this).val()) {
                    stopProcess = true;
                    return false;
                }
            });

            if (!stopProcess) {
                $('.loading').show();
                var quantity = $('#quantity').val();
                var url = "{{url('admin/out/add-item')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {item_id: item_id, quantity: quantity},
                    success: function (response)
                    {
                        $("#quantity").val("");
                        $('.no-item').css('display', 'none');
                        $('#add-item-list').append(response);
                        $("#item_count").val(1);
                    }
                });

                var gross_weight_field_value = my_groos_weight;
                var net_weight_field_value = my_net_weight;
                var num_items = $('#quantity').val();
                var url = "{{url('admin/out/weights')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {num_items: num_items, item_id: item_id, gross_weight: gross_weight_field_value, net_weight: net_weight_field_value},
                    success: function (response)
                    {
                        my_groos_weight+=parseFloat(response);
                        //$('#weights-div').html(response);
                        $('.loading').hide();
                    }
                });
            } else {
                alert('This item is already in the cart please select another item.');
            }
        });

        $("body").on("click", "#is_exchange_cart", function (e) {
            if (!$(this).is(':checked')) {
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
         $('.loading').show();
         var options = {
         success: showResponse
         };
         function showResponse(responseText, statusText, xhr, $form) {
         $('#itemAjaxResponse').html(responseText);
         $('.loading').hide();
         }
         $(form).ajaxSubmit(options);
         }
         });*/
    });
    function removeRow(r) {
        $(r).parent().parent().remove();
        if ($(".item-cart").length < 1) {
            $('.no-item').css('display', 'block');
            $("#item_count").val(0)
        }
    }
    function calculateNetWeight(){
        gross=parseFloat($('#gross_weight').val());
        tare=parseFloat($('#tare_weight').val());
        var net_weight=gross-tare;
        var daviation= my_groos_weight*0.1;
        if(net_weight>my_groos_weight+daviation){
            alert("Your net weight is 10% higher than the item weights saved in the system");
        }
        else if(net_weight<my_groos_weight-daviation){
            alert("Your net weight is 10% less than the item weights saved in the system");
        }
         $("#net_weight").val(net_weight);
        if(gross<tare){
            $("#gross_weight").parent().siblings(".error").html("Gross weight can't be less than tear weight");
            $("#gross_weight").parent().siblings(".error").show();
            return;
        }
    }
</script>
@endsection