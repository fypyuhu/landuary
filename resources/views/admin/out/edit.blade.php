@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Edit Outgoing Cart</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Edit Outgoing Cart</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>
        <div clas="row">
            <a class="waves-effect btn" href='{{URL::previous()}}'>Back</a>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <div id="loadAjaxFrom">
        <form method="post" action="/admin/out/edit/{{$ogc->id}}" id="pageForm">
            <div class="row no-rightmargin">
                <div class="col s12 m5 margin-right-md">
                    <fieldset>
                        <legend>Customer Information:</legend>
                        <div class="row">
                            <div class="col m6 s12">
                                <select name="customer" id="customer" >
                                    <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                </select>
                            </div>
                            <div class="col m6 s12">
                                <select name="department" id="department" >
                                    <option value="{{$dept->id or ''}}">{{$dept->department_name or ''}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <input id="name" type="text" name="name" value="{{$customer->customer_number}}" placeholder="Name" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset id="cartAjaxResponse">    
                        <legend>Cart Information</legend>
                        <div class="row">
                            <div class="col m4 s12">
                                <div class="input-field" id="exchange-cart-div" @if($ogc->is_exchange_cart==0) style="display: none;" @endif>
                                     <select name="cart_number_dropdown" id="cart_number_dropdown" disabled>
                                        <option value="{{$cart->id or ''}}">{{$cart->cart_number or ''}}</option>
                                    </select>
                                </div>
                                <div class="input-field" id="non-tracked-cart-div" @if($ogc->is_exchange_cart==1) style="display: none;" @endif >
                                     <input id="cart_number_textfield" readonly="readonly" type="text" value="{{$ogc->cart_id}}" name="cart_number_textfield" placeholder="Cart Number">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="tare_weight" type="text" value="{{$initial_values->standard_tare_weight}}" name="tare_weight" placeholder="Tare Weight">
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div id="ship_date"   name="ship_date"  class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12" style="display:none;">
                                <input type="checkbox" name="is_exchange_cart" id="is_exchange_cart" value="1" >
                                <label for="is_exchange_cart">Exchange Cart</label>
                            </div>
                            <div class="col m4 s12 pull-right" style="display:none;">
                                <label for="status">Status</label>
                                <div class="input-field">
                                    <input type="text" name="status" id="status" placeholder="Cart Status" readonly="readonly" value="Ready">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" value="{{URL::previous()}}" name="return_url">
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
                                        @foreach ($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col m4 s12">
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
                                <div class="row records_list no-item" style="display:none;">
                                    <h5 class="center-align">No Items have been added to this cart yet.</h5>
                                </div>
                                @foreach($selected_items as $item)
                                <div class="row records_list">
                                    <div class="col s3">{{$item->name}} <input type="hidden" class="item-cart" name="item_cart[]" value="{{$item->id}}" /></div>
                                    <div class="col s3">{{$item->description}}</div>
                                    <div class="col s2 right-align">{{$item->quantity}} <input type="hidden" name="item_quantity[]" value="{{$item->quantity}}" /></div>
                                    <div class="col s2 right-align">{{$item->weight}} kg/lb</div>
                                    <div class="col s2 right-align"><button  class="waves-effect btn" type="button" onclick="removeRow(this)">Remove</button></div>
                                </div>
                                @endforeach
                                <div>
                                    <input type="hidden" name="item_count" id="item_count" value="1">
                                </div>
                                <label for="item_count" class="error" id="error-item_count"></label>
                                <div id="add-item-list"></div>

                            </div>
                        </div>
                        <div class="row" id="weights-div">
                            <div class="col m4 s12">
                                <label>Gross Weight</label>
                                <div class="input-field">
                                    <input id="gross_weight" type="number" step="0.01" onblur="calculateNetWeight()" value="{{$ogc->gross_weight}}" name="gross_weight" placeholder="Gross Weight">
                                </div>
                                <label for="gross_weight" class="error" id="error-gross_weight"></label>
                            </div>
                            <div class="col m4 s12">
                                <label>Net Weight</label>
                                <div class="input-field">
                                    <input id="net_weight" type="text" value="{{$ogc->net_weight}}" readonly="readonly" name="net_weight" placeholder="Net Weight">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#customer, #cart_number_dropdown").jqxComboBox({width: '100%', autoDropDownHeight: true,disabled: true});
        $("#item_id").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $(".calendar").jqxDateTimeInput({value:new Date("{{$ogc->shipping_date->format('Y-m-d')}}"), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy', disabled: true});
        $("body").on("change", "#customer", function (e) {
            var cus_id = $(this).val();
            if (cus_id == "") {
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
            $("#quantity").keyup(function (e) {
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

                var gross_weight_field_value = $('#gross_weight').val();
                var net_weight_field_value = $('#net_weight').val();
                var num_items = $('.item-cart').length;
                var url = "{{url('admin/out/weights')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {num_items: num_items, item_id: item_id, gross_weight: gross_weight_field_value, net_weight: net_weight_field_value},
                    success: function (response)
                    {
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

        $("#pageForm").validate({
                ignore: [],
                rules: {
                    customer_name: "required",
                    gross_weight: {
                        required:true,
                        min:parseFloat($('#tare_weight').val())
                    }
                
            },
            submitHandler: function (form) {
				$('.loading').show();
                if(parseFloat($("#item_count").val())<1){
                $("#item_count").parent().siblings(".error").html("Please add at least one item");
                $("#item_count").parent().siblings(".error").show();
                }
                else{
                    $(form).validate().cancelSubmit = true;
                    $(form).submit();
                }
            }
            });
    });
    function removeRow(r) {
        $(r).parent().parent().remove();
        if ($(".item-cart").length < 1) {
            $('.no-item').css('display', 'block');
            $("#item_count").val(0)
        }
    }
    function calculateNetWeight() {
        gross = parseFloat($('#gross_weight').val());
        tare = parseFloat($('#tare_weight').val());
        $("#net_weight").val(gross - tare);
        if (gross < tare) {
            $("#gross_weight").parent().siblings(".error").html("Gross weight can't be less than tear weight");
            $("#gross_weight").parent().siblings(".error").show();
            return;
        }
    }
</script>
@endsection