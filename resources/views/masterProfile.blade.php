<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Con - Admin Dashboard with Material Design</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

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

</head>

<body style="background:url({{URL::asset('images/bg-line-repeat.png')}}) repeat;">


  <!--
  Top Navbar
    Options:
      .navbar-dark - dark color scheme
      .navbar-static - static navbar
      .navbar-under - under sidebar
-->
	<nav class="navbar-top" style="position:relative;">
        <div class="nav-wrapper" align="center">
    
          <!-- Logo -->
          <a href="#!" class="brand-logo" style="position:relative;">
            <img src="{{URL::asset('images/logo.png')}}" alt="Con">
          </a>
          <!-- /Logo -->
          
        </div>
    </nav>
  <!-- /Top Navbar -->
  
            @yield('content')
        


  <!--
  Chat
    .chat-light - light color scheme
-->

  <footer align="center">&copy; 2015 <strong>nK</strong>. All rights reserved. <a href="http://themeforest.net/item/con-material-admin-dashboard-template/10621512?ref=_nK">Purchase</a>
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
		
	});
	
	function toggle(hide, show) {
		$(hide).css('display', 'none');
		$(show).fadeIn('slow');
	}
  </script>
  @section('js')
  @show
</body>

</html>
