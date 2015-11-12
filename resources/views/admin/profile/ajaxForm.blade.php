<form method="post" action="/admin/profile/edit/{{$user->id}}" id="pageForm">
{{csrf_field()}}
<input type="hidden" name="user_id" value="{{$user->user_id}}">
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
                    <h4>{{$user->legal_name}}</h4>
                </div>
                <div class="row edit-div">
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Legal Name</label>
                            <div class="input-field">
                                <input id="legal_name" type="text" name="legal_name" value="{{$user->legal_name}}">
                            </div>
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
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>City:</label>
                            <div class="input-field">
                                <input id="city" type="text" name="city" value="{{$user->city}}">
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <label>State:</label>
                            <div class="input-field">
                                <input id="state" type="text" name="state" value="{{$user->state}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Zipcode:</label>
                            <div class="input-field">
                                <input id="zipcode" type="text" name="zipcode" value="{{$user->zipcode}}">
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <label>Country:</label>
                            <select name="country" id="country">
                                <option value="">Please Select</option>
                                @foreach($countries as $country)
                                <option value="{{$country->country_name}}" {{ $country->country_name == $user->country ? 'selected="selected"' : '' }}>{{$country->country_name}}</option>
                                @endforeach
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
                    {{$user->phone}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="phone" type="text" name="phone" value="{{$user->phone}}">
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
                    {{$user->fax}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="fax" type="text" name="fax" value="{{$user->fax}}">
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
                    {{$user->email}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="email" type="text" name="email" value="{{$user->email}}">
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
                    {{$user->website}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="website" type="text" name="website" value="{{$user->website}}">
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
                        <input id="log" type="file" name="logo">
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
                    {{$user->contact_name}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="contact_name" type="text" name="contact_name" value="{{$user->contact_name}}">
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
                    {{$user->contact_designation}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="contact_designation" type="text" name="contact_designation" value="{{$user->contact_designation}}">
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
                    {{$user->contact_email}}
                </div>
                <div class="row edit-div">
                    <div class="col m6 s12">
                        <div class="input-field">
                            <input id="contact_email" type="text" name="contact_email" value="{{$user->contact_email}}">
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
</form>