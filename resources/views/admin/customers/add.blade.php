<fieldset id="add-record" style="width: 705px;">
    <legend>Add Customer:</legend>
    <form action="/admin/cutomers/create" Method="POST" id="customer-form">
        <div class="row">
            <div class="col m6 s12">
                <label>Name:</label>
                <div class="input-field">
                    <input id="ship_to_name" type="text" onblur="return checkError('Custome Name', 'ship_to_name')" name="ship_to_name">
                </div>
                <label for="ship_to_name" class="error" id="error-ship_to_name"></label>
            </div>    
            <div class="col m6 s12">
                <label>Customer Number:</label>
                <div class="input-field">
                    <input id="customer_number" type="text" onblur="return checkError('Custome Number', 'customer_number')" name="customer_number">
                </div>
                <label for="customer_number" class="error" id="error-customer_number"></label>
            </div>  

        </div>
        <div class="row">
            <div class="col s2" style="padding:4px;">
                <label>Use Department:</label>
                <input type="checkbox" name="use_department"  id="use_department" value="1">
                <label for="use_department"></label>
            </div>
        </div>
        <div class="row" id="department_div" style="display:none;">
            <div class="col m5 s8">
                <label>Department Name:</label>
                <div class="input-field">
                    <input id="department" type="text"  name="department">
                </div>
            </div>
            <div class="col m1 s4" style="margin-top:20px;">
                <div class="input-field">
                    <button class="waves-effect btn" type="button" onclick="addDepartment()">+</button>
                </div>
            </div>
            <div class="col m6 s12">
                <label>List:</label>
                <select name="department_list" id="department_list">

                </select>

            </div>  

        </div>
        <div class="row">
            <ul class="ctabs">
                <li class="current" data-corr-div-id="#address-tab">Address</li>
                <li data-corr-div-id="#billing-tab">Billing &amp; Tax</li>
                <li data-corr-div-id=".items-tab">Items</li>
            </ul>
        </div>
        <section class="row tab-content no-topmargin first" id="address-tab">
            <fieldset style="margin-bottom:0;">
                <legend>Address</legend>
                <h2>Shipping Address</h2>
                <div class="row">
                    <div class="col m12 s12">
                        <label>Address:</label>
                        <div class="input-field">
                            <input id="ship_to_address" onblur="return checkError('Adress', 'ship_to_address')" type="text" name="ship_to_address">
                        </div>
                        <label for="ship_to_address" class="error" id="error-ship_to_address"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col m4 s12">
                        <label>City:</label>
                        <div class="input-field">
                            <input id="ship_to_city" type="text" name="ship_to_city" onblur="return checkError('City', 'ship_to_city')">
                        </div>
                        <label for="ship_to_city" class="error" id="error-ship_to_city"></label>
                    </div>
                    <div class="col m4 s12">
                        <label>State:</label>
                        <div class="input-field">
                            <input id="ship_to_state" type="text" name="ship_to_state" onblur="return checkError('Sate', 'ship_to_state')">
                        </div>
                        <label for="ship_to_state" class="error" id="error-ship_to_state"></label>
                    </div>
                    <div class="col m4 s12">
                        <label>Zipcode:</label>
                        <div class="input-field">
                            <input id="ship_to_zipcode" type="text" name="ship_to_zipcode" onblur="return checkError('Zipcode', 'ship_to_zipcode')">
                        </div>
                        <label for="ship_to_zipcode" class="error" id="error-ship_to_zipcode"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <label>Phone:</label>
                        <div class="input-field">
                            <input id="phone" type="text" name="phone" onblur="return checkError('Phone', 'phone')">
                        </div>
                        <label for="phone" class="error" id="error-phone"></label>
                    </div>
                    <div class="col m6 s12">
                        <label>Fax:</label>
                        <div class="input-field">
                            <input id="fax" type="text" name="fax">
                        </div>
                        <label for="fax" class="error" id="error-fax"></label>
                    </div>
                </div>
                <h2>Billing Address</h2>
                <div class="row">
                    <div class="col m6 s12">
                        <input type="radio" name="billing_address" id="add_billing_address" data-corr-div-id="#billing-address-div" class="radiobutton" /><label for="add_billing_address">Add Billing Address</label>
                    </div>
                    <div class="col m6 s12">
                        <input type="radio" name="billing_address" id="same_as_shipping" checked="checked" data-corr-div-id="#billing-address-div" /><label for="same_as_shipping" style="margin-right:0;">Same as Shipping Address</label>
                    </div>
                </div>
                <div style="display:none;" id="billing-address-div">
                    <div class="row">
                        <div class="col m12 s12">
                            <label>Address:</label>
                            <div class="input-field">
                                <input id="billing_ship_to_address" type="text" name="billing_ship_to_address" onblur="return checkError('Address', 'billing_ship_to_address')">
                            </div>
                            <label for="billing_ship_to_address" class="error" id="error-billing_ship_to_address"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m4 s12">
                            <label>City:</label>
                            <div class="input-field">
                                <input id="billing_ship_to_city" type="text" name="billing_ship_to_city" onblur="return checkError('City', 'billing_ship_to_city')">
                            </div>
                            <label for="billing_ship_to_city" class="error" id="error-billing_ship_to_city"></label>
                        </div>
                        <div class="col m4 s12">
                            <label>State:</label>
                            <div class="input-field">
                                <input id="billing_ship_to_state" type="text" name="billing_ship_to_state" onblur="return checkError('State', 'billing_ship_to_state')">
                            </div>
                            <label for="billing_ship_to_state" class="error" id="error-billing_ship_to_state"></label>
                        </div>
                        <div class="col m4 s12">
                            <label>Zipcode:</label>
                            <div class="input-field">
                                <input id="billing_ship_to_zipcode" type="text" name="billing_ship_to_zipcode" onblur="return checkError('Zipcode', 'billing_ship_to_zipcode')">
                            </div>
                            <label for="billing_ship_to_zipcode" class="error" id="error-billing_ship_to_zipcode"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Phone:</label>
                            <div class="input-field">
                                <input id="billing_phone" type="text" name="billing_phone" onblur="return checkError('Phone', 'billing_phone')">
                            </div>
                            <label for="billing_phone" class="error" id="error-billing_phone"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Fax:</label>
                            <div class="input-field">
                                <input id="billing_fax" type="text" name="billing_fax">
                            </div>
                            <label for="billing_fax" class="error" id="error-billing_fax"></label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="row tab-content no-topmargin" id="billing-tab">
            <fieldset>
                <legend>Billing</legend>
                <div class="row">
                    <div class="col m4 s12">
                        <label>Bill Type:</label>
                        <select name="bill_type" id="bill_type">
                            <option value="In">In</option>
                            <option value="Out">Out</option>
                        </select>
                        <label for="bill_type" class="error" id="error-bill_type"></label>
                    </div>
                    <div class="col m8 s12">
                        <label>Terms:</label>
                        <div class="input-field">
                            <input id="terms" type="text" name="terms" onblur="return checkError('Terms', 'terms')">
                        </div>
                        <label for="terms" class="error" id="error-terms"></label>
                        <div>
                            <label>Days Due:</label>
                            <div class="input-field">
                                <input id="days_due" type="text" name="days_due" onblur="return checkError('Days Due', 'days_due')">
                            </div>
                            <label for="days_due" class="error" id="error-days_due"></label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Tax</legend>
                <div class="row">
                    <div class="col s12">
                        <input type="radio" name="chkbx_taxable" checked="checked" id="chkbx_taxable" data-set-class=".set-taxable" data-corr-div-id="#taxable-div" class="radiobutton">
                        <label for="chkbx_taxable">Taxable</label>
                    </div>
                    <div class="col s12">
                        <input type="radio" name="chkbx_taxable" id="chkbx_taxable_exampt" data-set-class=".set-taxable" data-corr-div-id="#taxable-exampt-div" class="radiobutton">
                        <label for="chkbx_taxable_exampt">Tax Exempt</label>
                    </div>
                </div>
                <div class="row set-taxable" style="display: none;" id="taxable-exampt-div">
                    <div class="row">
                        <label>Please upload tax exempt certificate:</label>
                        <div>
                            <input type="file" name="exemp_certificate" id="exemp_certificate" onchange="return taxError()"/>
                        </div>
                    </div>
                    <div class="row">OR</div>
                    <div class="row">
                        <div class="col s6">
                            <label>Reseller Number:</label>
                            <div class="input-field">
                                <input type="text" name="reseller_number" id="reseller_number" onblur="return taxError()"/>
                            </div>
                        </div>
                    </div>
                </div>
                <label  class="error" id="error-examp_tax"></label>
                <div class="row set-taxable"  id="taxable-div">
                    <div class="col s6">
                        <label>Sales Tax:</label>
                        <select name="sales_tax_authority" id="sales_tax_authority">
                            <option value="1">Sales Tax Rule 1</option>
                            <option value="2">Sales Tax Rule 2</option>
                            <option value="3">Sales Tax Rule 3</option>
                        </select>
                        <label for="sales_tax_authority" class="error" id="error-sales_tax_authority"></label>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="row tab-content no-topmargin items-tab">
            <div class="row price-div-set" id="div-price-by-weight" style="margin-bottom:15px; ">
                <div class="col m3 s12" style="margin-top:0;">
                    <label>Price Per lb/kg:</label>
                    <div class="input-field">
                        <input id="price-by-weight" type="text" name="price-by-weight">
                    </div>
                    <label for="bill_type" class="error" id="error-bill_type"></label>
                </div>
            </div>

            <div class="row layout_table" style="margin-top:0;">
                <div class="row heading">
                    <div class="col s5">Item </div>
                    <div class="col s5">Sub Item</div>
                    <div class="col s2 center-align">Assign</div>
                </div>
                <div class="row records_list">
                    <div class="col s5">
                        <select name="parent_item" id="parent_item">
                            @foreach($parent_items as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="bill_type" class="error" id="error-bill_type"></label>
                    <div class="col s5" id="child_select_box_div">
                        <select name="child_item" id="child_item">

                        </select>
                    </div>
                    <label for="bill_type" class="error" id="error-bill_type"></label>
                    <div class="col s2 center-align">
                        <button class="waves-effect btn" type="button" onclick="getItemDetail()">+</button>
                    </div>
                </div>
            </div>

            <div class="row layout_table" id="item_record_list">
                <div class="row heading">
                    <div class="col s3" id="t-category">Item</div>
                    <div class="col s2">Sub Item</div>
                    <div class="col s2 right-align">Weight</div>
                    <div class="col s3" id="t-type">Transaction Type</div>
                    <div class="col s2 center-align">Taxable</div>
                    <div class="col s2" style="display:none;" id="price-heading">Price</div>
                </div>

                <div class="row records_list" id="records_list_no_record">
                    <div class="col s12 center-align"><strong>No products have been assigned to this customer yet.</strong></div>
                </div>
            </div>
        </section>
        <section style="margin-top:15px; display:none;" class="items-tab tab-content">
            <legend>Pricing</legend>
            <div class="row">
                <strong style="margin-right: 15px;">Select billing by:</strong>
                <input type="radio" checked="checked" name="price_option" id="price_by_weight" class="pricing-rd-btn" /><label for="price_by_weight">Weight</label>
                <input type="radio" name="price_option" id="price_by_item" class="pricing-rd-btn" /><label for="price_by_item">Item</label>
                <input type="radio" name="price_option" id="price_by_both" class="pricing-rd-btn" /><label for="price_by_both">Both</label>
            </div>
        </section>
        <div class="row">
            <button class="waves-effect btn" style="display: none;">Save</button>
        </div>
    </form>
    <div class="row">
        <div class="pull-right">
            <button class="waves-effect btn" type="button" id="previous-btn" style="display:none;" onclick="changeTab(0);">Previous</button>
            <button class="waves-effect btn" type="button" id="next-btn" onclick="changeTab(1);">Next</button>
            <button class="waves-effect btn" type="button" id="save-btn" style="display:none;" onclick="changeTab(1);">Save</button>
        </div>
    </div>
</fieldset>

<script>
    function addDepartment() {
        if ($('#department').val() != "") {
            $("#department_list").jqxComboBox('addItem', {label: $('#department').val(), checked: true});
        }
    }
    function taxError()
    {
        if ($("#reseller_number").val() == "" && ($("#exemp_certificate").val() == "")) {
            $("#error-examp_tax").html("Exempt Certificate or Reseller Number is required");
            return;
        }
        else {
            $("#error-examp_tax").html('');
        }
    }
    function getItemDetail() {
        if ($('#parent_item').jqxComboBox('getSelectedIndex') != "-1") {
            var val = $('#parent_item').val();
            var parent = 1;
            if ($('#child_item').jqxComboBox('getSelectedIndex') != "-1") {
                val = $('#child_item').val();
                parent = 0;
            }

            $.ajax({
                url: "/admin/customers/item-detail/" + val,
                context: document.body
            }).done(function (html) {
                $('#item_record_list').append(html);
                $('#records_list_no_record').hide();
                if ($("#price_by_weight").is(':checked')) {
                    $('.price-field, #price-heading').css('display', 'none');
                    $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s2').addClass('s3');
                    $('#div-price-by-weight').fadeIn('slow');
                }
                else if ($("#price_by_item").is(':checked')) {
                    $('#div-price-by-weight').css('display', 'none');
                    $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
                    $('.price-field, #price-heading').fadeIn('slow');
                }
                else if ($("#price_by_both").is(':checked')) {
                    $('#div-price-by-weight').fadeIn('slow');
                    $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
                    $('.price-field, #price-heading').fadeIn('slow');
                }
            });
        }
    }
    function checkError(field, id) {
        if ($("#" + id).val() === '') {
            $("#error-" + id).html(field + " is required");
            $("#" + id).addClass('error');
            return false;
        }
        else {
            $("#error-" + id).html("");
            $("#" + id).removeClass('error');
            return true;
        }
    }
    var activeTab = "address";
    function changeTab(move) {
        if (move === 0) {
            if (activeTab === "address") {
                return;
            }
            else if (activeTab === "billing") {
                $("#address-tab").show();
                $("#billing-tab").hide();
                $("#previous-btn").hide();
                $("li[data-corr-div-id='#address-tab']").addClass("current");
                $("li[data-corr-div-id='#billing-tab']").removeClass("current");
                activeTab = "address";
                return;
            }
            else if (activeTab === "items") {
                $("#billing-tab").show();
                $(".items-tab").hide();
                activeTab = "billing";
                $("li[data-corr-div-id='#billing-tab']").addClass("current");
                $("li[data-corr-div-id='.items-tab']").removeClass("current");
                $("#save-btn").hide();
                $("#next-btn").show();
                return;
            }
        }
        else {
            if (activeTab === "address") {
                if (checkError('Adress', 'ship_to_address') && checkError('City', 'ship_to_city') && checkError('Sate', 'ship_to_state') && checkError('Zipcode', 'ship_to_zipcode') && checkError('Phone', 'phone'))
                {
                    if ($("#add_billing_address").is(":checked")) {
                        if (checkError('Adress', 'billing_ship_to_address') && checkError('City', 'billing_ship_to_city') && checkError('Sate', 'billing_ship_to_state') && checkError('Zipcode', 'billing_ship_to_zipcode') && checkError('Phone', 'billing_phone'))
                        {
                            $("#address-tab").hide();
                            $("#billing-tab").show();
                            $("#previous-btn").show();
                            activeTab = "billing";
                            $("li[data-corr-div-id='#billing-tab']").addClass("current");
                            $("li[data-corr-div-id='#address-tab']").removeClass("current");
                        }
                    }
                    else {
                        $("#address-tab").hide();
                        $("#billing-tab").show();
                        $("#previous-btn").show();
                        activeTab = "billing";
                        $("li[data-corr-div-id='#billing-tab']").addClass("current");
                        $("li[data-corr-div-id='#address-tab']").removeClass("current");
                    }
                }
                return;
            }
            else if (activeTab === "billing") {
                if (checkError('Terms', 'terms') && checkError('Days Due', 'days_due') && $("#bill_type").jqxComboBox('getSelectedIndex') != "-1")
                {
                    if ($("#chkbx_taxable").is(':checked') && $("#sales_tax_authority").jqxComboBox('getSelectedIndex') != "-1")
                    {
                        $(".items-tab").show();
                        $("#billing-tab").hide();
                        $("#previous-btn").attr("diasbled", true);
                        activeTab = "items";
                        $("li[data-corr-div-id='.items-tab']").addClass("current");
                        $("li[data-corr-div-id='#billing-tab']").removeClass("current");
                        $("#next-btn").hide();
                        $("#save-btn").show();

                    }
                    if ($("#chkbx_taxable_exampt").is(':checked'))
                    {
                        if ($("#reseller_number").val() == "" && $("#exemp_certificate").val() == "") {
                            $("#error-examp_tax").html("Exempt Certificate or Reseller Number is required");
                            return;
                        }
                        else {
                            $(".items-tab").show();
                            $("#billing-tab").hide();
                            $("#previous-btn").attr("diasbled", true);
                            activeTab = "items";
                            $("li[data-corr-div-id='.items-tab']").addClass("current");
                            $("li[data-corr-div-id='#billing-tab']").removeClass("current");
                            $("#next-btn").hide();
                            $("#save-btn").show();

                        }
                    }
                }

                return;
            }
            else if (activeTab === "items") {
                if (checkError('Customer Name', 'ship_to_name') && checkError('Customer Number', 'customer_number')) {
                    var options = {
                        success: showResponse
                    };
                    function showResponse(responseText, statusText, xhr, $form) {
                        location.reload();
                    }
                    $('#customer-form').ajaxSubmit(options);
                }
            }
        }
    }
    $(document).ready(function () {
        $('#add_billing_address').click(function (e) {
            var corr_div_id = $(this).data('corr-div-id');
            $(corr_div_id).fadeIn('slow');
        });
        $('.radiobutton').click(function (e) {
            var corr_div_id = $(this).data('corr-div-id');
            var set_class = $(this).data('set-class');
            $(set_class).slideUp('slow');
            if (!$(this).is(':checked')) {
                $(corr_div_id).slideUp('slow');
            } else {
                $(corr_div_id).slideDown('slow');
            }
        });
        $("#bill_type").jqxComboBox({width: '150', autoComplete: true, autoDropDownHeight: true});
        $("#sales_tax_authority").jqxComboBox({width: '400', autoComplete: true, autoDropDownHeight: true});
        $("#department_list").jqxComboBox({width: '280', autoComplete: true, autoDropDownHeight: true, checkboxes: true});
        $("#parent_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true});
        $("#child_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true});
        $('#bill_type').on('change', function () {
            if ($(this).jqxComboBox('getSelectedIndex') == "-1") {
                $("#error-bill_type").html('Bill Type is required');
            }
            else {
                $("#error-bill_type").html('');
            }
        });
        $('#parent_item').on('change', function () {
            if ($(this).jqxComboBox('getSelectedIndex') != "-1") {
                $.ajax({
                    url: "/admin/customers/get-children/" + $("#parent_item").val(),
                    context: document.body
                }).done(function (html) {
                    $('#child_item').jqxComboBox('destroy');
                    $('#child_select_box_div').html('');
                    $('#child_select_box_div').html(html);
                    if ($('#child_item').has('option').length > 0) {
                        $("#child_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true});
                    }
                    else {
                        $("#child_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true, disabled: true});
                    }

                });
            }
        });
        if ($('#parent_item').jqxComboBox('getSelectedIndex') != "-1") {
            $.ajax({
                url: "/admin/customers/get-children/" + $("#parent_item").val(),
                context: document.body
            }).done(function (html) {
                $('#child_item').jqxComboBox('destroy');
                $('#child_select_box_div').html('');
                $('#child_select_box_div').html(html);
                if ($('#child_item').has('option').length > 0) {
                    $("#child_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true});
                }
                else {
                    $("#child_item").jqxComboBox({width: '250', autoComplete: true, autoDropDownHeight: true, disabled: true});
                }
            });
        }
        $('#sales_tax_authority').on('change', function () {
            if ($(this).jqxComboBox('getSelectedIndex') == "-1") {
                $("#error-sales_tax_authority").html('Sales Tax is required');
            }
            else {
                $("#error-sales_tax_authority").html('');
            }
        });
        $('#same_as_shipping').click(function (e) {
            var corr_div_id = $(this).data('corr-div-id');
            $(corr_div_id).fadeOut('slow');
        });
        $('#use_department').click(function (e) {
            if (!$(this).is(':checked')) {
                $('#department_div').slideUp('slow');
            } else {
                $('#department_div').slideDown('slow');
            }
        });
        $('#price_by_weight').click(function (e) {
            $('.price-field, #price-heading').css('display', 'none');
            $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s2').addClass('s3');
            $('#div-price-by-weight').fadeIn('slow');
        });

        $('#price_by_item').click(function (e) {
            $('#div-price-by-weight').css('display', 'none');
            $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
            $('.price-field, #price-heading').fadeIn('slow');
        });

        $('#price_by_both').click(function (e) {
            $('#div-price-by-weight').fadeIn('slow');
            $('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
            $('.price-field, #price-heading').fadeIn('slow');
        });
    });
</script>