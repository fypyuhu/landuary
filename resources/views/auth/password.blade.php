@extends('masterProfile')
@section('content')
	<!-- Main Content -->
    <section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    	<div class="row" style="border: 1px solid #d0cece; background:#f5f5f5;">
            <div class="col m6 s12 leftside" style="background: #ffffff;">
            	<h2>Forgot Password?</h2>

                <form method="POST" action="/password/email">
                    {!! csrf_field() !!}
                
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                
                    <div>
                        Email
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>
                
                    <div>
                        <button type="submit">
                            Send Password Reset Link
                        </button>
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

@endsection