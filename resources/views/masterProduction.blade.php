<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LaundryTek</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

  <link rel="icon" type="image/png" href="{{URL::asset('images/icon.png')}}">

  <!-- nanoScroller -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/nanoscroller.css')}}" />

  <!-- FontAwesome -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.min.css')}}" />

  <!-- Material Design Icons -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/material-design-icons.min.css')}}" />

  <!-- IonIcons -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/ionicons.min.css')}}" />

  <!-- WeatherIcons -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/weather-icons.min.css')}}" />

  <!-- Google Prettify -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/prettify.css')}}" />
  <!-- Main -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/_con.min.css')}}" />
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('jqwidgets/styles/jqx.base.css')}}" type="text/css" />
  <!-- Fancy Box -->
  <link rel="stylesheet" href="{{URL::asset('fancybox/source/jquery.fancybox.css')}}" type="text/css" media="screen" />
  <!-- Fancy Box -->
  @section('css')
  @show
  <!--[if lt IE 9]>
    <script src="assets/html5shiv/html5shiv.min.js"></script>
  <![endif]-->
  <style type="text/css">
  	.content-wrap {
		margin-left: 0;
		min-height: calc(100vh - 80px);
	}
	
	footer {
		padding: 0;
		background: #193048;
		height: 80px;
	}
	
	footer ul {
		padding: 0;
		width: auto;
		display: table;
		margin: 0 auto;
	}
	
	footer ul li {
		display: inline-block;
	}
	
	footer ul li:hover {
		background-color: #0098CD !important;
	}
	
	footer ul li a {
		color: #ffffff;
		height: 79px; 
		line-height: 79px;
		padding: 0 20px;
		display: block;
		border-right: 1px solid #fafafa;
		font-size: 16px;
		padding-left: 45px !important;
	}
	
	footer ul li a.fag {
		background-position: 15px 29px !important;
	}
	
	footer ul li:last-child a {
		border-right: 0;
	}
  </style>
</head>

<body>
<div class="loading"><img src="{{URL::asset('images/ajax-loader.gif')}}" alt="" /></div>

  <!--
  Top Navbar
    Options:
      .navbar-dark - dark color scheme
      .navbar-static - static navbar
      .navbar-under - under sidebar
