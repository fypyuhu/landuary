<fieldset>
    <legend>Sales Tax Rates and Agencies:</legend>
    <div class="row">
        @if($tax-> tax_type == "single")
        <div class="col s12">
            <input type="radio"  name="tax_type_rd" value="single" id="tax_rate_single" data-set-class=".taxes" data-corr-div-id="#tax-rate-single-div" class="radiobutton" /><label for="tax_rate_single">Single tax rate</label>
        </div>
        @else
        <div class="col s12">
            <input type="radio"  name="tax_type_rd" value="combined" id="tax_rate_combined" data-set-class=".taxes" data-corr-div-id="#tax-rate-combined-div" class="radiobutton" /><label for="tax_rate_combined" style="margin-right:0;">Combined tax rate(when you file sales tax, you're required to report parts of this tax separately)</label>
        </div>
        @endif
        
    </div>
    <div class="row taxes" id="tax-rate-single-div">
        <form method="POST" action="{{url('admin/taxes/edit/'.$tax->id)}}" id="pageFormSingle">
            {{csrf_field()}}
            <input type="hidden" name="tax_type" value="single" />
            <div class="row">
                <div class="col m4 s12">
                    <label>Tax name (your sales forms display this name)</label>
                    <div class="input-field">
                        <input type="text" value="{{$tax->tax_name}}" name="tax_name" id="tax_name" />
                    </div>
                    <label for="tax_name" class="error">Example: New York City or Santa Clara County</label>
                </div>
                <div class="col m4 s12">
                    <label>Agency Name</label>
                    <div class="input-field">
                        <input type="text" value="{{$tax->agency_name}}" name="agency_name" id="agency_name" value="test" />
                    </div>
                    <label for="agency_name" class="error">Example: Arizona Dept. of Revenue</label>
                </div>
                <div class="col m4 s12">
                    <label>Rate</label>
                    <div class="input-field">
                        <input type="text" value="{{$tax->tax_rate}}" name="tax_rate" id="tax_rate" />
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
        <form method="POST" action="{{url('admin/taxes/edit/'.$tax->id)}}" id="pageFormCombined">
            {{csrf_field()}}
            <input type="hidden" name="tax_type" value="combined" />
            <input type="hidden" name="agency_name" value="" />
            <input type="hidden" name="tax_rate" value="" />
            <div class="row" style="margin-bottom:15px;">
                <div class="col m4 s12">
                    <label>Tax name (your sales forms display this name)</label>
                    <div class="input-field">
                        <input type="text" name="tax_name" value="{{$tax->tax_name}}" id="tax_name" />
                    </div>
                    <label for="tax_name" class="error">Example: New York City or Santa Clara County</label>
                </div>
            </div>
            <fieldset>
                <legend>Component</legend>
                <div class="row tax-page layout_table">
                    @foreach($tax->components as $component)
                    <div class="row records_list">
                        <div class="col m4 s12">
                            <label>Component Name</label>
                            <div class="input-field">
                                <input type="text" value="{{$component->component_name}}" name="component_name[{{$component->id}}]" id="component_name_1" />
                            </div>
                            <label for="component_name_1" class="error">Example: New York City or Santa Clara County</label>
                        </div>
                        <div class="col m4 s12">
                            <label>Agency Name</label>
                            <div class="input-field">
                                <input type="text" value="{{$component->agency_name}}" name="component_agency_name[{{$component->id}}]" id="component_agency_name_1" />
                            </div>
                            <label for="component_agency_name_1" class="error">Example: Arizona Dept. of Revenue</label>
                        </div>
                        <div class="col m3 s12">
                            <label>Rate</label>
                            <div class="input-field">
                                <input type="text" value="{{$component->tax_rate}}" name="component_tax_rate[{{$component->id}}]" id="component_tax_rate_1" />
                            </div>
                            <label for="component_tax_rate_1" class="error">%</label>
                        </div>
                        <div class="col m1 s12" style="padding-top:26px;">
                            <a href="javascript:void(0);" onclick="$(this).parent().parent().remove();" class="waves-effect btn">X</a>
                        </div>
                    </div>
                    @endforeach
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
    @if ($tax-> tax_type == "single")
        $("#tax_rate_single").click();
        $("#tax-rate-single-div").show();
    @else
        $("#tax_rate_combined").click();
        $("#tax-rate-combined-div").show();
    @endif
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
                    success: showResponse
                    };
                    function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
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
                    error: showError
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