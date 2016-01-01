<script type="text/javascript">
	$(document).ready(function(){
		mousemove_counter = 0;
		if(mousemove_counter <= 0){
			layout_table_auto_height(mousemove_counter);
			mousemove_counter = 1;
		}
	});
</script>
<form action="/admin/shiping-manifest/create" Method="POST" id="pageForm">
    {{csrf_field()}}
    <div class="col s12 m5">
        <fieldset>
            <legend>Shipping Manifest:</legend>
            <div class="row">
                <div class="col m6 s12">
                    <label>Customer Name:</label>
                    <select name="customer" id="customer">
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}" @if($customer->id==$active_customer->id) selected="selected" @endif >{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col m6 s12">
                    <label>Department:</label>
                    <select name="department" id="department">
                        <option value="-1" selected>Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" @if($department->id==$department_id) selected="selected" @endif >{{$department->department_name}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col m6 s12">
                    <label>Customer Number:</label>
                    <div class="input-field">
                        <input id="name" type="text" name="name" disabled="disabled" value="{{$active_customer->customer_number}}">
                    </div>
                </div>
                <div class="col m6 s12">
                    <label>Enter Ship Date:</label>
                    <div id="ship_date" type="text" name="ship_date"></div>

                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <label>Special text to appear after detail section for this manifest (different than manifest ending lines):</label>
                    <div class="input-field">
                        <textarea id="name" name="discription"></textarea>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col">
                <label  class="error" id="error-select_cart"></label>
            </div>
            <div class="col pull-right">
                <button class="waves-effect btn" type="submit">Save</button>
                <button class="waves-effect btn">Clear</button>
            </div>
        </div>
    </div>

    <div class="col s12 m7">
        <fieldset>
            <legend>Select Cart(s):</legend>
            <div class="row box">
                <div class="row layout_table no-topmargin">
                    <div class="row heading">
                        <div class="col s1 center-align chkbx">
                            <input type="checkbox" name="all_carts" id="all_carts">
                            <label for="all_carts"></label>
                        </div>
                        <div class="col s2">Cart Number</div>
                        <div class="col s3">Date Created</div>
                        <div class="col s3 right-align">Net Weight lb/kg</div>
                        <div class="col s3 center-align">Actions</div>
                    </div>
                    @if(!$carts->isEmpty())
                    @foreach($carts as $cart)
                    <div class="row records_list">
                        <div class="col s1 center-align chkbx">
                            <input type="checkbox" class="all_cart_checkbox" name="carts[{{$cart->id}}]" value="{{$cart->id}}" id="carts[{{$cart->id}}]">
                            <label for="carts[{{$cart->id}}]"></label>
                        </div>
                        <div class="col s2">{{$cart->cart_id}}</div>
                        <div class="col s3">@date($cart->shipping_date)</div>
                        <div class="col s3 right-align">{{$cart->net_weight}}</div>
                        <div class="col s3 center-align"><a href="/admin/out/receipt/{{$cart->id}}" class="edit-button">View</a> | <a href="/admin/out/edit/{{$cart->id}}"  class="edit-button">Edit</a> | <a href="/admin/out/delete/{{$cart->id}}" data-mode="ajax">Delete</a></div>
                    </div>
                    @endforeach
                    @else
                    <div class="row records_list">
                        <div class="col s12 center-align"><strong>No Carts.</strong></div>
                    </div>
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
</form>
<script>
    $(function () {
        $('#all_carts').change(function () {
            if ($(this).is(":checked")) {
                $(".all_cart_checkbox").prop( "checked", true );
            }
            else{
                $(".all_cart_checkbox").prop( "checked", false );
            }
            $("#error-select_cart").html("");
            $("#error-select_cart").hide();
        });
        $('.all_cart_checkbox').change(function () {
            $("#error-select_cart").html("");
            $("#error-select_cart").hide();
        });
        $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
        $("#ship_date").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px',formatString: 'MMMM dd, yyyy'});
        $('#customer').on('change', function () {
            if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val() != "-1") {
                $(".loading").css("display", "block");
                $.ajax({
                    url: "/admin/shiping-manifest/details/" + $(this).val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display", "none");
                });
            }
        });
        $('#department').on('change', function () {
            if ($("#department").jqxComboBox('getSelectedIndex') != "-1") {
                $(".loading").css("display", "block");
                $.ajax({
                    url: "/admin/shiping-manifest/details/"+$("#customer").val()+"/" + $(this).val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display", "none");
                });
            }
        });
        $("#pageForm").validate({
                ignore: [],
                rules: {
                    customer: "required"
            },
            submitHandler: function (form) {
				$('.loading').show();
                if($(".all_cart_checkbox").length<1 || $('.all_cart_checkbox:checked').length<1){
                $("#error-select_cart").html("Please select at least one cart");
                $("#error-select_cart").show();
                }
                else{
                    $(form).validate().cancelSubmit = true;
                    $(form).submit();
                }
            }
            });  
    });
</script>