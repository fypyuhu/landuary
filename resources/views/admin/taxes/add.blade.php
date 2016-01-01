<div class="field-set">
<fieldset >
    <legend>Sales Tax Rates and Agencies:</legend>
      <div class="row alert alert-success" style="display:none;"></div>
      <div class="row">
         <div class="col s12">
            <input type="radio" name="tax_type_rd" value="single" id="tax_rate_single" data-set-class=".taxes" data-corr-div-id="#tax-rate-single-div" class="radiobutton" /><label for="tax_rate_single">Single tax rate</label>
         </div>
         <div class="col s12">
            <input type="radio" name="tax_type_rd" value="combined" id="tax_rate_combined" data-set-class=".taxes" data-corr-div-id="#tax-rate-combined-div" class="radiobutton" /><label for="tax_rate_combined" style="margin-right:0;">Combined tax rate(when you file sales tax, you're required to report parts of this tax separately)</label>
         </div>
         <div class="col s12">
            <label for="tax_rate" class="error hidden">Please select tax type</label>
         </div>
      </div>
      <div class="row taxes" id="tax-rate-single-div">
         <form method="POST" action="{{url('admin/taxes/create')}}" id="pageFormSingle">
         {{csrf_field()}}
          <input type="hidden" name="tax_type" value="single" />
         <div class="row">
            <div class="col m4 s12">
                <label>Tax name (your sales forms display this name)</label>
                <div class="input-field">
                    <input type="text" name="tax_name" id="tax_name" />
                </div>
                <label for="tax_name" class="error">Example: New York City or Santa Clara County</label>
            </div>
            <div class="col m4 s12">
                <label>Agency Name</label>
                <div class="input-field">
                    <input type="text" name="agency_name" id="agency_name" />
                </div>
                <label for="agency_name" class="error">Example: Arizona Dept. of Revenue</label>
            </div>
            <div class="col m4 s12">
                <label>Rate</label>
                <div class="input-field">
                    <input type="text" name="tax_rate" id="tax_rate" />
                </div>
                <label for="tax_rate" class="error">%</label>
            </div>
         </div>
         
         <div class="row">
            <button type="submit" class="waves-effect btn">Save</button>
            <button type="reset" class="waves-effect btn">Clear</button>
         </div>
         </form>
      </div>
      
      <div class="row taxes" id="tax-rate-combined-div">
         <form method="POST" action="{{url('admin/taxes/create')}}" id="pageFormCombined">
         {{csrf_field()}}
         <input type="hidden" name="tax_type" value="combined" />
         <input type="hidden" name="agency_name" value="" />
         <input type="hidden" name="tax_rate" value="" />
         <div class="row" style="margin-bottom:15px;">
            <div class="col m4 s12">
                <label>Tax name (your sales forms display this name)</label>
                <div class="input-field">
                    <input type="text" name="tax_name" id="tax_name" />
                </div>
                <label for="tax_name" class="error">Example: New York City or Santa Clara County</label>
            </div>
         </div>
         <fieldset>
         	 <legend>Component</legend>
             <div class="row tax-page layout_table">
                 <div class="row records_list">
                    <div class="col m4 s12">
                        <label>Component Name</label>
                        <div class="input-field">
                            <input type="text" name="component_name[]" class="component_name" id="component_name_1" />
                        </div>
                        <label for="component_name_1" class="error">Example: New York City or Santa Clara County</label>
                    </div>
                    <div class="col m4 s12">
                        <label>Agency Name</label>
                        <div class="input-field">
                            <input type="text" name="component_agency_name[]" class="component_agency_name" id="component_agency_name_1" />
                        </div>
                        <label for="component_agency_name_1" class="error">Example: Arizona Dept. of Revenue</label>
                    </div>
                    <div class="col m3 s12">
                        <label>Rate</label>
                        <div class="input-field">
                            <input type="text" name="component_tax_rate[]" class="component_agency_name" id="component_tax_1" />
                        </div>
                        <label for="component_tax_1" class="error">%</label>
                    </div>
                    <div class="col m1 s12" style="padding-top:26px;">
                        <a href="javascript:void(0);" onclick="$(this).parent().parent().remove();" class="waves-effect btn">X</a>
                    </div>
                 </div>
             </div>
             <div class="row">
                <button class="waves-effect btn create-clone-button-taxes" data-corr-div-id="#clone-container">Add Another Component</button>
             </div>
         </fieldset>
         <div class="row">
            <button type="submit" class="waves-effect btn">Save</button>
            <button type="reset" class="waves-effect btn">Clear</button>
         </div>
         </form>
      </div>
</fieldset>
<script>
     $(document).ready(function () {
        $('#pageFormSingle').validate({
			rules: {
				tax_name: "required",
				agency_name: "required",
				tax_rate: {
					required: true,
					digits: true
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
					$('.field-set').load('/admin/taxes/ajax-add-form',function(){
						$('.loading').hide();
						$('.alert-success').html('Tax has been saved successfully. Please add another tax or close window.').show();
					});
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
		
		$("#pageFormCombined").validate({
            rules: {
                tax_name: "required",
                "component_name[]": "required",
                "component_agency_name[]": "required",
                "component_tax_rate[]": {
					required: true,
					digits: true
				}
            },
            submitHandler: function (form) {
				$('.loading').show();
                var options = {
                    success: showResponse,
					error:showError
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    //location.reload();
					$('.field-set').load('/admin/taxes/ajax-add-form',function(){
						$('.loading').hide();
						$('.alert-success').html('Tax has been saved successfully. Please add another tax or close window.').show();
					});
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
		/*$("#component_name_1").rules("add", {
			required:true
		});
		$("#component_agency_name_1").rules("add", {
			required:true
		});
		$("#component_tax_rate_1").rules("add", {
			required: true,
			digits: true
		});*/
    });
</script>
</div>