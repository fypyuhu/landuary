<fieldset >
                    <legend>Add Item:</legend>
                    <form method="POST" action="{{url('admin/items/create')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Name:</label>
                            <div class="input-field">
                                <input id="item_name" type="text" name="item_name">
                            </div>
                            <label for="item_name" class="error" id="error-item-name"></label>
                        </div>

                        <div class="row">
                            <input type="checkbox" name="show_parent_item_div" id="show_parent_item_div" data-corr-div-id="#parent-item-div" class="checkbox">
                            <label for="show_parent_item_div">This is a sub item.</label>
                        </div>

                        <div class="row" style="display: none;" id="parent-item-div">
                            <label>Please select the parent item of this product:</label>
                            <div class="input-field">
                                <select name="parent_item" id="parent_item">
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach  
                                </select>
                            </div>
                            <label for="parent_item" class="error" id="error-parent-item"></label>
                        </div>

                        <div class="row s12">
                            <label>Number:</label>
                            <div class="input-field">
                                <input id="item_number" type="number" name="item_number">
                            </div>
                            <label for="item_number" class="error" id="error-item-number"></label>
                        </div>

                        <div class="row">
                            <label>Description:</label>
                            <div class="input-field">
                                <input id="item_desc" type="text" name="item_desc">
                            </div>
                            <label for="item_desc" class="error" id="error-item-desc"></label>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Weight:</label>
                                <div class="input-field">
                                    <input id="item_weight" type="text" name="item_weight">
                                </div>
                                <label for="item_weight" class="error" id="error-item-weight"></label>
                            </div>
                            <div class="col m6 s12">
                                <label>Tracking Type:</label>
                                <div class="input-field">
                                    <select name="transaction_type" id="transaction_type">
                                        <option value="In">In</option>
                                        <option value="Out">Out</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                                <label for="transaction_type" class="error" id="error-transaction-type"></label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="waves-effect btn">Save</button>
                            <button class="waves-effect btn">Clear</button>
                        </div>
                    </form>
                </fieldset>
<script>
     $(document).ready(function () {
     	$("#transaction_type").jqxComboBox({width: '200', autoDropDownHeight: true});
        $("#parent_item").jqxComboBox({width: '400', autoDropDownHeight: true});
        $("#pageForm").validate({
            rules: {
                item_name: "required",
                item_number: {
                    required: true,
                    digits: true,
                },
                item_desc: "required",
                item_weight: "required",
                transaction_type: "required"
            },
            submitHandler: function (form) {
                var options = {
                    success: showResponse,
                    error:showError
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                function showError(response, statusText, xhr, $form) {
                   if(response.status==422){
                        $.each(response.responseJSON, function (key, value) {
                $("[name='" + key + "']").addClass('error');
                $("[name='" + key + "']").removeClass('valid');
                $("[name='" + key + "']").parent().siblings(".error").html(value);
                $("[name='" + key + "']").parent().siblings(".error").show();
            })
                   }
                }
                $(form).ajaxSubmit(options);
            }
        });
    });
</script>