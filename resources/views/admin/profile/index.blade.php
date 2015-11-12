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
            <form name="compnay_profile" id="compnay_profile" method="post" action="{{url('admin/profile/create')}}" enctype="multipart/form-data">
            	<input type="hidden" name="user_id" value="1">
            	{{csrf_field()}}
                <h3>Company Profile:</h3>
                <div class="row">
                    <label>Legal Name:</label>
                    <div class="input-field">
                        <input id="legal_name" type="text" name="legal_name">
                    </div>
                    <label for="legal_name" class="error"></label>
                </div>
                <hr />
                <h4>Address</h4>
                <div class="row">
                    <label>Street Address:</label>
                    <div class="input-field">
                        <input id="street_address" type="text" name="street_address">
                    </div>
                    <label for="street_address" class="error"></label>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <label>City:</label>
                        <div class="input-field">
                            <input id="city" type="text" name="city">
                        </div>
                        <label for="city" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>State:</label>
                        <div class="input-field">
                            <input id="state" type="text" name="state">
                        </div>
                        <label for="state" class="error"></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col m6 s12">
                    	<label>Zip Code:</label>
                        <div class="input-field">
                            <input id="zipcode" type="text" name="zipcode">
                        </div>
                        <label for="zipcode" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>Country:</label>
                    	<select name="country" id="country">
                            <option value="">Please Select</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
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
                            <input id="phone" type="text" name="phone">
                        </div>
                        <label for="phone" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>Fax:</label>
                        <div class="input-field">
                            <input id="fax" type="text" name="fax">
                        </div>
                        <label for="fax" class="error"></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col m6 s12">
                        <label>Email:</label>
                        <div class="input-field">
                            <input id="email" type="text" name="email">
                        </div>
                        <label for="email" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>Website:</label>
                        <div class="input-field">
                            <input id="website" type="text" name="website">
                        </div>
                        <label for="website" class="error"></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col m6 s12">
                        <label>Tax ID Number:</label>
                        <div class="input-field">
                            <input id="tax_id_number" type="text" name="tax_id_number">
                        </div>
                        <label for="tax_id_number" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>Logo:</label>
                        <input id="logo" type="file" name="logo" style="width: 100%;">
                        <label for="logo" class="error"></label>
                    </div>
                </div>
                <hr />
                <h3>Contact Person</h3>
                <div class="row">
                	<label>Name:</label>
                    <div class="input-field">
                        <input id="contact_name" type="text" name="contact_name">
                    </div>
                    <label for="contact_name" class="error"></label>
                </div>
                <div class="row">
                	<label>Designation:</label>
                    <div class="input-field">
                        <input id="contact_designation" type="text" name="contact_designation">
                    </div>
                    <label for="contact_designation" class="error"></label>
                </div>
                <div class="row">
                	<label>Email Address:</label>
                    <div class="input-field">
                        <input id="contact_email" type="text" name="contact_email">
                    </div>
                    <label for="contact_email" class="error"></label>
                </div>
                <hr />
                <h3>Business model</h3>
                <div class="row">
                	<div class="col m6 s12">
                        <label>Linen Rental:</label>
                        <div class="input-field">
                            <input id="linen_rental" type="text" name="linen_rental">
                        </div>
                        <label for="linen_rental" class="error"></label>
                    </div>
                	<div class="col m6 s12">
                        <label>Healthcare:</label>
                        <div class="input-field">
                            <input id="healthcare" type="text" name="healthcare">
                        </div>
                        <label for="healthcare" class="error"></label>
                    </div>
                </div>
                <div class="row">
                	<div class="col m6 s12">
                        <label>Hospitality (Hotel/Motel):</label>
                        <div class="input-field">
                            <input id="hospitality" type="text" name="hospitality">
                        </div>
                        <label for="healthcare" class="error"></label>
                    </div>
                    <div class="col m6 s12">
                    	<label>Vacational Rentals:</label>
                        <div class="input-field">
                            <input id="vacational_rentals" type="text" name="vacational_rentals">
                        </div>
                        <label for="vacational_rentals" class="error"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <label>Customer Own Goods:</label>
                        <div class="input-field">
                            <input id="customer_own_goods" type="text" name="customer_own_goods">
                        </div>
                        <label for="customer_own_goods" class="error"></label>
                    </div>
                    <div class="col m6 s12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col pull-right">
                      <button type="submit" class="waves-effect btn">Save</button>
                      <button type="reset" class="waves-effect btn">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End Main Content -->
@endsection

@section('js')
	<script>
    $(document).ready(function () {
		$("#country").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$('#compnay_profile').validate({
			rules: {
				legal_name: "required",
				street_address: "required",
				city: "required",
				state: "required",
				zipcode: "required",
				country: "required",
				phone: "required",
				fax: "required",
				email: {
					required: true,
					email: true
				},
				website: "required",
				tax_id_number: "required",
				logo: {
      				extension: "jpg|jpeg|png"
				},
				contact_name: "required",
				contact_designation: "required",
				contact_email: {
					required: true,
					email: true
				}
			}
		});
	});
	</script>
@endsection