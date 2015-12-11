@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Incoming Carts</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Incoming Carts</a>
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
        
            {{csrf_field()}}
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
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
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
                                <div class="input-field" id="non-tracked-cart-div" >
                                    <input id="cart_number_textfield" type="text" value="{{$initial_values->cart_number}}" readonly="readonly" name="cart_number_textfield">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <label>Tare Weight</label>
                                <div class="input-field">
                                    <input id="tare_weight"  value="{{$initial_values->standard_tare_weight}}" type="text" name="tare_weight" readonly="readonly">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <label>Receiving Date</label>
                                <div name="receiving_date" id="receiving_date" class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <input type="checkbox" name="is_exchange_cart" id="is_exchange_cart" value="1" >
                                <label for="is_exchange_cart">Exchange Cart</label>
                            </div>
                            <div class="col m4 s12 pull-right" style="display: none;">
                                <label>Status</label>
                                <div class="input-field">
                                    <input type="hidden" name="status" id="status" readonly="readonly" value="In">
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
                            <div class="row no-topmargin">
                                <div class="col m8 s12">
                                    <label>Item Number</label>
                                    <select name="item_id" id="item_id">
                                        <option value="">Item Number</option>
                                    </select>
                                    <label for="item_id" class="error"></label>
                                </div>
                                <div class="col m4 s12">
                                    <label>Quantity</label>
                                    <div class="input-field">
                                        <input id="quantity" type="text" name="quantity">
                                    </div>
                                    <label for="quantity" class="error"></label>
                                </div>
                            </div>
                            <div class="row">
                                <button class="waves-effect btn" type="button" id="button-add-item">Add</button>
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
                            <div class="col m4 s12">
                                <label>Gross Weight</label>
                                <div class="input-field">
                                    <input id="gross_weight" type="text" onblur="calculateNetWeight()" name="gross_weight">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <label>Net Weight</label>
                                <div class="input-field">
                                    <input id="net_weight" value="0" type="text" name="net_weight">
                                </div>
                            </div>
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
    $(document).ready(function () {
        $("#customer, #cart_number_dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $("#item_id").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("body").on("change", "#customer", function (e) {
            $('.loading').show();
            var cus_id = $(this).val();
            var url = "{{url('admin/in/ajax-form')}}";
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
            $('.loading').show();
            var cart_id = $('#cart_number_dropdown').val();
            var url = "{{url('admin/in/cart-info')}}";
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
        $(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
        $("body").on("click", "#button-add-item", function (e) {
            e.preventDefault();
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
                var url = "{{url('admin/in/add-item')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {item_id: item_id, quantity: quantity},
                    success: function (response)
                    {
                        $('.no-item').css('display', 'none');
                        $('#add-item-list').append(response);
                        $("#item_count").val(1);
                    }
                });

                var gross_weight_field_value = $('#gross_weight').val();
                var net_weight_field_value = $('#net_weight').val();
                var num_items = $('#quantity').val();
                var url = "{{url('admin/in/weights')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {num_items: num_items, item_id: item_id, gross_weight: gross_weight_field_value, net_weight: net_weight_field_value},
                    success: function (response)
                    {
                       // $('#gross_weight').val(parseInt($('#gross_weight').val()) + parseInt(response));
                       // $("#net_weight").val(parseInt($('#net_weight').val()) + parseInt(response));
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
            $("#item_count").val(0);
        }
    }
    function calculateNetWeight() {
        gross=parseFloat($('#gross_weight').val());
        tare=parseFloat($('#tare_weight').val());
         $("#net_weight").val(gross-tare);
        if(gross<tare){
            $("#gross_weight").parent().siblings(".error").html("Gross weight can't be less than tear weight");
            $("#gross_weight").parent().siblings(".error").show();
            return;
        }
    }
</script>
@endsection