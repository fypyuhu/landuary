<form action="/admin/shiping-manifest/create" Method="POST">
    <div class="col s12 m5">
        <fieldset>
            <legend>Shipping Manifest:</legend>
            <div class="row">
                <div class="col m6 s12">
                    <label>Customer Number:</label>
                    <select name="customer" id="customer">
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}" @if($customer->id==$active_customer->id) selected="selected" @endif >{{$customer->customer_number}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col m6 s12">
                    <label>Department:</label>
                    <select name="department" id="department">
                        <option value="-1" selected>Select Department</option>
                        @if($departments)
                        @foreach($departments as $department)
                        <option value="{{$department->id}}" >{{$departments->department_name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col m6 s12">
                    <label>Ship to Name:</label>
                    <div class="input-field">
                        <input id="name" type="text" name="name" disabled="disabled" value="{{$active_customer->name}}">
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
                        <textarea id="name" name="name"></textarea>
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
                        <div class="col s2">No. of Items</div>
                        <div class="col s2 center-align">Date Created</div>
                        <div class="col s3 right-align">Net Weight lb/kg</div>
                        <div class="col s2 center-align">Actions</div>
                    </div>
                    <div class="row records_list">
                        <div class="col s1 center-align chkbx">
                            <input type="checkbox" name="all_carts" id="all_carts">
                            <label for="all_carts"></label>
                        </div>
                        <div class="col s2">01</div>
                        <div class="col s2">02</div>
                        <div class="col s2 center-align">12-12-2012</div>
                        <div class="col s3 right-align">4 KG</div>
                        <div class="col s2 center-align"><a href="?action=edit" class="edit-button">View/Edit</a><a href="#add-record" class="edit-button hidden">View/Edit</a></div>
                    </div>
                    
                </div>
            </div>
        </fieldset>
    </div>
</form>
<script>
    $(function () {
        $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
        $("#ship_date").jqxDateTimeInput({ min: new Date(),width: 'auto', height: '25px' });
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
    });
</script>