-->
  <nav class="navbar-top">
    <div class="nav-wrapper">
      <p class="heading-production-room">Production Room</p>

      <!-- Menu -->
      <ul>
        <li class="user">
          <a class="dropdown-button" href="javascript:void(0);">
          	@if ($user_profile_global->logo != '')
            <img src="{{URL::asset('uploads/profile')}}/{{$user_profile_global->logo}}" alt="{{$user_global->first_name}}" class="circle">
            @else 
            <span class="logo">{{$user_global->first_name}}</span>&nbsp;&nbsp;&nbsp;
            @endif
            {{$user_global->first_name}}<i class="mdi-navigation-expand-more right"></i>
          </a>

          <div id="user-dropdown" class="dropdown-content" style="width: 249.484px !important;">
          	<!--<h1>Lorem ipsum</h1>-->
              <div class="row">
                  <div class="col s12">
                  	<h4>{{$user_profile_global->legal_name}}</h4>
                  	<ul class="col s12">
                    	<li><a href="javascript:void(0);">Production Management</a>
                        </li>
                        <li><a href="{{url('production/washroom/machine')}}">Machine Settings</a>
                        </li>
                        <li><a href="{{url('production/users')}}">Users</a>
                        </li>
                        <li><a href="{{url('production/rules')}}">Rules</a>
                        </li>
                    </ul>
                  </div>
              </div>
          </div>
        </li>
      </ul>
      <!-- /Menu -->
    </div>
  </nav>
  <!-- /Top Navbar -->

            @yield('content')

  <footer align="center">
  	<ul>
    	<li><a href="{{url('production/dashboard')}}" class="fag fa-homec">Dashboard</a></li>
    	<li><a href="{{url('production/washroom/start-machine')}}" class="fag fa-start" data-mode="ajax2">Start Machine</a></li>
        <li><a href="{{url('production/washroom/report')}}" class="fag fa-washroom">Wash Room</a></li>
        <!--<li><a href="#">Finishing</a></li>-->
    </ul>
  </footer>

  <!-- jQuery -->
  <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('jqwidgets/jqx-all.js')}}"></script>
  <!-- nanoScroller -->
  <script type="text/javascript" src="{{URL::asset('js/jquery.nanoscroller.min.js')}}"></script>
  

  <!-- Materialize -->
  
  <!-- Google Prettify -->
  <script type="text/javascript" src="{{URL::asset('js/prettify.js')}}"></script>
  
  <!-- Main -->
  <script type="text/javascript" src="{{URL::asset('js/_con.min.js')}}"></script>

  <!-- Fancy Box -->
  <script type="text/javascript" src="{{URL::asset('fancybox/source/jquery.fancybox.js')}}"></script>
  <!-- Fancy Box -->
  
  <!-- validate -->
  <script type="text/javascript" src="{{URL::asset('js/jquery.validate.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/additional-methods.min.js')}}"></script>
  <!-- validate -->
  <script type="text/javascript" src="{{URL::asset('js/jquery.form.min.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/application.js')}}"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
		$('.top-menu li').mouseover(function(){
			$(this).find('ul').slideDown('slow');
		});
		
		$('.top-menu li').mouseleave(function(){
			$(this).find('ul').slideUp('slow');
		});
		
		$('.pricing-rd-btn').click(function(){
			var corr_content_div_class = $(this).data('div-set');
			var corr_div_id = $(this).data('corr-div-id');
			
			$(corr_content_div_class).css('display','none');
			$(corr_div_id).fadeIn('slow');
		});
		
		$('#non_tracked_cart').click(function(e){
			var corr_div_id = $(this).data('corr-div-id');
			if($(this).is(':checked')) {
				$(corr_div_id).slideUp('slow');
			} else {
				$(corr_div_id).slideDown('slow');
			}
		});
		
		$('#use_departments').click(function(e){
			var corr_div_id = $(this).data('corr-div-id');
			if(!$(this).is(':checked')) {
				$(corr_div_id).slideUp('slow');
			} else {
				$(corr_div_id).slideDown('slow');
			}
		});
		$( "body" ).on( "click",".checkbox",  function(e) {
                    var corr_div_id = $(this).attr('data-corr-div-id');
			if(!$(this).is(':checked')) {
				$(corr_div_id).slideUp('slow');
			} else {
				$(corr_div_id).slideDown('slow');
			}
                });
		$('.radiobutton').click(function(e){
			var corr_div_id = $(this).data('corr-div-id');
			var set_class = $(this).data('set-class');
			$(set_class).slideUp('slow');
			if(!$(this).is(':checked')) {
				$(corr_div_id).slideUp('slow');
			} else {
				$(corr_div_id).slideDown('slow');
			}
		});
		$('#chkbx_enb_cus_num').click(function(){
			if(!$(this).is(':checked')) {
				$('#number').attr('readonly','readonly');
			} else {
				$('#number').removeAttr('readonly');
			}
		});
		
		$("a#inline").fancybox({
			'hideOnContentClick': true
		});
		
		$( ".toggle-btn" ).click(function() {
		    $('#reports-nav').slideToggle( "slow" );
			$('#user-dropdown').slideUp( "slow" );
		});
		
		$( ".dropdown-button" ).click(function() {
		    $('#user-dropdown').slideToggle( "slow" );
			$('#reports-nav').slideUp( "slow" );
		});
		
		$('.content-wrap').click(function(e){
			$('#reports-nav, #user-dropdown').slideUp( "slow" );
		});
		
		$('.mainmenu').mouseover(function(e){
			$('.submenu').show();	
		});
		
		$('.mainmenu').mouseleave(function(e){
			$('.submenu').hide();	
		});
	});
	
	function toggle(hide, show) {
		$(hide).css('display', 'none');
		$(show).fadeIn('slow');
	}
  </script>
  
  <script src="{{URL::asset('js/print/jQuery.print.js')}}"></script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="{{URL::asset('js/custom.js')}}"></script>
  @section('js')
  @show
</body>

</html>
