@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">
    
    <div class="row getting-started">
        <div class="row">
            <h4>Getting Started With Laundry | <span class="guide">Welcome Guide</span></h4>
        </div>
        <div class="row" style="margin-top:20px; margin-bottom:20px;">
            <div class="col m3 s12 video-box one">
                <div class="label">10 Carts</div>
                <div class="text">Ready to ship</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
            <div class="col m3 s12 video-box two">
                <div class="label">5 Invoices</div>
                <div class="text">Due this week</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
            <div class="col m3 s12 video-box three">
                <div class="label">Lorem Ipsum</div>
                <div class="text">Doller sit amet contexture</div>
            </div>
            <div class="col m1 s12">&nbsp;</div>
        </div>
    </div>
    
    <div class="row logo-sect">
    	<div class="logo-cont pull-left">Logo</div>
        <div class="pull-left">
            <h4>Quetzal Works</h4>
            Thursday, November 19 2015
        </div>
    </div>
    
    <div class="row trial">
    	<div class="alert-content">
        	<span class="secondary-color-sprite alert-icon"></span>
            <span style="font-size: 16px;"><strong>Your trial ends in 1 day!</strong></span>
        </div>
        <div class="alert-content">
        	<span>Feel free to keep testing Laundry Tech.</span>
            <a href="#">Subscribe Now</a>
        </div>
    </div>
    
    <div class="row graph-box">
    	<h4>Income <a href="#" class="pull-right">Create an invoice</a></h4>
        <div class="row" style="margin-top:30px;">
        	<div class="col m4 s12">
            	<div class="row graph-bar gb-one"></div>
                <div class="row gb-detail">
                	$0<br />
                    Open Invoices
                </div>
            </div>
            <div class="col m4 s12">
            	<div class="row graph-bar gb-two"></div>
                <div class="row gb-detail">
                	$0<br />
                    Over Due
                </div>
            </div>
            <div class="col m4 s12">
            	<div class="row graph-bar gb-three"></div>
                <div class="row gb-detail">
                	$0<br />
                    Paid Last 30 Days
                </div>
            </div>
        </div>
    </div>
    
    <div class="row graph-box">
    	<h4>Expenses <a href="#" class="pull-right">Create an invoice</a></h4>
        <div class="row" style="margin-top:30px;">
        	<div class="col m4 s12">
                <div class="row gb-detail">
                	$0<br />
                    Last 30 Days
                </div>
            </div>
            <div class="col m4 s12">
                <img src="{{URL::asset('images/det.jpg')}}" alt="" class="pull-right">
            </div>
            <div class="col m4 s12">
                <img src="{{URL::asset('images/piechart.png')}}" alt="" class="pull-right" width="155">
            </div>
        </div>
    </div>
    
    <div class="row graph-box">
    	<h4>Profit &amp; Loss <a href="#" class="pull-right">Create an invoice</a></h4>
        <div class="row" style="margin-top:30px;">
        	<div class="col m6 s12">
                <div class="row gb-detail">
                	$0<br />
                    Net Income
                </div>
            </div>
            <div class="col m6 s12">
                <img src="{{URL::asset('images/graph.jpg')}}" alt="" class="pull-right">
            </div>
        </div>
    </div>

</section>	
<!-- End Main Content -->
@endsection

@section('js')
@endsection