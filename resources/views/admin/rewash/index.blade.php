@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Rewash</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Rewash</a>
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
        <a href="javascript:void(0)" id="newtab_link" onclick="window.open('/admin/rewash/list', 'Receipt', 'height=' + (screen.height-150) + ',width=' + (screen.width-150));" style="display:none;">Link</a>
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
                    
                    <div class="row">
                        <div class="col s12">
                            <label>Rewash Date</label>
                            <div id="rewash_date" name="rewash_date" class="datepicker"></div>
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
                                <div class="col s2 right-align">Weight kg/lb</div>
                                <div class="col s2 right-align">Action</div>
                            </div>
                            <div class="row records_list">
                                <h5 class="center-align">No Items have been added to this cart yet.</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="weights-div">
                        <div class="col m4 s12">
                            <label>Total Weight</label>
                            <div class="input-field">
                                <input id="total_weight" type="text" name="total_weight">
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
	$( window ).load(function() {
		@if (session('status'))
			$("#newtab_link")[0].click();
			
			$('.loading').show();
            var cus_id = $("#customer").val();
            var url = "{{url('admin/rewash/ajax-form')}}";
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
	
    $(document).ready(function () {
        $("#customer").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $("#item_id").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("#department").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
		$(".datepicker").jqxDateTimeInput({ width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
        $("body").on("change", "#customer", function (e) {
            $('.loading').show();
            var cus_id = $(this).val();
            var url = "{{url('admin/rewash/ajax-form')}}";
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
                var url = "{{url('admin/rewash/add-item')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {item_id: item_id, quantity: quantity},
                    success: function (response)
                    {
                        $('.no-item').css('display', 'none');
                        $('#add-item-list').append(response);
                        $("#item_count").val(1);
						
						var weight = 0;
						$('.weight-div').each(function(index) {
							var quan = $('.quantity-div').eq(index).text();
							weight += parseFloat($(this).text()) * quan;
						});
						
						$('#total_weight').val(weight);
						
						$('.loading').hide();
						
						$("#item_count").parent().siblings(".error").html("");
                    	$("#item_count").parent().siblings(".error").hide();
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
		
		var weight = $('#total_weight').val();
		weight -= parseFloat($(r).parent().parent().find('.weight-div').text()) * parseInt($(r).parent().parent().find('.quantity-div').text());	
		
		$('#total_weight').val(weight);
		
        if ($(".item-cart").length < 1) {
            $('.no-item').css('display', 'block');
            $("#item_count").val(0);
        }
    }
</script>
@endsection