@extends('masterProfile')
@section('content') 
<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            @include('admin.profile.leftnav')
            
            <div class="oMain">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name="compnay_profile" id="compnay_profile" method="post" action="/admin/profile/edit-profile/{{$user->id}}" enctype="multipart/form-data">
                {{csrf_field()}}
            	<fieldset style="margin-top:20px;" class="tab-content first" id="sec-company-profile">
                    <legend>Company Profile:</legend>
                    <div class="row">
                        <label>Company Legal Name:</label>
                        <div class="input-field">
                            <input id="legal_name" type="text" name="legal_name" value="{{$user->legal_name}}">
                        </div>
                        <label for="legal_name" class="error"></label>
                    </div>
                    <hr />
                    <h4>Address</h4>
                    <div class="row">
                        <label>Street Address:</label>
                        <div class="input-field">
                            <input id="street_address" type="text" name="street_address" value="{{$user->street_address}}">
                        </div>
                        <label for="street_address" class="error"></label>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>City:</label>
                            <div class="input-field">
                                <input id="city" type="text" name="city" value="{{$user->city}}">
                            </div>
                            <label for="city" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>State:</label>
                            <div class="input-field">
                                <input id="state" type="text" name="state" value="{{$user->state}}">
                            </div>
                            <label for="state" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Zip Code:</label>
                            <div class="input-field">
                                <input id="zipcode" type="text" name="zipcode" value="{{$user->zipcode}}">
                            </div>
                            <label for="zipcode" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Country:</label>
                            <select name="country" id="country">
                                <option value="">Please Select</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->country_name }}" {{$country->country_name == $user->country ? 'selected="selected"' : ''}}>{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            <label for="country" class="error"></label>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Phone:</label>
                            <div class="input-field">
                                <input id="phone" type="text" name="phone" value="{{$user->phone}}">
                            </div>
                            <label for="phone" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Fax:</label>
                            <div class="input-field">
                                <input id="fax" type="text" name="fax" value="{{$user->fax}}">
                            </div>
                            <label for="fax" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Email:</label>
                            <div class="input-field">
                                <input id="email" type="text" name="email" value="{{$user->email}}">
                            </div>
                            <label for="email" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Website:</label>
                            <div class="input-field">
                                <input id="website" type="text" name="website" value="{{$user->website}}">
                            </div>
                            <label for="website" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Tax ID Number:</label>
                            <div class="input-field">
                                <input id="tax_id_number" type="text" name="tax_id_number" value="{{$user->tax_id_number}}">
                            </div>
                            <label for="tax_id_number" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Logo:</label>
                            <input id="logo" type="file" name="logo" style="width: 100%;">
                            <label for="logo" class="error"></label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col pull-right">
                          <a href="javascript:void(0);" class="waves-effect btn btnNext" data-corr-link-id="#link-contact-person">Next</a>
                          <button type="reset" class="waves-effect btn">Clear</button>
                        </div>
                    </div>
                </fieldset>
                <fieldset style="margin-top:20px;" class="tab-content" id="sec-contact-person">
                    <legend>Contact Person</legend>
                    <div class="row">
                        <label>Name:</label>
                        <div class="input-field">
                            <input id="contact_name" type="text" name="contact_name" value="{{$user->contact_name}}">
                        </div>
                        <label for="contact_name" class="error"></label>
                    </div>
                    <div class="row">
                        <label>Designation:</label>
                        <div class="input-field">
                            <input id="contact_designation" type="text" name="contact_designation" value="{{$user->contact_designation}}">
                        </div>
                        <label for="contact_designation" class="error"></label>
                    </div>
                    <div class="row">
                        <label>Email Address:</label>
                        <div class="input-field">
                            <input id="contact_email" type="text" name="contact_email" value="{{$user->contact_email}}">
                        </div>
                        <label for="contact_email" class="error"></label>
                    </div>
                    
                    <div class="row">
                    	<div class="pull-left">
                        	<a href="javascript:void(0);" class="waves-effect btn btnPrev" data-corr-link-id="#link-company-profile">Previous</a>
                        </div>
                        <div class="col pull-right">
                          <a href="javascript:void(0);" class="waves-effect btn btnNext" data-corr-link-id="#link-business-model">Next</a>
                          <button type="reset" class="waves-effect btn">Clear</button>
                        </div>
                    </div>
                </fieldset>
                <fieldset style="margin-top:20px;" class="tab-content" id="sec-business-model">
                    <legend>Business model</legend>
                    <div class="row">
                        <div class="col m6 s12">
                            <strong>Industries We Serve:</strong><br />
                            <input type="checkbox" name="we_serve[]" id="hospitality" value="Hospitality (Hotel &amp; Restaurant)"> <label for="hospitality">Hospitality (Hotel &amp; Restaurant)</label><br />
                            <input type="checkbox" name="we_serve[]" id="healthcare" value="Healthcare"> <label for="healthcare">Healthcare</label><br />
                            <input type="checkbox" name="we_serve[]" id="vacational_rentals" value="Vacational Rentals"> <label for="vacational_rentals">Vacational Rentals</label><br />
                            <label for="we_serve" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <strong>We Do:</strong><br />
                            <input type="checkbox" name="we_do[]" id="customer_own_goods" value="Customer Own Goods"> <label for="customer_own_goods">Customer Own Goods</label><br />
                            <input type="checkbox" name="we_do[]" id="linen_rentals" value="Linen Rentals"> <label for="linen_rentals">Linen Rentals</label><br />
                            <label for="we_do" class="error"></label>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<div class="pull-left">
                        	<a href="javascript:void(0);" class="waves-effect btn btnPrev" data-corr-link-id="#link-contact-person">Previous</a>
                        </div>
                        <div class="col pull-right">
                          <button type="submit" class="waves-effect btn">Save</button>
                          <button type="reset" class="waves-effect btn">Clear</button>
                        </div>
                    </div>
                </fieldset>
            </fieldset>
            </form>
            </div>
        </div>
    </section>
<!-- End Main Content -->
@endsection

@section('js')
	<script>
    $(document).ready(function () {
		$('.ctabsleft a.ltab').click(function(e){
			e.preventDefault();
		});
		
		$('.btnNext').click(function(e) {
			var form = $("#compnay_profile");
			form.validate({
				rules: {
					legal_name: "required",
					street_address: "required",
					city: "required",
					state: "required",
					zipcode: "required",
					country: "required",
					phone: "required",
					email: {
						required: true,
						email: true
					},
					tax_id_number: "required",
					logo: {
						extension: "jpg|jpeg|png"
					},
					contact_name: "required",
					contact_designation: "required",
					contact_email: {
						required: true,
						email: true
					},
					we_serve: "required",
					we_do: "required"
				}
			});
			
			if (form.valid() == true) {
				$('.tab-content').css('display', 'none');
				$(this).parents('.tab-content').next().fadeIn('slow');
				
				var corrLink = $(this).data('corr-link-id');
				$('.ltab').removeClass('isCurrent');
				$(corrLink).addClass('isCurrent');
			}
		});
		
		$('.btnPrev').click(function(e) {
			e.preventDefault();
			$('.tab-content').css('display', 'none');
			$(this).parents('.tab-content').prev().fadeIn('slow');
			
			var corrLink = $(this).data('corr-link-id');
			$('.ltab').removeClass('isCurrent');
			$(corrLink).addClass('isCurrent');
		});
		
		$("#country").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
	});
	</script>
@endsection