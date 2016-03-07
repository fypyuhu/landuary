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
		background: #749e35;
		height: 63px;
	}
	
	footer ul {
		padding: 0;
		width: auto;
		display: table;
		margin: 0;
	}
	
	footer ul li {
		display: inline-block;
	}
	
	footer ul li:hover {
		background-color: #7aa978 !important;
	}
	
	footer ul li a {
		color: #ffffff;
		height: 62px; 
		line-height: 62px;
		padding: 0 20px;
		display: block;
		border-right: 1px solid #fafafa;
		font-size: 16px;
		padding-left: 45px !important;
	}
	
	footer ul li a.fag {
		background-position: 15px 21px !important;
	}
	
	footer ul li:last-child a {
		border-right: 0;
	}
	
	aside {
		background: #264d99 !important;
	}
	
	.yaybar ul li.first-child {
		font-weight: bold !important;
		font-size: 18px !important;
		text-align: center;
		height: 50px !important;
		line-height: 50px !important;
	}
	
	.yaybar ul li.first-child:hover {
		background: none !important;
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
      
      <!--<div class="toggle-btn"></div>
      <div id="reports-nav" class="dropdown-content">
          <div class="row">
              <div class="col s12">
                <h4>Reports</h4>
                <ul class="col s6">
                	<li><a href="javascript:void(0);">General</a>
                    </li>
                    <li><a href="{{url('admin/manifests')}}">Manifests</a>
                    </li>
                    <li><a href="{{url('admin/carts-list')}}">Carts</a>
                    </li>
                    <li><a href="{{url('admin/rewash/list')}}">Rewash</a>
                    </li>
                    <li><a href="{{url('admin/reconciliation')}}">Reconciliation</a>
                    </li>
                </ul>
                <ul class="col s6">
                	<li><a href="javascript:void(0);">Accounting</a>
                    </li>
                    <li><a href="{{url('admin/invoices')}}">Invoices</a>
                    </li>
                    <li><a href="{{url('admin/taxes/list')}}">Tax</a>
                    </li>
                    <li><a href="{{url('admin/invoices/income')}}">Income</a>
                    </li>
                    
                </ul>
              </div>
          </div>
      </div>-->

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

          <div id="user-dropdown" class="dropdown-content">
          	<!--<h1>Lorem ipsum</h1>-->
              <div class="row">
                  <div class="col s12">
                  	<h4>{{$user_profile_global->legal_name}}</h4>
                  	<ul class="col s6">
                    	<li><a href="javascript:void(0);">Settings</a>
                        </li>
                        <li><a href="{{url('admin/customers')}}">Customers</a>
                        </li>
                        <li><a href="{{url('admin/items')}}">Items</a>
                        </li>
                        <li><a href="{{url('admin/carts')}}">Carts</a>
                        </li>
                        <li><a href="{{url('admin/taxes')}}">Tax</a>
                        </li>
                        <!--<li><a href="javascript:void(0);">Invoice</a>
                        </li>
                        <li><a href="{{url('admin/manifests')}}">Manifest</a>
                        </li>
                        <li><a href="javascript:void(0);">Bin Tickets</a>
                        </li>-->
                    </ul>
                    <ul class="col s6">
                    	<li><a href="javascript:void(0);">Company Profile</a>
                        </li>
                        <li><a href="{{url('admin/profile/view')}}">Account</a>
                        </li>
                        <li><a href="{{url('admin/users')}}">Users</a>
                        </li>
                        <li style="background:none !important;">&nbsp;
                        </li>
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out"></i> Sign Out</a>
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

  <!--
  Yay Sidebar
  Options [you can use all of theme classnames]:
    .yay-hide-to-small         - no hide menu, just set it small with big icons
    .yay-static                - stop using fixed sidebar (will scroll with content)
    .yay-gestures              - to show and hide menu using gesture swipes
    .yay-light                 - light color scheme
    .yay-hide-on-content-click - hide menu on content click

  Effects [you can use one of these classnames]:
    .yay-overlay  - overlay content
    .yay-push     - push content to right
    .yay-shrink   - shrink content width
-->
  <aside class="yaybar yay-shrink yay-hide-to-small yay-gestures yay-light yay-static">
    <!-- Logo -->
    <a href="/admin" class="brand-logo">
      <img src="{{URL::asset('images/logo.png')}}" alt="Con">
    </a>
    <!-- /Logo -->
    <div class="nano">
      <div class="nano-content">
        <ul>
        	<li class="label first-child">Reports</li>
            <li class="mainmenu">
            	<a href="javascript:void(0);" class="waves-effect waves-blue fag fa-general">General <span>&nbsp;</span></a>
                <ul class="submenu">
                    <li><a href="{{url('admin/manifests')}}" class="waves-effect waves-blue">&gt; Manifests</a></li>
                    <li><a href="{{url('admin/carts-list')}}" class="waves-effect waves-blue">&gt; Carts</a></li>
                </ul>
            </li>
            <li><a href="{{url('admin/rewash/list')}}" class="waves-effect waves-blue fag fa-rewash">Rewash</a></li>
            <li><a href="{{url('admin/reconciliation')}}" class="waves-effect waves-blue fag fa-reconcile">Reconciliation</a></li>
            <li class="mainmenu">
            	<a href="javascript:void(0);" class="waves-effect waves-blue fag fa-accounting">Accounting <span>&nbsp;</span></a>
                <ul class="submenu">
                    <li><a href="{{url('admin/invoices')}}" class="waves-effect waves-blue fag fa-shipping">&gt; Invoices</a></li>
                    <li><a href="{{url('admin/taxes/list')}}">&gt; Tax</a></li>
                    <li><a href="{{url('admin/invoices/income')}}">&gt; Income</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="waves-effect waves-blue fag fa-inventory">Inventory</a></li>
            <li class="mainmenu">
                <a href="javascript:void(0);" class="waves-effect waves-blue fag fa-production">Production <span>&nbsp;</span></a>
                <ul class="submenu">
                    <li><a href="javascript:void(0);" class="waves-effect waves-blue">Washroom</a></li>
                    <li><a href="javascript:void(0);" class="waves-effect waves-blue">Finishing</a></li>
                </ul>
            </li>
            <li class="mainmenu">
                <a href="javascript:void(0);" class="waves-effect waves-blue fag fa-adjustment">Adjustments <span>&nbsp;</span></a>
                <ul class="submenu">
                    <li><a href="{{url('admin/manifests')}}" class="waves-effect waves-blue">&gt; Manifests</a></li>
                    <li><a href="{{url('admin/carts-list')}}" class="waves-effect waves-blue">&gt; Carts</a></li>
                </ul>
            </li>
          <!--<li class="label">Menu</li>
          <li>
            <a href="{{url('admin')}}" class="waves-effect waves-blue fag fa-homec">Dashboard</a>
          </li>
          
          <li>
            <a href="{{url('admin/in')}}" class="waves-effect waves-blue fag fa-in">In</a>
          </li>
          
          <li>
            <a href="{{url('admin/out')}}" class="waves-effect waves-blue fag fa-out">Out</a>
          </li>
          
          <li>
            <a href="{{url('admin/shiping-manifest')}}" class="waves-effect waves-blue fag fa-shipping">Shipping Manifest</a>
          </li>
          
          <li>
            <a href="{{url('admin/receiving-manifest')}}" class="waves-effect waves-blue fag fa-receiving">Receiving Manifest</a>
          </li>
          <li>
            <a href="{{url('admin/invoices/create')}}" class="waves-effect waves-blue fag fa-shipping">Create Invoice</a>
          </li>
          
          <li>
            <a href="{{url('admin/rewash')}}" class="waves-effect waves-blue fag fa-rewash">Rewash</a>
          </li>
          
          <li class="mainmenu">
            <a href="javascript:void(0);" class="waves-effect waves-blue fag fa-adjustment">Adjustment</a>
            <ul class="submenu">
            	<li><a href="{{url('admin/manifests')}}" class="waves-effect waves-blue">&gt; Manifests</a></li>
                <li><a href="{{url('admin/carts-list')}}" class="waves-effect waves-blue">&gt; Carts</a></li>
            </ul>
          </li>-->
          
          <!--<li>
            <a href="javascript:void(0);" class="waves-effect waves-blue fag fa-today">Today</a>
          </li>-->
          
        </ul>

      </div>
    </div>
  </aside>
  <!-- /Yay Sidebar -->
            @yield('content')
        


  <footer align="center" style="position:fixed; bottom:0; left:0; width: 100%;">
  	<ul>
    	<li>
            <a href="{{url('admin')}}" class="fag fa-homec">Dashboard</a>
          </li>
          
          <li>
            <a href="{{url('admin/in')}}" class="fag fa-in">In</a>
          </li>
          
          <li>
            <a href="{{url('admin/out')}}" class="fag fa-out">Out</a>
          </li>
          
          <li>
            <a href="{{url('admin/shiping-manifest')}}" class="fag fa-shipping">Shipping Manifest</a>
          </li>
          
          <li>
            <a href="{{url('admin/receiving-manifest')}}" class="fag fa-receiving">Receiving Manifest</a>
          </li>
          <li>
            <a href="{{url('admin/invoices/create')}}" class="fag fa-shipping">Create Invoice</a>
          </li>
          
          <li>
            <a href="{{url('admin/rewash')}}" class="fag fa-rewash">Rewash</a>
          </li>
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
		
		$('.mainmenu').click(function(e){
			$(this).find('.submenu').slideDown("slow");	
		});
		
		$('.mainmenu').mouseleave(function(e){
			$(this).find('.submenu').slideUp("slow");	
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
