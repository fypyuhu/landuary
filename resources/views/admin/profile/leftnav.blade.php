			<div class="oSide">
            	<div class="oLeftNav ctabsleft">
            		<div>
            			<a id="link-company-profile" href="{{url('admin/profile')}}" data-corr-div-id="#sec-company-profile" class="isCurrent ltab" title="My Info">
                        	<i class="oIconUser oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Company Profile
                        </a>
                    </div>
            		<div>
            			<a id="link-contact-person" href="{{url('admin/profile')}}" data-corr-div-id="#sec-contact-person" class="ltab" title="Billing Methods">
                            <i class="oIconCreditCard oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Contact Person
                        </a>
                    </div>
            		<div>
            			<a id="link-business-model" href="{{url('admin/profile')}}" data-corr-div-id="#sec-business-model" class="ltab" title="Password &amp; Security">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Business Model
                        </a>
                    </div>
                    @if(isset($visited) && $visited)
                    <div>
            			<a id="link-reset-password" href="{{url('admin/profile/reset-password')}}" title="Password &amp; Security">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Reset Password
                        </a>
                    </div>
                    @if(isset($showDashBoard) && $showDashBoard)
                    <div>
            			<a href="{{url('admin/')}}" title="Password &amp; Security" style="background: #a00008; color: #ffffff; border-left: 5px solid #37a000;">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Dashboard
                        </a>
                    </div>
                    @endif
                    <div>
            			<a href="{{url('logout')}}" title="Password &amp; Security">
                            <i class="oIconLock oIconSmall oIconLight oLeftNavIconSmall"></i>
                            Logout
                        </a>
                    </div>
                    @endif
        		</div>
            </div>
            
            <script type="text/javascript">
            	$(document).ready(function() {
					$('.ctabsleft a.ltab').click(function(e){
						$('.ltab').removeClass('isCurrent');
						$(this).addClass('isCurrent');
					});
				});
            </script>