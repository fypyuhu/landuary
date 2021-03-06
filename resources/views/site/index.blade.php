<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>LINENTEK</title>
    <!-- Favicon -->
    <!--<link rel="shortcut icon" type="image/icon" href="{{URL::asset('site.assets/assets/images/favicon.ico')}}"/>-->
    <!-- Font Awesome -->
    <link href="{{URL::asset('site.assets/assets/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{URL::asset('site.assets/assets/css/bootstrap.css')}}" rel="stylesheet">    
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('site.assets/assets/css/slick.css')}}"/> 
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{URL::asset('site.assets/assets/css/jquery.fancybox.css')}}" type="text/css" media="screen" /> 
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('site.assets/assets/css/animate.css')}}"/> 
    <!-- Progress bar  -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('site.assets/assets/css/bootstrap-progressbar-3.3.4.css')}}"/> 
     <!-- Theme color -->
    <link id="switcher" href="{{URL::asset('site.assets/assets/css/theme-color/default-theme.css')}}" rel="stylesheet">

    <!-- Main Style -->
    <link href="{{URL::asset('site.assets/style.css')}}" rel="stylesheet">

    <!-- Fonts -->

    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Lato for Title -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header -->
  <header id="header">
    <!-- header top search -->
    <div class="header-top">
      <div class="container">
        <form action="">
          <div id="search">
          <input type="text" placeholder="Type your search keyword here and hit Enter..." name="s" id="m_search" style="display: inline-block;">
          <button type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
        </form>
      </div>
    </div>
    <!-- header bottom -->
    <div class="header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="header-contact">
              <ul>
                <li>
                  <div class="phone">
                    <i class="fa fa-phone"></i>
                    +1(800)-LINENTEK
                  </div>
                </li>
                <li>
                  <div class="mail">
                    <i class="fa fa-envelope"></i>
                    info@linentek.com
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="header-login">
              <a class="login modal-form" data-target="#login-form" data-toggle="modal" href="#">Login / Sign Up</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header -->
  
  <!-- Start login modal window -->
  <div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in" @if (count($errors)) style="display:block !important;" @endif>
    <div class="modal-dialog">
      <!-- Start login section -->
      <div id="login-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" onClick="$(this).parents('#login-form').fadeOut('slow');" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Login</h4>
        </div>
        <div class="modal-body">
          <!--<form>
            <div class="form-group">
              <input type="text" placeholder="User name" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
             <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span></label>
              <button class="btn signin-btn" type="button">SIGN IN</button>
            </div>                    
          </form>-->
            @if (count($errors))
            <ul style="list-style: none;" class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form method="post" action="/auth/login">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="email" value="{{ old('email') }}" name="email" placeholder="Email" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control" />
                </div>
    
                <div class="loginbox">
                    <label>
                        <input type="checkbox" value="1" name="remember" checked="checked" />
                        <span>Remember me</span>
                    </label>
                    <input type="submit" value="Log In" class="btn signin-btn" />
                </div>
            </form>
        </div>
        <div class="modal-footer footer-box">
          <a href="/password/email">Forgot password ?</a>
          <!--<span>No account ? <a id="signup-btn" href="#">Sign Up.</a></span>-->
        </div>
      </div>
      <!-- Start signup section -->
      <div id="signup-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-lock"></i>Sign Up</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input placeholder="Name" class="form-control">
            </div>
            <div class="form-group">
              <input placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <div class="signupbox">
              <span>Already got account? <a id="login-btn" href="#">Sign In.</a></span>
            </div>
            <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span><i class="fa"></i></label>
              <button class="btn signin-btn" type="button">SIGN UP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End login modal window -->

  <!-- BEGIN MENU -->
  <section id="menu-area">      
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand" href="index.html">LINENTEK</a>              
          <!-- IMG BASED LOGO  -->
           <!-- <a class="navbar-brand" href="index.html"><img src="{{URL::asset('site.assets/assets/images/logo.png')}}" alt="logo"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="/about">About EAZY Linen</a></li>
            <li><a href="javascript:void(0);">Features</a></li>
            <li><a href="javascript:void(0);">Testimonials</a></li>
            <li><a href="javascript:void(0);">Videos</a></li>
            <li><a href="javascript:void(0);">FAQ's</a></li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="blog-archive.html">Blog Archive</a></li>                
                <li><a href="blog-single-with-left-sidebar.html">Blog Single with Left Sidebar</a></li>
                <li><a href="blog-single-with-right-sidebar.html">Blog Single with Right Sidebar</a></li>
                <li><a href="blog-single-with-out-sidebar.html">Blog Single with out Sidebar</a></li>           
              </ul>
            </li>
            <li><a href="404.html">404 Page</a></li>-->               
            <li><a href="javascript:void(0);">Contact Us</a></li>
          </ul>                     
        </div><!--/.nav-collapse -->
        <a href="#" id="search-icon">
          <i class="fa fa-search"></i>
        </a>
      </div>     
    </nav>
  </section>
  <!-- END MENU --> 

  <!-- Start slider -->
  <section id="slider">
    <div class="main-slider">
      <div class="single-slide">
        <img src="{{URL::asset('site.assets/assets/images/slider-1.jpg')}}" alt="img">
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">EAZY Linen</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">
                  	<ul style="text-transform:capitalize; list-style:disc; list-style-position: inside; color: #ffffff; line-height: 30px;">
                    	<li>Web based linen management software</li>
                        <li>Incoming and outgoing shipment tracking</li>
                        <li>Complete inventory management</li>
                        <li>Comprehensive production and productivity tracking</li>
                        <li>Billing invoicing and other financials</li>
                        <li>Daily activity summary for all laundry operations</li>
                        <li>Indepth customized reporting for all departments</li>
                    </ul>
                  </p>
                  <!--<a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="{{url('register')}}">Free Trial</a>-->
                  <a class="read-more-btn" href="{{url('register')}}">Free Trial</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp" style="margin-top:175px;">
                  <img src="{{URL::asset('site.assets/assets/images/person1.png')}}" alt="business man">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--<div class="single-slide">
        <img src="{{URL::asset('site.assets/assets/images/slider-3.jpg')}}" alt="img">
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">We are Best Team & Support you always</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since</p>
                  <a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="#">Read More</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp">
                  <img src="{{URL::asset('site.assets/assets/images/person2.png')}}" alt="business man">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->          
    </div>
  </section>
  <!-- End slider -->

  <!-- Start Feature -->
  <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">About LinenTek</h2>
            <span class="line"></span>
            <p>LinenTek is a comprehensive large and medium scale industrial/commercial laundry operations management software. The software completely simplifies management operations of laundries serving hotel, restaurant, and healthcare industries. LinenTek software is really a one stop shop for a laundry’s client management, billing and financials, production control, inventory management, productivity tracking, record keeping and much more.</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="feature-content">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-shopping-cart feature-icon"></i>
                  <h4 class="feat-title">Cart Management &amp; Linen Tracking</h4>
                  <p> LinenTek's cart and linen tracking feature enables you to create and track incoming and outgoing carts on daily basis. The cart details include customer details, customer department, cart net weight, item list, cart net weight and many other relevant cart details. <a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-inventory feature-icon"></i>
                  <h4 class="feat-title" style="margin-top: 5px;">Inventory Management / Rental Linen</h4>
                  <p>Through the inventory management module of LinenTek, you can maintain a complete track of all your incoming and outgoing linen.  Through customized reporting, LinenTek lets you view your current inventory level for each one of your product. <a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-dollar feature-icon"></i>
                  <h4 class="feat-title">Billing, Invoicing &amp; Other Financials</h4>
                  <p>Completely automate your billing and invoicing system through LinenTek Financials. Maintain completely different or exactly same price rates for all your customers. Charge your clients by weigh, by item quantity or both. Maintain specialty item pricing for certain products.<a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-file-text feature-icon"></i>
                  <h4 class="feat-title">Production Reports &amp; Productivity Tracking</h4>
                  <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia. <a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-file-text feature-icon"></i>
                  <h4 class="feat-title">Custom Reporting for all Departments</h4>
                  <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam. <a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-summary feature-icon"></i>
                  <h4 class="feat-title">Daily Activity Summary for all Laundry Operations</h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident. <a href="javascript:void(0);" class="read-more">read more</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Feature -->

  <!-- Start about  -->
  <!--<section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">About us</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="about-content">
            <div class="row">
              <div class="col-md-6">
                <div class="our-skill">
                  <h3>Our Skills</h3>                  
                  <div class="our-skill-content">
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                    <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="100">
                        <span class="progress-title">Html5</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="85">
                        <span class="progress-title">Css3</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="70">
                        <span class="progress-title">JQuery</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="60">
                        <span class="progress-title">wordPress</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="40">
                        <span class="progress-title">Php</span>
                      </div>
                  </div>
                   <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="25">
                        <span class="progress-title">Java</span>
                      </div>
                  </div>
                  </div>                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="why-choose-us">
                  <h3>Why Choose Us?</h3>
                  <div class="panel-group why-choose-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Awesome Design Layout <span class="fa fa-minus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                        <img class="why-choose-img" src="{{URL::asset('site.assets/assets/images/testi1.jpg')}}" alt="img">
                         <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default ">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Quality Coding <span class="fa fa-plus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                         <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Great Support <span class="fa fa-plus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- end about -->

  <!-- Start counter -->
  <!--<section id="counter">
    <div class="counter-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="counter-area">
              <div class="row">
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="counter-no counter">
                      1275
                    </div>
                    <div class="counter-label">
                      Projects
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="counter-no counter">
                      5275
                    </div>
                    <div class="counter-label">
                      Hours Work
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                 <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-trophy"></i>
                    </div>
                    <div class="counter-no counter">
                      350
                    </div>
                    <div class="counter-label">
                      Awards
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <div class="counter-no counter">
                      875
                    </div>
                    <div class="counter-label">
                      Clients
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End counter -->


  <!-- Start Service -->
  <!--<section id="service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Our Services</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="service-content">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-desktop service-icon"></i>
                  <h4 class="service-title">Web Development</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-paw service-icon"></i>
                  <h4 class="service-title">Digital Design</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-magic service-icon"></i>
                  <h4 class="service-title">Marketing</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-shopping-cart service-icon"></i>
                  <h4 class="service-title">E-commerce</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-mobile service-icon"></i>
                  <h4 class="service-title">App Development</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-rocket service-icon"></i>
                  <h4 class="service-title">S.E.O</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End Service -->

  <!-- Start Pricing table -->
  <!--<section id="pricing-table">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Our Pricing Tables</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="pricing-table-content">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                  <div class="price-header">
                    <span class="price-title">Basic</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      25
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="0.75s" data-wow-delay="0.75s">
                  <div class="price-header">
                    <span class="price-title">Advanced</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      50
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price featured-price wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="price-header">
                    <span class="price-title">Professional</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      100
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="1.15s" data-wow-delay="1.15s">
                  <div class="price-header">
                    <span class="price-title">Exclusive</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      125
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End Pricing table -->  

  <!-- Start Pricing table -->
  <!--<section id="our-team">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Our Team</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="our-team-content">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{URL::asset('site.assets/assets/images/team-member-2.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>John Doe</p>
                   <span>CEO</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{URL::asset('site.assets/assets/images/team-member-1.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Bernice Neumann</p>
                   <span>Designer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{URL::asset('site.assets/assets/images/team-member-3.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Dvid Cameron</p>
                   <span>Developer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{URL::asset('site.assets/assets/images/team-member-1.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Bernice Neumann</p>
                   <span>Designer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End Pricing table -->
  
  <!-- Start Testimonial section -->
  <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="title-area">
                <h2 class="title">Whats Client Say</h2>
                <span class="line"></span>
              </div>
            </div>
            <div class="col-md-12">
              <!-- Start testimonial slider -->
              <div class="testimonial-slider">
                <!-- Start single slider -->
                <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{URL::asset('site.assets/assets/images/testi1.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>I started using LinenTek on one my laundries and in less than a year I have implemented it across all the branches. A very simple to use software that brings all the information you need to your finger tips.</p>
                    <h6>Raja Younas, <span>CEO Premier Luandries</span></h6>
                  </div>
                </div>
                <!-- Start single slider -->
                <!--<div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{URL::asset('site.assets/assets/images/testi3.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>Greatly impressed by the support provided by LaundryTek team, and the fact they have customized their software to meet our individual requirements is fantastic. All in all a great software to manage various laundry operations.</p>
                    <h6>John Dow, <span>CEO Hygiene Luandry</span></h6>
                  </div>
                </div>-->
                <!-- Start single slider -->
                <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{URL::asset('site.assets/assets/images/testi2.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>Greatly impressed by the support provided by LaundryTek team, and the fact they have customized their software to meet our individual requirements is fantastic. All in all a great software to manage various laundry operations.</p>
                    <h6>Michel, <span>Manager Hygiene Luandry</span></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6"></div>        
      </div>
    </div>
  </section>
  <!-- End Testimonial section -->

  <!-- Start Clients brand -->
  <section id="clients-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="clients-brand-area">
            <ul class="clients-brand-slide">
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/amazon.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/discovery.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/envato.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/tuenti.png')}}" alt="img">
                </div>
              </li>
               <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/amazon.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/discovery.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/envato.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{URL::asset('site.assets/assets/images/tuenti.png')}}" alt="img">
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Clients brand -->

  <!-- Start latest news -->
  <!--<section id="latest-news">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Latest News</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="latest-news-content">
            <div class="row">
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{URL::asset('site.assets/assets/images/blog-img-1.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">All about writing story</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{URL::asset('site.assets/assets/images/blog-img-2.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Best Mobile Device</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{URL::asset('site.assets/assets/images/blog-img-3.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Personal Note Details</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End latest news -->

  <!-- Start subscribe us -->
  <section id="subscribe">
    <div class="subscribe-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="subscribe-area">
              <h2 class="wow fadeInUp">Subscribe Newsletter</h2>
              <form action="" class="subscrib-form wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                <input type="text" placeholder="Enter Your E-mail..">
                <button class="subscribe-btn" type="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End subscribe us -->

  <!-- Start footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <!--<div class="col-md-6 col-sm-6">
          <div class="footer-left">
            <p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
          </div>
        </div>-->
        <div class="col-sm-12">
          <div class="footer-right">
            <a href="index.html"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End footer -->

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="{{URL::asset('site.assets/assets/js/bootstrap.js')}}"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/slick.js')}}"></script>    
  <!-- mixit slider -->
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/jquery.mixitup.js')}}"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/jquery.fancybox.pack.js')}}"></script>
 <!-- counter -->
  <script src="{{URL::asset('site.assets/assets/js/waypoints.js')}}"></script>
  <script src="{{URL::asset('site.assets/assets/js/jquery.counterup.js')}}"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/wow.js')}}"></script> 
  <!-- progress bar   -->
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/bootstrap-progressbar.js')}}"></script>  
  
 
  <!-- Custom js -->
  <script type="text/javascript" src="{{URL::asset('site.assets/assets/js/custom.js')}}"></script>
  
  </body>
</html>