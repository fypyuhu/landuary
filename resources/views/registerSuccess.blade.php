@extends('masterProfile')
@section('content')

	<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <div class="col m6 s12 leftside" style="background: #ffffff; height: 508px;">
            	<h2>Congratulations:</h2>
                <p style="font-size: 18px;">Your account with Laundry Tek has been created successfully. Your login details will be sent to your email address in 30 minutes.</p>
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
@endsection