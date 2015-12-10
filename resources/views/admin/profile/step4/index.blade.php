@extends('masterProfile')
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    @include('admin.profile.steps')
    <div class="row starter" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<h4>Lorem ipusm dolle sit</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <!--<div class="row">
        	<button onclick="$(this).parents('.starter').css('display', 'none'); $('#taxes-div').fadeIn('slow');" class="waves-effect btn">Next</button>
        </div>-->
    </div>
    <div class="row" style="border:1px solid #d0cece; background:#f5f5f5; padding:30px;">
        <form name="frm_starting_values" id="pageForm" method="post" action="/admin/profile/initial-values/{{$iv_id->id}}">
            {{csrf_field()}}
            <fieldset>
                <legend>Starting Values:</legend>
                <div class="row">
                	<label>Invoice Number:</label>
                    <div class="input-field">
                        <input id="invoice_number" type="text" name="invoice_number" value="{{$iv_id->invoice_number}}">
                    </div>
                    <label for="invoice_number" class="error"></label>
                </div>
                <div class="row">
                    <label>Standard Tare Weight:</label>
                    <div class="input-field">
                        <input id="standard_tare_weight" type="text" name="standard_tare_weight" value="{{$iv_id->standard_tare_weight}}">
                    </div>
                    <label for="standard_tare_weight" class="error"></label>
                </div>
                <div class="row">
                	<label>Cart Number:</label>
                    <div class="input-field">
                        <input id="cart_number" type="text" name="cart_number" value="{{$iv_id->cart_number}}">
                    </div>
                    <label for="cart_number" class="error"></label>
                </div>
            </fieldset>
            <div class="row">
                <div class="col pull-right">
                  <button type="submit" class="waves-effect btn">Finish</button>
                  <button type="reset" class="waves-effect btn">Clear</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Main Content -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#pageForm').validate({
			rules: {
				invoice_number: {
					required: true,
					digits: true
				},
				standard_tare_weight: {
					required: true,
					digits: true
				},
				cart_number: {
					required: true,
					digits: true
				}
			}
		});
    });
</script>
@endsection