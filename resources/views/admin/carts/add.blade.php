<fieldset id="add-record" style="width: 500px;">
    <legend>Add Cart:</legend>
    <form method="post" action="{{url('admin/carts/create')}}" id="pageForm">
        {{csrf_field()}}
        <div class="row">
            <input type="checkbox" name="chkbx_enb_cus_num" id="chkbx_enb_cus_num">
            <label for="chkbx_enb_cus_num">Use Custom Cart Number</label>
        </div>
        <div class="row">
            <div class="col s6">
                <label>Cart Number:</label>
                <div class="input-field">
                    <input id="number" type="text" name="cart_number" readonly="readonly" value="{{ $get_max_number }}">
                </div>
                <label for="cart_number" class="error" id="error-cart-number"></label>
            </div>
        </div>

        <div class="row">
            <ul class="ctabs">
                <li class="current" data-corr-div-id="#cart-tab">Carts</li>
            </ul>
        </div>

        <div class="row tab-content no-topmargin first" id="cart-tab">
            <fieldset style="margin-top:15px;">
                <legend>Carts</legend>
                <div class="row">
                    <div class="col s12">
                        <input type="checkbox" value="1" name="use_as_exchange_cart" id="use_as_exchange_cart" class="checkbox" data-corr-div-id="#cart-status-div">
                        <label for="use_as_exchange_cart">Use this as Exchange Cart</label>
                    </div>
                </div>
                <div class="row">
                    <label>Cart Tare Weight:</label>
                    <div class="input-field">
                        <input id="tare_weight" type="text" name="tare_weight">
                    </div>
                    <label for="tare_weight" class="error" id="error-tare-weight"></label>
                </div>
                <div class="row">
                    <label>Cart Status:</label>
                    <div class="input-field">
                        <select name="status" id="status">
                            <option value="">Please Select</option>
                            <option value="In" selected="selected">In</option>
                            <option value="Out">Out</option>
                            <option value="Ready">Ready</option>
                        </select>
                    </div>
                    <label for="status" class="error" id="error-status"></label>
                </div>
                <div id="cart-status-div" style="display: none">
                    <div class="row">
                        <label>Cart Current Location:</label>
                        <div class="input-field">
                            <input id="cart_current_location" type="text" name="cart_current_location" value="In House" readonly="readonly">
                        </div>
                        <label for="cart_current_location" class="error" id="error-cart-current-location"></label>
                    </div>
                    <div class="row">
                        <label>Customer Number:</label>
                        <div class="input-field">
                            <select name="customer_number" id="customer_number">
                                <option value="">Please Select</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                            </select>
                        </div>
                        <label for="customer_number" class="error" id="error-customer-number"></label>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="row">
            <button class="waves-effect btn">Save</button>
            <button class="waves-effect btn">Clear</button>
        </div>
    </form>
</fieldset>
<script type="text/javascript">
    $(document).ready(function () {
        $("#status").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("#customer_number").jqxComboBox({width: '400', autoDropDownHeight: true});

        $("#pageForm").validate({
            rules: {
                cart_number: "required",
                tare_weight: "required",
                status: "required",
                cart_current_location: {required: "#use_as_exchange_cart:checked"},
                customer_number: {required: "#use_as_exchange_cart:checked"}
            },
            submitHandler: function (form) {
                var options = {
                    success: showResponse
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                $(form).ajaxSubmit(options);
            }
        });
        $('#chkbx_enb_cus_num').click(function(){
			if(!$(this).is(':checked')) {
				$('#number').attr('readonly','readonly');
                                $('#number').val('{{$get_max_number}}');
			} else {
				$('#number').removeAttr('readonly');
                                $('#number').val('');
			}
		});
		
		$('#use_as_exchange_cart').click(function(){
			if($(this).is(':checked')) {
				$('#chkbx_enb_cus_num').trigger( "click" ).attr('disabled','disabled');
			} else {
				$('#chkbx_enb_cus_num').removeAttr('disabled').trigger( "click" );
			}
		});
        
    });
</script>
