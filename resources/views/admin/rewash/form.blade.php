<form method="post" action="/admin/rewash/create" id="pageForm">
	{{csrf_field()}}
    <div class="row no-rightmargin">
        <div class="col s12 m5 margin-right-md">
            <fieldset>
                <legend>Customer Information:</legend>
                <div class="row">
                    <div class="col m6 s12">
                        <label>Customer</label>
                        <select name="customer" id="customer">
                            @foreach ($customers as $customer)
                            <option value="{{$customer->id}}" {{$customer->id == $current_customer->id ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
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
                            <input id="name" type="text" name="name" value="{{$current_customer->customer_number}}" readonly="readonly">
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
            <fieldset>
                <legend>Items List:</legend>
                <div class="row box">
                    <div class="row no-topmargin">
                        <div class="col m8 s12">
                            <label>Item Number</label>
                            <select name="item_id" id="item_id">
                                @foreach ($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
                        <button class="waves-effect btn" id="button-add-item" type="button">Add</button>

                    </div>
                    <div class="row layout_table">
                        <div class="row heading">
                            <div class="col s3">Item Number</div>
                            <div class="col s3">Item Description</div>
                            <div class="col s2 right-align">Quantity</div>
                            <div class="col s2 right-align">Weight kg/lb</div>
                            <div class="col s2 right-align">Action</div>
                        </div>
                        <div class="row records_list no-item">
                            <h5 class="center-align">No Items have been added to this cart yet.</h5>
                        </div>
                        <div>
                            <input type="hidden" name="item_count" id="item_count" value="0">
                        </div>
                        <label for="item_count" class="error" id="error-item_count"></label>
                        <div id="add-item-list"></div>  
                        <div id="add-item-list"></div>
                        <!--<div class="row records_list">
                            <div class="col s3">Item 1</div>
                            <div class="col s5">Lorem Ipsum doller sit</div>
                            <div class="col s2 right-align">4</div>
                            <div class="col s2 right-align">4 KG</div>
                        </div>-->
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
</form>

<script>
    $(document).ready(function () {
    	$("#customer").jqxComboBox({width: '100%', autoDropDownHeight: true});
        $("#department").jqxComboBox({ width: '100%', autoDropDownHeight: true, {{count($depts) > 0 ? 'disabled: false' : 'disabled: true'}} });
        $("#item_id").jqxComboBox({ width: '100%', autoDropDownHeight: true, {{count($items) > 0 ? 'disabled: false' : 'disabled: true'}} });
		$(".datepicker").jqxDateTimeInput({ width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
		
        $("#pageForm").validate({
    		rules: {
    			customer_name: "required"
    		},
            submitHandler: function (form) {
				$('.loading').show();
                if (parseFloat($("#item_count").val()) < 1){
                	$("#item_count").parent().siblings(".error").html("Please add atleast one item");
                    $("#item_count").parent().siblings(".error").show();
                } else {
                    $(form).validate().cancelSubmit = true;
                    $(form).submit();
                }
            }
    	});
    });
</script>