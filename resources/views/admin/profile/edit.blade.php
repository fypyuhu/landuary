@extends('masterProfile')
@section('content') 
<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <div class="oSide">
            	<div class="oLeftNav">
            		<div>
            			<a href="/settings/my-info/" class="isCurrent" title="My Info">
                        	<i class="oIconUser oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Company Profile
                        </a>
                    </div>
            		<div>
            			<a href="/deposit-methods" title="Billing Methods">
                            <i class="oIconCreditCard oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Contact Person
                        </a>
                    </div>
            		<div>
            			<a href="/UserSettings/password-security" title="Password &amp; Security">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Business Model
                        </a>
                    </div>
        		</div>
            </div>
            
            <div class="oMain">
            	<h3>Company Profile</h3>
            	<div class="row oTable">
                    <div class="row">
                        <div class="col m2 s12">
                            <div class="profile-pic"></div>
                        </div>
                        <div class="col m9 s12">
                        	<div class="row info-div">
                                <h3>Legal Name</h3>
                                <h4>John Doe</h4>
                            </div>
                            <div class="row edit-div">
                                <div class="row">
                                    <div class="col m6 s12">
                                    	<label>Legal Name</label>
                                        <div class="input-field">
                                            <input id="ship_to_name" type="text" name="ship_to_name">
                                        </div>
                                    </div>
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
                                27 B Revenue Society College Road Lahore<br />
                                Pakistan 54000<br />
                                Pakistan
                            </div>
                            <div class="row edit-div">
                                <div class="row">
                                    <label>Street Address:</label>
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m6 s12">
                                        <label>City:</label>
                                        <div class="input-field">
                                            <input id="ship_to_name" type="text" name="ship_to_name">
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <label>State:</label>
                                        <div class="input-field">
                                            <input id="ship_to_name" type="text" name="ship_to_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m6 s12">
                                        <div class="input-field">
                                            <input id="ship_to_name" type="text" name="ship_to_name">
                                        </div>
                                    </div>
                                    <div class="col m6 s12">
                                        <select>
                                            <option value="">Please Select</option>
                                            <option value="">Germany</option>
                                            <option value="">USA</option>
                                            <option value="">UK</option>
                                        </select>
                                    </div>
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
                                +92 334 4568963
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                +92 334 4568963
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                info@domain.com
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                www.domain.com
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                659874521
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                <div class="profile-pic"></div>
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <input id="ship_to_name" type="file" name="ship_to_name">
                                </div>
                            </div>
                        </div>
                        <div class="col m1 s12">
                            <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                            <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                        </div>
                    </div>
                </div>
                
                <h3>Contact Person</h3>
                <div class="row oTable">
                    <div class="row">
                        <div class="col m3 s12">
                            <strong>Name:</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                John Doe
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                Software Engineer
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                                name@domain.com
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col m1 s12">
                            <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                            <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                        </div>
                    </div>
                </div>
                <h3>Business model</h3>
                <div class="row oTable">
                    <div class="row">
                        <div class="col m3 s12">
                            <strong>Linen Rental:</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                Lorem ipsum
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                            <strong>Healthcare:</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                Doller sit
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                            <strong>Hospitality (Hotel/Motel):</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                Holtel
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                            <strong>Vacational Rentals:</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                Lorem ispum
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
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
                            <strong>Customer Own Goods:</strong>
                        </div>
                        <div class="col m8 s12">
                        	<div class="row info-div">
                                lorem ispum<br />
                                Doller Sit<br />
                                Amet Contexture
                            </div>
                            <div class="row edit-div">
                                <div class="col m6 s12">
                                    <div class="input-field">
                                        <input id="ship_to_name" type="text" name="ship_to_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col m1 s12">
                            <a href="javascript:void(0);" class="oBtn oBtnSubtle editButton">Edit</a>
                            <a href="javascript:void(0);" class="cancelButton">Cancel</a>
                        </div>
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
		$('.editButton').click(function(e) {
			$(this).parents('.oTable').find('.info-div').hide();
			$(this).parents('.oTable').find('.edit-div').fadeIn('slow');
		});
		
		$('.cancelButton').click(function(e) {
			$(this).parents('.oTable').find('.edit-div').hide();
			$(this).parents('.oTable').find('.info-div').fadeIn('slow');
		});
	});
</script>
@endsection	