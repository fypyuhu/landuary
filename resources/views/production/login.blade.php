<!DOCTYPE html>
<html lang="en-US" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Laundary</title>
        <link rel='stylesheet' id='twentyfifteen-fonts-css' href='//fonts.googleapis.com/css?family=Noto+Sans%3A400italic%2C700italic%2C400%2C700%7CNoto+Serif%3A400italic%2C700italic%2C400%2C700%7CInconsolata%3A400%2C700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
        <script src="{{URL::asset('js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{URL::asset('css/nanoscroller.css')}}"></script>
        <link href="{{URL::asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet">
        <script src="{{URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{URL::asset('jquery.bxslider/jquery.bxslider.js')}}"></script>
        <link href="{{URL::asset('jquery.bxslider/jquery.bxslider.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" />
        
		<style type="text/css">
			.btn {
				text-decoration: none;
				color: #FFF;
				background-color: #42A5F5;
				text-align: center;
				letter-spacing: .5px;
				box-shadow: 0 1px 2px rgba(0,0,0,.26);
				-webkit-transition: .2s ease-out;
				transition: .2s ease-out;
				cursor: pointer;
			}
			
			.waves-effect {
				position: relative;
				cursor: pointer;
				display: inline-block;
				overflow: hidden;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				-webkit-tap-highlight-color: transparent;
				z-index: 1;
				will-change: opacity,transform;
				-webkit-transition: all .3s ease-out;
				transition: all .3s ease-out;
			}
			
			.btn-trial {
				background: #fff600;
				font-size: 18px;
				padding: 8px 15px;
				color: #6d6b3f;
				border: 1px solid #ffffff;
				height: 50px;
				line-height: 35px;
				margin-left: 15px;
			}
        </style>
        <script type="text/javascript">
			$(document).ready(function () {
				$('.bxslider').bxSlider({
					mode: 'fade',
					speed: 1000,
					pager: false,
					controls: false,
					auto: true
				});
				
				$('.btns').click(function(e){
					$('.frm').hide();
					var corr_div_id = $(this).data('corr-id');
					$(corr_div_id).slideDown('slow');
				});
			});
		</script>
        <link rel='stylesheet' id='twentyfifteen-style-css' href='{{URL::asset('style.css')}}' type='text/css' media='all' />
    </head>

    <body>

        <div class="bx-slider-container">
            <ul class="bxslider">
                <li><img src="{{URL::asset('images/bg1.jpg')}}" width="100%" /></li>
                <li><img src="{{URL::asset('images/bg2.jpg')}}" width="100%" /></li>
            </ul>
        </div>
        <!--<div class="col-sm-12" id="header"></div>-->
        <div class="container">	
        	<div class="buttonsss-wrap col-sm-12">
            	<div class="row">
                    <a href="javascript:void(0);" class="pull-left btns" data-corr-id="#frm-washroom">Wash Room</a>
                    <a href="javascript:void(0);" class="pull-right btns" data-corr-id="#frm-finishing">Finishing</a>
                </div>
                <div class="row">
                    <div class="frm pull-left" style="display: none;" id="frm-washroom">
                        <form method="post" action="/production/dashboard">
                        	<input type="hidden" name="prd_type" value="washroom">
                            {{csrf_field()}}
                            <div class="form-field" style="margin-bottom: 15px;">
                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Email" />
                            </div>
                            <div class="form-field" style="margin-bottom: 15px;">
                                <input type="password" name="password" placeholder="Password" />
                            </div>
                            <div class="form-field"><input type="submit" value="Log In" class="button pull-right" /></div>
                        </form>
                    </div>
                    <div class="frm pull-right" style="display: none;" id="frm-finishing">
                        <form method="post" action="/production/dashboard">
                        	<input type="hidden" name="prd_type" value="washroom">
                            {{csrf_field()}}
                            <div class="form-field" style="margin-bottom: 15px;">
                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Email" />
                            </div>
                            <div class="form-field" style="margin-bottom: 15px;">
                                <input type="password" name="password" placeholder="Password" />
                            </div>
                            <div class="form-field"><input type="submit" value="Log In" class="button pull-right" /></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
