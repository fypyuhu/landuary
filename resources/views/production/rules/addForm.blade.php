<div class="field-set">
<fieldset>
                    <legend>Add Rule:</legend>
                    <div class="row alert alert-success" style="display:none;"></div>
                    <form method="POST" action="{{url('production/rules/create')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Rule Name:</label>
                            <div class="input-field">
                                <input id="rule_name" type="text" name="rule_name">
                            </div>
                            <label for="rule_name" class="error"></label>
                        </div>

                        <div class="row s12">
                            <label>Rule Number:</label>
                            <div class="input-field">
                                <input id="rule_number" type="number" name="rule_number">
                            </div>
                            <label for="rule_number" class="error"></label>
                        </div>

                        <div class="row">
                            <label>Rule Description:</label>
                            <div class="input-field">
                                <input id="rule_description" type="text" name="rule_description">
                            </div>
                            <label for="rule_description" class="error"></label>
                        </div>
                        
                        <div class="row">
                            <label>Running Time in Minutes:</label>
                            <div class="input-field">
                                <input id="rule_time" type="text" name="rule_time">
                            </div>
                            <label for="rule_time" class="error"></label>
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
                rule_name: "required",
                rule_number: {
                    required: true,
                    digits: true,
                },
                rule_description: "required",
                rule_time: {
                    required: true,
                    digits: true,
                },
            },
            submitHandler: function (form) {
				$('.loading').show();
                var options = {
                    success: showResponse,
                    error:showError
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    //location.reload();
					$('.field-set').load('/admin/rules/add-form',function(){
						$('.loading').hide();
						$('.alert-success').html('Rule has been saved successfully. Please add next rule or close window.').show();
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