<div class="field-set">
<fieldset>
                    <legend>Add User:</legend>
                    <div class="row alert alert-success" style="display:none;"></div>
                    <form method="POST" action="{{url('admin/profile/user-create')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>User Type:</label>
                            <div class="input-field">
                                <select id="user_type" name="user_type" class="dropdown">
                                	<option value="">Please Select</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Manager">Manager</option>
                                    <option value="User A">User A</option>
                                </select>
                            </div>
                            <label for="user_type" class="error"></label>
                        </div>
                        
                        <div class="row s12">
                            <label>User ID:</label>
                            <div class="input-field">
                                <input id="user_id" type="text" name="user_id">
                            </div>
                            <label for="user_id" class="error"></label>
                        </div>

                        <div class="row s12">
                            <label>User Password:</label>
                            <div class="input-field">
                                <input id="user_password" type="text" name="user_password">
                            </div>
                            <label for="user_password" class="error"></label>
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
	 	$('fieldset').click(function(){
			$('.alert-success').hide();
		});
        $("#pageForm").validate({
            rules: {
                user_id: {
                    required: true,
                    digits: true,
                },
                user_password: "required"
            },
            submitHandler: function (form) {
				$('.loading').show();
                var options = {
                    success: showResponse,
                    error:showError
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    //location.reload();
					$('.field-set').load('/admin/profile/add-form',function(){
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
                   if(response.status==422){
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