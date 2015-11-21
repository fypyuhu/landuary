@extends('masterProfile')
@section('content')
	<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <div class="col m6 s12 leftside" style="background: #ffffff;">
            	<h2>Your Account Details:</h2>
                <p>Already have a Luandry Track account? <a href="{{url('/')}}">Sign In</a></p>
                
                <form method="POST" action="/auth/register" id="pageForm">
                    {!! csrf_field() !!}
                	
                    @if (count($errors) > 0)
                    	<div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    
                    <div class="row">
                        <label>Legal Name:</label>
                        <div class="input-field">
                            <input id="legal_name" type="text" name="legal_name" value="{{ old('legal_name') }}">
                        </div>
                        <label for="legal_name" class="error"></label>
                    </div>
                    <hr />
                    <h4>Address</h4>
                    <div class="row">
                        <label>Address:</label>
                        <div class="input-field">
                            <input id="street_address" type="text" name="street_address" value="{{ old('street_address') }}">
                        </div>
                        <label for="street_address" class="error"></label>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>City:</label>
                            <div class="input-field">
                                <input id="city" type="text" name="city" value="{{ old('city') }}">
                            </div>
                            <label for="city" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>State:</label>
                            <div class="input-field">
                                <input id="state" type="text" name="state" value="{{ old('state') }}">
                            </div>
                            <label for="state" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Zipcode:</label>
                            <div class="input-field">
                                <input id="zipcode" type="text" name="zipcode" value="{{ old('zipcode') }}">
                            </div>
                            <label for="zipcode" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Country:</label>
                            <select name="country" id="country">
                                <option value="">Please Select</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->country_name }}" {{$country->country_name == old('country') ? 'selected="selected"' : ''}}>{{ $country->country_name }}</option>
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
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}">
                            </div>
                            <label for="phone" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Fax:</label>
                            <div class="input-field">
                                <input id="fax" type="text" name="fax" value="{{ old('fax') }}">
                            </div>
                            <label for="fax" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Email:</label>
                            <div class="input-field">
                                <input id="email" type="text" name="email" value="{{ old('email') }}">
                            </div>
                            <label for="email" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Website:</label>
                            <div class="input-field">
                                <input id="website" type="text" name="website" value="{{ old('website') }}">
                            </div>
                            <label for="website" class="error"></label>
                        </div>
                    </div>
                    <hr />
                    <h4>Contact Person</h4>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Name:</label>
                            <div class="input-field">
                                <input id="contact_name" type="text" name="contact_name" value="{{ old('contact_name') }}">
                            </div>
                            <label for="contact_name" class="error"></label>
                        </div>
                        <div class="col m6 s12">
                            <label>Designation:</label>
                            <div class="input-field">
                                <input id="contact_designation" type="text" name="contact_designation" value="{{ old('contact_designation') }}">
                            </div>
                            <label for="contact_designation" class="error"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Email Address:</label>
                            <div class="input-field">
                                <input id="contact_email" type="text" name="contact_email" value="{{ old('contact_email') }}">
                            </div>
                            <label for="contact_email" class="error"></label>
                        </div>
                        <div class="col m6 s12"></div>
                    </div>
                    <hr />
                    <div class="row">
                        <button type="submit" class="waves-effect btn">Register</button>
                        <button type="reset" class="waves-effect btn">Clear</button>
                    </div>
                </form>
            </div>
            <div class="col m6 s12 rightside" align="center" style="background:#f5f5f5;">
            	<br /><br /><br />
            	<img src="{{URL::asset('images/abc.jpg')}}" alt="" />
            </div>
        </div>
    </section>
    <!-- End Main Content -->
@endsection

@section('js')
	<script type="text/javascript">
    	$(document).ready(function(e){
			$("#country").jqxComboBox({width: '100%', autoDropDownHeight: true});
			$('#pageForm').validate({
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
					website: "required",
					contact_name: "required",
					contact_designation: "required",
					contact_email: {
						required: true,
						email: true
					},
				}
			});
		});
    </script>
@endsection