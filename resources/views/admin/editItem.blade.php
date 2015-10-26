
<fieldset>
                    <legend>Edit Item:</legend>
                    <form method="POST" action="/admin/items/edit/{{$current->id}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Name:</label>
                            <div class="input-field">
                                <input id="item_name" type="text" value="{{$current->name}}"name="item_name">
                            </div>
                            <label for="item_name" class="error" id="error-item-name"></label>
                        </div>

                        <div class="row">
                            <input type="checkbox" @if($parent!=null) checked @endif name="show_parent_item_div" id="show_parent_item_div" data-corr-div-id="#edit-parent-item-div" class="checkbox">
                            <label for="show_parent_item_div">This is a sub item.</label>
                        </div>

                        <div class="row" @if($parent==null) style='display: none;' @endif id="edit-parent-item-div">
                            <label>Please select the parent item of this product:</label>
                            <div class="input-field">
                                <select name="parent_item" id="edit_parent_item">
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}" @if($parent!=null && $parent->parent_id==$item->id) selected="selected" @endif >{{$item->name}}</option>
                                    @endforeach  
                                </select>
                            </div>
                            <label for="parent_item" class="error" id="error-parent-item"></label>
                        </div>

                        <div class="row s12">
                            <label>Number:</label>
                            <div class="input-field">
                                <input id="item_number" value="{{$current->item_number}}" type="text" name="item_number">
                            </div>
                            <label for="item_number" class="error" id="error-item-number"></label>
                        </div>

                        <div class="row">
                            <label>Description:</label>
                            <div class="input-field">
                                <input id="item_desc" value="{{$current->description}}"type="text" name="item_desc">
                            </div>
                            <label for="item_desc" class="error" id="error-item-desc"></label>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Weight:</label>
                                <div class="input-field">
                                    <input value="{{$current->weight}}" id="item_weight" type="text" name="item_weight">
                                </div>
                                <label for="item_weight" class="error" id="error-item-weight"></label>
                            </div>
                            <div class="col m6 s12">
                                <label>Transaction Type:</label>
                                <div class="input-field">
                                    <select name="transaction_type" id="edit_transaction_type">
                                        <option value="In" @if($current->transaction_type=="In") selected="selected" @endif>In</option>
                                        <option value="Out" @if($current->transaction_type=="Out") selected="selected" @endif>Out</option>
                                        <option value="Both" @if($current->transaction_type=="Both") selected="selected" @endif>Both</option>
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

<script type="text/javascript">
    $(document).ready(function () {

        $("#edit_transaction_type").jqxComboBox({width: '180', autoDropDownHeight: true});
        $("#edit_parent_item").jqxComboBox({width: '340', autoDropDownHeight: true});
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
                    success: showResponse
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                $(form).ajaxSubmit(options);
            }
        });
    });
</script>    