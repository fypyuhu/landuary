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

<body>


  <!--
  Top Navbar
    Options:
      .navbar-dark - dark color scheme
      .navbar-static - static navbar
      .navbar-under - under sidebar
-->
  <nav class="navbar-top">
    <div class="nav-wrapper">

      <!-- Sidebar toggle -->
      <a href="#" class="yay-toggle">
        <div class="burg1"></div>
        <div class="burg2"></div>
        <div class="burg3"></div>
      </a>
      <!-- Sidebar toggle -->

      <!-- Logo -->
      <a href="#!" class="brand-logo">
        <img src="{{URL::asset('images/logo.png')}}" alt="Con">
      </a>
      <!-- /Logo -->

      <!-- Menu -->
      <ul>
        <li class="user">
          <a class="dropdown-button" href="#!" data-activates="user-dropdown">
            <img src="{{URL::asset('images/user.jpg')}}" alt="John Doe" class="circle">John Doe<i class="mdi-navigation-expand-more right"></i>
          </a>

          <div id="user-dropdown" class="dropdown-content">
          	<!--<h1>Lorem ipsum</h1>-->
              <div class="row">
                  <div class="col s12">
                  	<h4>Premier Laundry and Linen Supply LLC</h4>
                  	<ul class="col s4">
                    	<li><a href="javascript:void(0);">Settings</a>
                        </li>
                        <li><a href="customers.php">Customers</a>
                        </li>
                        <li><a href="items.php">Items</a>
                        </li>
                        <li><a href="carts.php">Carts</a>
                        </li>
                        <li><a href="tax.php">Tax</a>
                        </li>
                        <li><a href="invoice.php">Invoice</a>
                        </li>
                        <li><a href="manifest.php">Manifest</a>
                        </li>
                        <li><a href="bin-tickets.php">Bin Tickets</a>
                        </li>
                        <li style="background:none !important;">&nbsp;
                        </li>
                        <li style="background: #42a5f5 !important;"><a href="adjustment.php" style="color: #ffffff !important;">Adjustment</a>
                        </li>
                    </ul>
                    <ul class="col s4">
                    	<li><a href="javascript:void(0);">Reports</a>
                        </li>
                        <li><a href="javascript:void(0);">Manifest Report</a>
                        </li>
                        <li><a href="javascript:void(0);">Production Report</a>
                        </li>
                        <li><a href="javascript:void(0);">Audit Report</a>
                        </li>
                        <li><a href="javascript:void(0);">Rewash Reconciliation</a>
                        </li>
                    </ul>
                    <ul class="col s4">
                    	<li><a href="javascript:void(0);">Company Profile</a>
                        </li>
                        <li><a href="items.php">Account</a>
                        </li>
                        <li><a href="items.php">Users</a>
                        </li>
                        <li><a href="items.php">Privacy</a>
                        </li>
                        <li style="background:none !important;">&nbsp;
                        </li>
                        <li><a href="items.php"><i class="fa fa-sign-out"></i> Sign Out</a>
                        </li>
                    </ul>
                  </div>
              </div>
          </div>
        </li>
      </ul>
      <!-- /Menu -->
      <ul class="top-menu">
        <li>
        	<a href="javascript:void(0);">Main</a>
            <ul>
            	<li><a href="#">Incoming Cart</a></li>
                <li><a href="#">Carts Ready to Ship</a></li>
                <li><a href="#">Pending Orders</a></li>
                <li><a href="#">Outgoing Cart</a></li>
                <li><a href="#">Fill Ordres</a></li>
                <li><a href="#">Rewash Cart</a></li>
                <li><a href="#">Shipping Manifest</a></li>
                <li><a href="#">Receiving Manifest</a></li>
            </ul>
        </li>
        <li>
        	<a href="javascript:void(0);">Help</a>
            <ul>
            	<li><a href="#">Laundry-Track Manual (PDF)</a></li>
                <li><a href="#">System Info</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </li>
      </ul>
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

    <div class="top">
      <div>
        <!-- Sidebar toggle -->
        <a href="#" class="yay-toggle">
          <div class="burg1"></div>
          <div class="burg2"></div>
          <div class="burg3"></div>
        </a>
        <!-- Sidebar toggle -->
      </div>
    </div>


    <div class="nano">
      <div class="nano-content">
        <ul>
          <li class="label">Menu</li>
          <li style="background:#20405a;">
            <a href="in.php" class="waves-effect waves-blue"><i class="fa fa-magic"></i> In</a>
          </li>
          
          <li  style="background:#809db6;">
            <a href="out.php" class="waves-effect waves-blue"><i class="fa fa-magic"></i> Out</a>
          </li>
          
          <li style="background:#e55327;">
            <a href="shipping-manifest.php" class="waves-effect waves-blue"><i class="fa fa-magic"></i> Shipping Manifest</a>
          </li>
          
          <li  style="background:#92320f;">
            <a href="receiving-manifest.php" class="waves-effect waves-blue"><i class="fa fa-magic"></i> Receiving Manifest</a>
          </li>
          
          <li  style="background:#ad873b;">
            <a href="javascript:void(0);" class="waves-effect waves-blue"><i class="fa fa-magic"></i> Today</a>
          </li>
        </ul>

      </div>
    </div>
  </aside>
  <!-- /Yay Sidebar -->
            @yield('content')
        


  <!--
  Chat
    .chat-light - light color scheme
