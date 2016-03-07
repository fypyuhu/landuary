<div class="field-set">
    <fieldset>
        <legend>Edit User:</legend>
        <div class="row alert alert-success" style="display:none;"></div>
        <form method="POST" action="{{url('admin/users/edit')}}" id="pageForm">
            {{csrf_field()}}
            <div class="row m12">
                <label>First Name:</label>
                <div class="input-field">
                    <input id="first_name" value="{{$user->first_name}}" type="text" name="first_name">
                </div>
                <label for="first_name" class="error"></label>
            </div>
            <div class="row m12">
                <label>Last Name:</label>
                <div class="input-field">
                    <input id="last_name" value="{{$user->last_name}}" type="text" name="last_name">
                </div>
                <label for="last_name" class="error"></label>
            </div>
            <div class="row m12">
                <label>Email:</label>
                <div class="input-field">
                    <input id="email" type="text" value="{{$user->email}}" name="email">
                </div>
                <label for="email" class="error"></label>
            </div>
            <div class="row m12">
                <label>Password:<span>Leave blank if you don't want to change the password</span></label>
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
            $("#pageForm").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
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