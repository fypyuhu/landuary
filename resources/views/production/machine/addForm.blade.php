<div class="field-set">
<fieldset>
                    <legend>Add Machine:</legend>
                    <div class="row alert alert-success" style="display:none;"></div>
                    <form method="POST" action="{{url('production/machine/create')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Machine Name:</label>
                            <div class="input-field">
                                <input id="machine_name" type="text" name="machine_name">
                            </div>
                            <label for="machine_name" class="error"></label>
                        </div>

                        <div class="row s12">
                            <label>Machine Number:</label>
                            <div class="input-field">
                                <input id="machine_number" type="number" name="machine_number">
                            </div>
                            <label for="machine_number" class="error"></label>
                        </div>

                        <div class="row">
                            <label>Machine Description:</label>
                            <div class="input-field">
                                <input id="machine_description" type="text" name="machine_description">
                            </div>
                            <label for="machine_description" class="error"></label>
                        </div>
                        <div class="row">
                            <label>Machine Capacity:</label>
                            <div class="input-field">
                                <input id="machine_capacity" type="text" name="machine_capacity">
                            </div>
                            <label for="machine_capacity" class="error"></label>
                        </div>
                        <div class="row">
                            <label>Machine Image:</label>
                            <input type="file" id="machine_image" name="machine_image" /><br />
                            <label for="machine_image" class="error"></label>
                        </div>
                        <div class="row">
                            <button type="submit" class="waves-effect btn">Save</button>
                            <button class="waves-effect btn">Clear</button>
                        </div>
                    </form>
                </fieldset>
<script>
     $(document).ready(function () {
	 	$('fieldset').click(function(){
			$('.alert-success').hide();
		});
        $("#pageForm").validate({
            rules: {
                machine_name: "required",
                machine_number: {
                    required: true,
                    digits: true,
                },
                machine_description: "required",
                machine_capacity: "required",
                machine_image: "required"
            },
            submitHandler: function (form) {
				$('.loading').show();
                var options = {
                    success: showResponse,
                    error:showError
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    //location.reload();
					$('.field-set').load('/admin/machine/add-form',function(){
						$('.loading').hide();
						$('.alert-success').html('Machine has been saved successfully. Please add next machine or close window.').show();
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