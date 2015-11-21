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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form name="reset_password" id="reset_password" method="post" action="{{url('admin/profile/reset-password')}}">
            	{{csrf_field()}}
            	<fieldset style="margin-top:20px;">
                    <legend>Reset Password:</legend>
                    <div class="row">
                        <label>Current Password:</label>
                        <div class="input-field">
                            <input id="current_password" type="password" name="current_password">
                        </div>
                        <label for="current_password" class="error"></label>
                    </div>
                    <div class="row">
                        <label>New Password:</label>
                        <div class="input-field">
                            <input id="password" type="password" name="password">
                        </div>
                        <label for="password" class="error"></label>
                    </div>
                    <div class="row">
                        <label>Confirm New Password:</label>
                        <div class="input-field">
                            <input id="password_confirmation" type="password" name="password_confirmation">
                        </div>
                        <label for="password_confirmation" class="error"></label>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col pull-right">
                      <button type="submit" class="waves-effect btn">Save</button>
                      <button type="reset" class="waves-effect btn">Clear</button>
                    </div>
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
		$('#reset_password').validate({
			rules: {
				current_password: "required",
				password: "required",
				password_confirmation: {
					equalTo: "#password",
				},
			}
		});
	});
	</script>
@endsection