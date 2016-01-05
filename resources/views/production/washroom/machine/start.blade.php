<div class="field-set">
<fieldset>
                    <legend>Start Machine:</legend>
                    <div class="row alert alert-success" style="display:none;"></div>
                    <form method="POST" action="{{url('production/washroom/machine-detail')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col m4 s12">
                                <label style="font-size:12px;">Machine:</label>
                                <ul class="thumbs row set-machine" data-thumbs-set=".set-machine">
                                	<li class="col m4 s6"><img src="{{URL::asset('images/machine1.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine2.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine3.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine4.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine1.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine3.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine2.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine4.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine4.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine3.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine2.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/machine1.jpg')}}" alt="Machine 1" title="Machine 1" width="100%" /></li>
                                </ul>
                                <div style="display:none;">
                                    <select name="machine" id="machine" class="dropdown-org">
                                        <option value="">Please Select</option>
                                        <option value="Machine A">Machine A</option>
                                        <option value="Machine B">Machine B</option>
                                        <option value="Machine C">Machine C</option>
                                        <option value="Machine D">Machine D</option>
                                    </select>
                                </div>
                                <label for="machine" class="error"></label>
                            </div>
                            
                            <div class="col m4 s12">
                                <label style="font-size:12px;">Client:</label>
                                <ul class="thumbs row set-client" data-thumbs-set=".set-client">
                                	<li class="col m4 s6"><img src="{{URL::asset('images/c1.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c2.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c3.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c4.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c3.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c4.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c1.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c2.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c4.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c3.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c2.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                    <li class="col m4 s6"><img src="{{URL::asset('images/c1.jpg')}}" alt="Client 1" title="Client 1" width="100%" /></li>
                                </ul>
                                <div style="display:none;">
                                    <select name="client" id="client" class="dropdown-org">
                                        <option value="">Please Select</option>
                                        <option value="Client A">Client A</option>
                                        <option value="Client B">Client B</option>
                                        <option value="Client C">Client C</option>
                                        <option value="Client D">Client D</option>
                                    </select>
                                </div>
                                <label for="client" class="error"></label>
                            </div>

                            <div class="col m4 s12" style="background:#f1f6f9; padding:15px; padding-top: 0;">
                            	<div class="row">
                                	<label style="font-size:12px;">Rule:</label>
                                    <select name="rule" id="rule" class="dropdown-org">
                                        <option value="">Please Select</option>
                                        <option value="Rule A">Rule A</option>
                                        <option value="Rule B">Rule B</option>
                                        <option value="Rule C">Rule C</option>
                                        <option value="Rule D">Rule D</option>
                                    </select>
                                    <label for="rule" class="error"></label>
                                </div>
                                <div class="row">
                                	<label style="font-size:12px;">Item:</label>
                                    <select name="item" id="item" class="dropdown-org">
                                        <option value="">Please Select</option>
                                        <option value="Item A">Item A</option>
                                        <option value="Item B">Item B</option>
                                        <option value="Item C">Item C</option>
                                        <option value="Item D">Item D</option>
                                    </select>
                                    <label for="item" class="error"></label>
                                </div>
                            </div>
						</div>
                        <div class="row">
                            <!--<button type="submit" class="waves-effect btn" style="background:#2b8f2d;">Start Machine</button>-->
                            <a href="{{url('production/washroom/machine-detail')}}" class="waves-effect btn" style="background:#2b8f2d;">Start Machine</a>
                        </div>
                    </form>
                </fieldset>
<script>
     $(document).ready(function () {
	 	//$(".dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: false});
		
        /*$("#pageForm").validate({
            rules: {
                machine: "required",
                rule: "required",
                client: "required",
                item: "required",
            }
        });*/
		
		$('.thumbs').find('img').click(function(e){
			var thumbs_set = $(this).parent().parent().data('thumbs-set');
			$(thumbs_set).find('img').removeClass('current');
			$(this).addClass('current');
		});
    });
</script>
</div>