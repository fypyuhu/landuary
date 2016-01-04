@extends('masterProduction')
@section('content')
<!-- Main Content -->
<section class="content-wrap">

    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9">
                <h1>Today's Report</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='/production/machine/report'>Today's Report</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <div class="row no-rightmargin" id="wash-report">
        <div class="row">
            <div class="col s9">
                <fieldset>
                  <legend>Report:</legend>
                  <div class="row"><div class="pull-right" style="font-size:16px; font-weight: bold;"><?php echo date('d F, Y'); ?></div></div>
                  <div class="row box">
                  	  <div class="row" style="margin-bottom:20px; margin-top:0">
                      	<form method="post" action="/production/machine/search">
                        	{{csrf_field()}}
                            <div class="col m6 s12" style="margin-top:0">
                                <div class="row" style="margin-top:0">
                                    <div class="col m6 s12">
                                        <label>Select Machine:</label>
                                        <select name="machine" id="machine" class="dropdown">
                                            <option value="">All</option>
                                            <option value="Machine A">Machine A</option>
                                            <option value="Machine B">Machine B</option>
                                            <option value="Machine C">Machine C</option>
                                        </select>
                                    </div>
                                    <div class="col m6 s12">&nbsp;</div>
                                </div>
                                
                                <div class="row">
                                	<div class="col m6 s12">
                                        <label>Select Date:</label>
                                        <select name="selectrange" id="selectrange" class="dropdown">
                                            <option value="Today">Today</option>
                                            <option value="Last 7 Days">Last 7 Days</option>
                                            <option value="Last Month">Last Month</option>
                                        </select>
                                    </div>
                                    <div class="col m6 s12" style="text-align:right; line-height:65px;">
                                    	<input type="checkbox" id="show-date-range"><label for="show-date-range">Custom Date Range</label>
                                    </div>
                                </div>
                                
                                <div class="row" id="date-range" style="display:none;">
                                    <div class="col m6 s12">
                                        <label>Date From:</label>
                                        <div name="from_date" id="from_date" class="datepicker"></div>
                                    </div>
                                    <div class="col m6 s12">
                                        <label>Date To:</label>
                                        <div name="to_date" id="to_date" class="datepicker"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <button type="submit" class="waves-effect btn" onclick="$('#jqxgrid').jqxGrid('updatebounddata');">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                      </div>
                      
                      @if($link <= 0)
                          @if(!isset($machine) || (isset($machine) && $machine == ''))
                              <div class="row layout_table no-topmargin">
                                <div class="row heading">
                                    <div class="col s3">Machine Name</div>
                                    <div class="col s3">State</div>
                                    <div class="col s3">Total Runtime</div>
                                    <div class="col s3">Weight Processed</div>
                                </div>
                                <div class="row records_list">
                                    <div class="col s3">Machine A</div>
                                    <div class="col s3"><a href="/production/machine/machine-detail" target="_blank" class="machine-busy">Active</a></div>
                                    <div class="col s3"><a href="/production/machine/search-link">12 Hours</a></div>
                                    <div class="col s3" style="font-weight:bold;">100 lbs</div>
                                </div>
                                <div class="row records_list">
                                    <div class="col s3">Machine B</div>
                                    <div class="col s3"><a href="/production/machine/machine-detail" target="_blank" class="machine-idle">Idle</a></div>
                                    <div class="col s3"><a href="/production/machine/search-link">12 Hours</a></div>
                                    <div class="col s3" style="font-weight:bold;">100 lbs</div>
                                </div>
                              </div>
                          @else
                              <div class="row layout_table no-topmargin">
                                <div class="row heading">
                                    <div class="col s2">Machine Name</div>
                                    <div class="col s2">State</div>
                                    <div class="col s2">Start Time</div>
                                    <div class="col s2">Stop Time</div>
                                    <div class="col s2">Total Runtime</div>
                                    <div class="col s2">Weight Processed</div>
                                </div>
                                <div class="row records_list">
                                    <div class="col s2">Machine A</div>
                                    <div class="col s2"><a href="/production/machine/machine-detail" target="_blank" class="machine-busy">Active</a></div>
                                    <div class="col s2">04:30 PM</div>
                                    <div class="col s2">05:30 PM</div>
                                    <div class="col s2"><a href="/production/machine/search-link">12 Hours</a></div>
                                    <div class="col s2" style="font-weight:bold;">100 lbs</div>
                                </div>
                                <div class="row records_list">
                                    <div class="col s2">Machine A</div>
                                    <div class="col s2"><a href="/production/machine/machine-detail" target="_blank" class="machine-busy">Active</a></div>
                                    <div class="col s2">04:30 PM</div>
                                    <div class="col s2">05:30 PM</div>
                                    <div class="col s2"><a href="/production/machine/search-link">12 Hours</a></div>
                                    <div class="col s2" style="font-weight:bold;">100 lbs</div>
                                </div>
                              </div>
                          @endif
                      @else
                          <div class="row layout_table no-topmargin">
                            <div class="row heading">
                                <div class="col s2">Machine Name</div>
                                <div class="col s2">State</div>
                                <div class="col s2">Start Time</div>
                                <div class="col s2">Stop Time</div>
                                <div class="col s2">Total Runtime</div>
                                <div class="col s2">Weight Processed</div>
                            </div>
                            <div class="row records_list">
                                <div class="col s2">Machine A</div>
                                <div class="col s2"><a href="/production/machine/machine-detail" target="_blank" class="machine-busy">Active</a></div>
                                <div class="col s2">04:30 PM</div>
                                <div class="col s2">05:30 PM</div>
                                <div class="col s2"><a href="/production/machine/search-link">12 Hours</a></div>
                                <div class="col s2" style="font-weight:bold;">100 lbs</div>
                            </div>
                            <div class="row records_list">
                                <div class="col s2">Machine A</div>
                                <div class="col s2"><a href="/production/machine/machine-detail" target="_blank" class="machine-busy">Active</a></div>
                                <div class="col s2">04:30 PM</div>
                                <div class="col s2">05:30 PM</div>
                                <div class="col s2"><a href="/production/machine/search-link">12 Hours</a></div>
                                <div class="col s2" style="font-weight:bold;">100 lbs</div>
                            </div>
                          </div>
                      @endif
                  </div>
                </fieldset>
            </div>
        </div>
    </div>

</section>
<!-- /Main Content -->
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(e){
		$(".dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: false});
		$(".datepicker").jqxDateTimeInput({width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
		
		$('#show-date-range').click(function(e){
			if($(this).is(':checked'))
				$('#date-range').slideDown('slow');
			else
				$('#date-range').slideUp('slow');
		});
	});
</script>
@endsection