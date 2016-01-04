@extends('masterProduction')
@section('content')
<!-- Main Content -->
<section class="content-wrap">

    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9">
                <h1>Machine Details</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='/production/machine/machine-details'>Machine Details</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <div class="row no-rightmargin">
        <div class="col s9">
            <fieldset>
                <legend>Machine Details:</legend>
                <div class="row box">
                	<div class="col m4 s12">
                    	<img src="{{URL::asset('images/machine.jpg')}}" alt="" width="100%" />
                    </div>
                    <div class="col m4 s12">
                    	<h3>Machine A</h3>
                    	<p><strong>
                        Customer: Customer A<br />
                        Item: Towels<br /><br />
                        Started at: 10:00 PM<br />
                        Will stop at: 11:00 PM</strong></p>
                        <p><a href="/production/machine/report">View Today's Report</a></p>
                    </div>
                    <div class="col m4 s12">
                    	<h4 style="text-align:right;">25 December, 2015</h4>
                    	<div class="timer">
                        	<h1>00:05:54</h1>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

</section>
<!-- /Main Content -->
@endsection

@section('js')

@endsection