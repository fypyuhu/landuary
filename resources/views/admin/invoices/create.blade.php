@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Create Invoice</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Create Invoice</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
	
    @if (session('status'))
        <div class="row">
            <div class="col m5 s12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        </div>
        <a href="/admin/invoices/receipt/{{$rec_id}}" id="newtab_link" target="_blank" style="display:none;">Link</a>
    @endif
    
    <div id="shipmant" class="row no-rightmargin">
        <form action="/admin/invoices/create" Method="POST">
            <div class="col s12 m5">
                <fieldset>
                    <legend>Create Invoice:</legend>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Name:</label>
                            <select name="customer" id="customer">
                                <option value="-1" selected="selected">Please select a customer</option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}" {{isset($current_customer) && $customer->id == $current_customer ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col m6 s12">
                            <label>Department:</label>
                            <select name="department" id="department" disabled="disabled">
                                <option value="" disabled selected>Select Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Number:</label>
                            <div class="input-field">
                                <input id="name" type="text" name="name" disabled="disabled" value="Auto Fill">
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <label>Invoice Date:</label>
                                <div id="ship_date" type="text" name="ship_date" class="calendar"></div>
                            
                        </div>
                    </div>

                </fieldset>
                
            </div>

            <div class="col s12 m7">
                <fieldset>
                    <legend>Select Manifests:</legend>
                    <div class="row box">
                        <div class="row layout_table no-topmargin">
                            <div class="row heading">
                                <div class="col s1 center-align chkbx">
                                    <input type="checkbox" name="manifest_list" id="manifest_list">
                                    <label for="use_departments"></label>
                                </div>
                                <div class="col s2">Manifest Number</div>
                                <div class="col s2">Number of Carts</div>
                                <div class="col s2">Department</div>
                                <div class="col s2 center-align">Shipment Date</div>
                                <div class="col s2 center-align">Actions</div>
                            </div>
                            <div class="row records_list">
                                <div class="col s12 center-align"><strong>No Manifest.</strong></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>

</section>

<!-- /Main Content -->

@endsection
@section('js')
<script type="text/javascript">
	$( window ).load(function() {
		@if (session('status'))
			$("#newtab_link")[0].click();
			
			if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val()!="-1") {
                $(".loading").css("display","block");
                $.ajax({
                    url: "/admin/invoices/details/" + $("#customer").val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display","none");
                });
            }
		@endif	
	});
	
    $(document).ready(function () {
        $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true,disabled:true});
        $("#ship_date").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px',formatString: 'MMMM dd, yyyy',disabled:true});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
         $('#customer').on('change', function () {
            if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val()!="-1") {
                $(".loading").css("display","block");
                $.ajax({
                    url: "/admin/invoices/details/" + $(this).val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display","none");
                });
            }
        });     
    });
    
</script>

@endsection
