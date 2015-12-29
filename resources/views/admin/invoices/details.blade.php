<form action="/admin/invoices/create" Method="POST" id="pageForm">
    {{csrf_field()}}
    <div class="col s12 m5">
        <fieldset>
            <legend>Create Invoice:</legend>
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
                    <select name="department[]" id="department" multiple>
                        <option value="-1" selected>All Departments</option>
                        @foreach($departments as $department)
                        <option  value="{{$department->id}}" @if(in_array($department->id,$department_ids)) selected @endif >{{$department->department_name}}</option>
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
                    <label>Invoice Date:</label>
                    <div id="ship_date" type="text" name="ship_date"></div>

                </div>
            </div>

            <div class="row" style="display:none;">
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
            <legend>Select Manifest(s):</legend>
            <div class="row box">
                <div class="row layout_table no-topmargin">
                    <div class="row heading">
                        <div class="col s1 center-align chkbx">
                            <input type="checkbox" name="all_carts" id="all_carts">
                            <label for="all_carts"></label>
                        </div>
                        <div class="col s2">Manifest Number</div>
                        <div class="col s2">Number of Carts</div>
                        <div class="col s2">Department</div>
                        <div class="col s2 center-align">Shipment Date</div>
                        <div class="col s2 center-align">Actions</div>
                    </div>
                    @if($ship_manifests)
                    @foreach($ship_manifests as $ship_manifest)
                    <?php $temp = explode(",", $ship_manifest->outgoing_cart_id); ?>
                    <div class="row records_list">
                        <div class="col s1 center-align chkbx">
                            <input type="checkbox" class="all_cart_checkbox" name="manifests[{{$ship_manifest->id}}]" value="{{$ship_manifest->id}}" id="manifests[{{$ship_manifest->id}}]">
                            <label for="manifests[{{$ship_manifest->id}}]"></label>
                        </div>
                        <div class="col s2">{{$ship_manifest->id}}</div>
                        <div class="col s2">{{count($temp)}}</div>
                        <div class="col s2">{{$ship_manifest->department_name or ' '}}</div>
                        <div class="col s2 right-align">{{date('d-m-Y',strtotime($ship_manifest->shipping_date))}}</div>
                        <div class="col s2 center-align"><a href="/admin/shiping-manifest/recipt/{{$ship_manifest->id}}"   class="edit-button">View</a> | <a href="/admin/shiping-manifest/edit/{{$ship_manifest->id}}"  class="edit-button">Edit</a></div>
                    </div>
                    @endforeach
                    @else
                    <div class="row records_list">
                        <div class="col s12 center-align"><strong>No Manifest.</strong></div>
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
                $(".all_cart_checkbox").prop("checked", true);
            }
            else {
                $(".all_cart_checkbox").prop("checked", false);
            }
            $("#error-select_cart").html("");
            $("#error-select_cart").hide();
        });
        $('.all_cart_checkbox').change(function () {
            $("#error-select_cart").html("");
            $("#error-select_cart").hide();
        });
        $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true, checkboxes: true});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
        $("#ship_date").jqxDateTimeInput({value: new Date(), width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy', disabled: true});
        $('#customer').on('change', function () {
            if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val() != "-1") {
                $(".loading").css("display", "block");
                $.ajax({
                    url: "/admin/invoices/details/" + $(this).val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display", "none");
                });
            }
        });
        $("#department").on('checkChange', function (event) {
            if (event.args) {
                var item = event.args.item;
                if (item) {
                    var items = $("#department").jqxComboBox('getCheckedItems');
                    var checkedItems = "";
                    $.each(items, function (index) {
                        checkedItems += this.value + ",";
                    });
                    if (checkedItems!== "") {
                        checkedItems=checkedItems.substring(0, checkedItems.length-1);
                    }    $('#department').jqxComboBox('destroy'); 
                        $(".loading").css("display", "block");
                        $.ajax({
                            url: "/admin/invoices/details/" + $("#customer").val() + "/" +checkedItems,
                            context: document.body
                        }).done(function (html) {
                            $("#shipmant").html(html);
                            $(".loading").css("display", "none");
                        });
                    
                }
            }
        });
        $("#pageForm").validate({
            ignore: [],
            rules: {
                customer: "required"
            },
            submitHandler: function (form) {
                if ($(".all_cart_checkbox").length < 1 || $('.all_cart_checkbox:checked').length < 1) {
                    $("#error-select_cart").html("Please select at least one Manifest");
                    $("#error-select_cart").show();
                }
                else {
                    $(form).validate().cancelSubmit = true;
                    $(form).submit();
                }
            }
        });
    });
</script>