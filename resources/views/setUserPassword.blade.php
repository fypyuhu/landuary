@extends('masterProfile')
@section('content')

	<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <div class="col m6 s12 leftside" style="background: #ffffff;">
            	<h2>Generate Password</h2>

                <!-- resources/views/auth/reset.blade.php -->
				
                @if (session('status'))
                	<div class="alert alert-success">
                    	{{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="/setUserPassword/edit" id="pageForm">
                    {!! csrf_field() !!}
                
                    <div class="row">
                        <label>Email:</label>
                        <div class="input-field">
                            <input id="email" type="text" name="email" value="{{ old('email') }}">
                        </div>
                        <label for="email" class="error"></label>
                    </div>
                	
                    <div class="row">
                        <label>Password:</label>
                        <div class="input-field">
                            <input id="password" type="password" name="password" value="{{ old('password') }}">
                        </div>
                        <label for="password" class="error"></label>
                    </div>
                    
                    <div class="row">
                        <label>Confirm Password:</label>
                        <div class="input-field">
                            <input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        </div>
                        <label for="password_confirmation" class="error"></label>
                    </div>
                    <hr />
                    <div class="row">
                        <button type="submit" class="waves-effect btn">Set Password</button>
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
			$('#pageForm').validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					password: "required",
					password_confirmation: {
						equalTo: "#password"
					},
				},
				messages: {
					password_confirmation: "Please enter the same password as above.",
				}
			});
		});
    </script>
@endsection