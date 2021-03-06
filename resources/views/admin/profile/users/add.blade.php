<div class="field-set">
    <fieldset>
        <legend>Add User:</legend>
        <div class="row alert alert-success" style="display:none;"></div>
        <form method="POST" action="{{url('admin/users/create')}}" id="pageForm">
            {{csrf_field()}}
            <div class="row m12">
                <label>User Type:</label>
                <div class="input-field">
                    <select id="user_type" name="user_type" class="dropdown">
                        <option value="">Please Select</option>
                        <option value="3">Washroom Manager</option>
                        <option value="4">Finishing Manager</option>
                    </select>
                </div>
                <label for="user_type" class="error"></label>
            </div>

            <div class="row m12">
                <label>First Name:</label>
                <div class="input-field">
                    <input id="first_name" type="text" name="first_name">
                </div>
                <label for="first_name" class="error"></label>
            </div>
            <div class="row m12">
                <label>Last Name:</label>
                <div class="input-field">
                    <input id="last_name" type="text" name="last_name">
                </div>
                <label for="last_name" class="error"></label>
            </div>
            <div class="row m12">
                <label>Email:</label>
                <div class="input-field">
                    <input id="email" type="text" name="email">
                </div>
                <label for="email" class="error"></label>
            </div>
            <div class="row m12">
                <label>Password:</label>
                <div class="input-field">
                    <input id="password" type="password" name="password">
                </div>
                <label for="password" class="error"></label>
            </div>
            <div class="row">
                <button type="submit" class="waves-effect btn">Save</button>
                <button class="waves-effect btn">Clear</button>
            </div>
        </form>
    </fieldset>
    <script>
        $(document).ready(function () {
            $(".dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
            $("#pageForm").validate({
                rules: {
                    user_type: "required",
                    first_name: "required",
                    last_name: "required",
                    password: "required",
                    email: {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function (form) {
                    $('.loading').show();
                    var options = {
                        success: showResponse,
                        error: showError
                    };
                    function showResponse(responseText, statusText, xhr, $form) {
                        //location.reload();
                        $('.field-set').load('/admin/users/create', function () {
                            $('.loading').hide();
                            $('.alert-success').html('User has been saved successfully. Please add next user or close window.').show();
                        });
                        //resetting form
                        /*$('#pageForm').find('input').val('');
                         $('#pageForm').find('input[type="checkbox"]').prop('checked', false);
                         $('#parent-item-div').hide();
                         $("#transaction_type").jqxComboBox({autoComplete: true, width: '200', autoDropDownHeight: false});
                         $("#parent_item").jqxComboBox({autoComplete: true, width: '400', autoDropDownHeight: false});*/
                    }
                    function showError(response, statusText, xhr, $form) {
                        if (response.status == 422) {
                            $.each(response.responseJSON, function (key, value) {
                                $("[name='" + key + "']").addClass('error');
                                $("[name='" + key + "']").removeClass('valid');
                                $("[name='" + key + "']").parent().siblings(".error").html(value);
                                $("[name='" + key + "']").parent().siblings(".error").show();
                            })
                        }
                        $('.loading').hide();
                    }
                    $(form).ajaxSubmit(options);
                }
            });
        });
    </script>
</div>