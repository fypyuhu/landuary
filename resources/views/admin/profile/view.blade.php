@extends('masterProfile')
@section('content')
<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            @include('admin.profile.leftnav')
            
            <div id="loadAjaxFrom">
            <form method="post" action="/admin/profile/edit/{{$user->id}}" id="pageForm">
            {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{$user->user_id}}">
            <div class="oMain">
            	<fieldset style="margin-top:20px;" class="tab-content first" id="sec-company-profile">
                    <legend>Company Profile</legend>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m2 s12">
                                <div class="profile-pic">
                                	@if($user->logo != '')
                                	<img src="{{URL::asset('uploads/profile')}}/{{$user->logo}}" alt="" />
                                    @else
                                    No Picture
                                    @endif
                                </div>
                            </div>
                            <div class="col m9 s12">
                                <div class="row info-div">
                                    <h3>Company Legal Name</h3>
                                    <h4>{{$user->legal_name}}</h4>
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <label>Company Legal Name</label>
                                            <div class="input-field">
                                                <input id="legal_name" type="text" name="legal_name" value="{{$user->legal_name}}">
                                            </div>
                                            <label for="legal_name" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Address:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->street_address}} {{$user->city}}<br />
                                    {{$user->state}} {{$user->zipcode}}<br />
                                    {{$user->country}}
                                </div>
                                <div class="row edit-div">
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
                                            <label>Zipcode:</label>
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
                                                <option value="{{$country->country_name}}" {{ $country->country_name == $user->country ? 'selected="selected"' : '' }}>{{$country->country_name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="country" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Phone:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->phone}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="phone" type="text" name="phone" value="{{$user->phone}}">
                                            </div>
                                            <label for="phone" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Fax:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->fax}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="fax" type="text" name="fax" value="{{$user->fax}}">
                                            </div>
                                            <label for="fax" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Email:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->email}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="email" type="text" name="email" value="{{$user->email}}">
                                            </div>
                                            <label for="email" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Website:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->website}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="website" type="text" name="website" value="{{$user->website}}">
                                            </div>
                                            <label for="website" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Tax ID Number:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{ $user->tax_id_number ? $user->tax_id_number : 'NA' }}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="tax_id_number" type="text" name="tax_id_number" value="{{$user->tax_id_number}}">
                                            </div>
                                            <label for="tax_id_number" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Logo:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    <div class="profile-pic">
                                    	@if($user->logo != '')
                                        <img src="{{URL::asset('uploads/profile')}}/{{$user->logo}}" alt="" />
                                        @else
                                        No Picture
                                        @endif
                                    </div>
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <input id="logo" type="file" name="logo">
                                            <label for="logo" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset style="margin-top:20px;" class="tab-content" id="sec-contact-person">
                    <legend>Contact Person</legend>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Name:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->contact_name}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="contact_name" type="text" name="contact_name" value="{{$user->contact_name}}">
                                            </div>
                                            <label for="contact_name" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Designation:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->contact_designation}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="contact_designation" type="text" name="contact_designation" value="{{$user->contact_designation}}">
                                            </div>
                                            <label for="contact_designation" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Email:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->contact_email}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col m6 s12">
                                            <div class="input-field">
                                                <input id="contact_email" type="text" name="contact_email" value="{{$user->contact_email}}">
                                            </div>
                                            <label for="contact_email" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset style="margin-top:20px;" class="tab-content" id="sec-business-model">
                    <legend>Business model</legend>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>Industries We Serve:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->we_serve}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col s12">
                                            <input type="checkbox" name="we_serve[]" id="hospitality" value="Hospitality (Hotel &amp; Restaurant)" {{ str_contains($user->we_serve, 'Hospitality (Hotel & Restaurant)') ? 'checked="checked"' : ''}}> <label for="hospitality">Hospitality (Hotel &amp; Restaurant)</label><br />
                                            <input type="checkbox" name="we_serve[]" id="healthcare" value="Healthcare" {{ str_contains($user->we_serve, 'Healthcare') ? 'checked="checked"' : ''}}> <label for="healthcare">Healthcare</label><br />
                                            <input type="checkbox" name="we_serve[]" id="vacational_rentals" value="Vacational Rentals" {{ str_contains($user->we_serve, 'Vacational Rentals') ? 'checked="checked"' : ''}}> <label for="vacational_rentals">Vacational Rentals</label><br />
                                            <label for="we_serve" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row oTable">
                        <div class="row">
                            <div class="col m3 s12">
                                <strong>We Do:</strong>
                            </div>
                            <div class="col m8 s12">
                                <div class="row info-div">
                                    {{$user->we_do}}
                                </div>
                                <div class="row edit-div">
                                    <div class="row">
                                        <div class="col s12">
                                            <input type="checkbox" name="we_do[]" id="customer_own_goods" value="Customer Own Goods" {{ str_contains($user->we_do, 'Customer Own Goods') ? 'checked="checked"' : ''}}> <label for="customer_own_goods">Customer Own Goods</label><br />
                                            <input type="checkbox" name="we_do[]" id="linen_rentals" value="Linen Rentals" {{ str_contains($user->we_do, 'Linen Rentals') ? 'checked="checked"' : ''}}> <label for="linen_rentals">Linen Rentals</label><br />
                                            <label for="we_do" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                         <button class="waves-effect btn" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col m1 s12">
                                <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                                <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
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
		
		$( "body" ).on( "mouseover", '.content-wrap', function(e) {
			$("#country").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
			
			$('.editButton').click(function(e) {
				$(this).parents('.oTable').find('.info-div').hide();
				$(this).parents('.oTable').find('.edit-div').fadeIn('slow');
			});
			
			$('.cancelButton').click(function(e) {
				$(this).parents('.oTable').find('.edit-div').hide();
				$(this).parents('.oTable').find('.info-div').fadeIn('slow');
			});
			
			$("#pageForm").validate({
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
					},
					we_serve: "required",
					we_do: "required"
				},
				submitHandler: function (form) {
					$('.loading').show();
					var options = {
						success: showResponse
					};
					function showResponse(responseText, statusText, xhr, $form) {
						$('#loadAjaxFrom').html(responseText);
						$('.loading').hide();
					}
					$(form).ajaxSubmit(options);
				}
			});
		});
	});
</script>
@endsection	