-->

  <footer>&copy; 2015 <strong>nK</strong>. All rights reserved. <a href="http://themeforest.net/item/con-material-admin-dashboard-template/10621512?ref=_nK">Purchase</a>
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
		
		$('.ctabs').find('li').click(function(e){
			$('.ctabs').find('li').removeClass('current');
			$(this).addClass('current');
			var corr_div_id = $(this).data('corr-div-id');
			toggle('.tab-content', corr_div_id);
		});
		
		$('#add_billing_address').click(function(e){
			var corr_div_id = $(this).data('corr-div-id');
			$(corr_div_id).fadeIn('slow');
		});
		
		$('#same_as_shipping').click(function(e){
			var corr_div_id = $(this).data('corr-div-id');
			$(corr_div_id).fadeOut('slow');
		});
		
		$('.pricing-rd-btn').click(function(){
			var corr_content_div_class = $(this).data('div-set');
			var corr_div_id = $(this).data('corr-div-id');
			
			$(corr_content_div_class).css('display','none');
			$(corr_div_id).fadeIn('slow');
		});
		
		$('.create-clone-button').click(function(e){
			e.preventDefault();
			var corr_div_id = $(this).data('corr-div-id');
			var clone = $(corr_div_id).find('.records_list').clone();
			clone.appendTo($(this).parents('.row').prev('.layout_table'));
			$(this).parents('.row').prev('.layout_table').animate({ scrollTop: $(this).parents('.row').prev('.layout_table')[0].scrollHeight}, 1000);
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
		
		$('#use_as_exchange_cart').click(function(){
			if($(this).is(':checked')) {
				$('#chkbx_enb_cus_num').trigger( "click" ).attr('disabled','disabled');
			} else {
				$('#chkbx_enb_cus_num').removeAttr('disabled').trigger( "click" );
			}
		});
		
		$('#price_by_weight').click(function(e){
			$('#price-field, #price-heading').css('display', 'none');
			$('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s2').addClass('s3');
			$('#div-price-by-weight').fadeIn('slow');
		});
		
		$('#price_by_item').click(function(e){
			$('#div-price-by-weight').css('display', 'none');
			$('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
			$('#price-field, #price-heading').fadeIn('slow');
		});
		
		$('#price_by_both').click(function(e){
			$('#div-price-by-weight').fadeIn('slow');
			$('#t-type, #t-category, #t-category-rec, #t-type-rec').removeClass('s3').addClass('s2');
			$('#price-field, #price-heading').fadeIn('slow');
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
