@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Carts</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Carts</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
   <div class="row">
       <div class="row">
           <div class="row">
              <ul class="ctabs">
                <li class="current" data-corr-div-id="#incoming-carts-div">Incoming Carts</li>
                <li data-corr-div-id="#ready-carts-div">Ready Carts</li>
                <li data-corr-div-id="#outgoing-carts-div">Outgoing Carts</li>
              </ul>
           </div>
           <div class="row tab-content first no-topmargin" id="incoming-carts-div">
                <div class="row no-topmargin" style="margin-bottom:25px;">
                    <div class="col m6 s12">
                        <div class="row">
                            <label>Select Customer:</label>
                            <select name="r_customer" id="r_customer">
                                <option value="">Please Select</option>
                                <option value="1">Customer A</option>
                                <option value="2">Customer B</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>From:</label>
                                <div id="r_date_from" name="r_date_from" class="calendar"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>To:</label>
                                <div id="r_date_to" name="r_date_to" class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <button type="submit" class="waves-effect btn">Filter</button>
                                <button type="reset" class="waves-effect btn">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <fieldset>
                        <legend>Incoming Carts:</legend>
                        <div class="row box">
                            <div id="jqxgrid"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
           <div class="row tab-content first no-topmargin" id="ready-carts-div">
                <div class="row no-topmargin" style="margin-bottom:25px;">
                    <div class="col m6 s12">
                        <div class="row">
                            <label>Select Customer:</label>
                            <select name="r_customer" id="r_customer">
                                <option value="">Please Select</option>
                                <option value="1">Customer A</option>
                                <option value="2">Customer B</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>From:</label>
                                <div id="r_date_from" name="r_date_from" class="calendar"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>To:</label>
                                <div id="r_date_to" name="r_date_to" class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <button type="submit" class="waves-effect btn">Filter</button>
                                <button type="reset" class="waves-effect btn">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <fieldset>
                        <legend>Ready Carts:</legend>
                        <div class="row box">
                            <div id="jqxgrid2"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
           <div class="row tab-content no-topmargin" id="outgoing-carts-div">
                <div class="row no-topmargin" style="margin-bottom:25px;">
                    <div class="col m6 s12">
                        <div class="row">
                            <label>Select Customer:</label>
                            <select name="s_customer" id="s_customer">
                                <option value="">Please Select</option>
                                <option value="1">Customer A</option>
                                <option value="2">Customer B</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>From:</label>
                                <div id="s_date_from" name="s_date_from" class="calendar"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>To:</label>
                                <div id="s_date_to" name="s_date_to" class="calendar"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <button type="submit" class="waves-effect btn">Filter</button>
                                <button type="reset" class="waves-effect btn">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <fieldset>
                        <legend>Outgoing Carts:</legend>
                        <div class="row box">
                            <div id="jqxgrid1"></div>
                        </div>
                    </fieldset>
                </div>
           </div>
       </div>
   </div>
    
</section>

<!-- /Main Content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function (e) {
	    $("#r_customer, #s_customer").jqxComboBox({width: '100%', autoDropDownHeight: true});
		$("#r_date_from, #r_date_to, #s_date_from, #s_date_to").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy' });
		
		var url = "{{url('admin/carts-list/show-incoming')}}";
// prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'incoming_cart_id'},
                        {name: 'receiving_date', type: 'date'},
                        {name: 'customer_number'},
						{name: 'department_name'},
						{name: 'number_of_items'},
						{name: 'net_weight'},
						{name: 'gross_weight'},
						{name: 'invoiced'},
                        {name: 'actions'}

                    ],
                    id: 'id',
                    url: url,
                    root: 'data'
                };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
                {
                    width: "100%",
                    source: dataAdapter,
                    pageable: true,
                    autoheight: true,
                    sortable: true,
                    filterable: true,
                    columns: [
                        {text: 'Cart Number', width: '11%', dataField: 'incoming_cart_id'},
						{text: 'Tran. Date', width: '12%', dataField: 'receiving_date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Customer Number', width: '11%', dataField: 'customer_number',filtertype: 'checkedlist'},
						{text: 'Dept', width: '11%', dataField: 'department_name',filtertype: 'checkedlist'},
						{text: 'No. of Items', width: '11%', dataField: 'number_of_items',filtertype: 'checkedlist'},
						{text: 'Gross Weight lb/kg', width: '11%', dataField: 'net_weight',filtertype: 'checkedlist'},
						{text: 'Net Weight lb/kg', width: '11%', dataField: 'gross_weight',filtertype: 'checkedlist'},
						{text: 'Invoiced', width: '11%', dataField: 'invoiced',filtertype: 'checkedlist'},
                        {text: 'Actions', width: '11%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
				
				
				
                url = "{{url('admin/carts-list/show-outgoing')}}";
 source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'outgoing_cart_id'},
                        {name: 'shipping_date', type: 'date'},
                        {name: 'customer_number'},
						{name: 'department_name'},
						{name: 'number_of_items'},
						{name: 'net_weight'},
						{name: 'gross_weight'},
						{name: 'status'},
						{name: 'is_exchange_cart'},
                        {name: 'actions'}

                    ],
                    id: 'id',
                    url: url,
                    root: 'data'
                };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid1").jqxGrid(
                {
                    width: "100%",
                    source: dataAdapter,
                    pageable: true,
                    autoheight: true,
                    sortable: true,
                    filterable: true,
                    columns: [
                        {text: 'Cart Number', width: '10%', dataField: 'outgoing_cart_id'},
						{text: 'Ship Date', width: '10%', dataField: 'shipping_date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Customer Number', width: '10%', dataField: 'customer_number',filtertype: 'checkedlist'},
						{text: 'Dept', width: '10%', dataField: 'department_name',filtertype: 'checkedlist'},
						{text: 'No. of Items', width: '10%', dataField: 'number_of_items',filtertype: 'checkedlist'},
						{text: 'Gross Weight lb/kg', width: '10%', dataField: 'net_weight',filtertype: 'checkedlist'},
						{text: 'Net Weight lb/kg', width: '10%', dataField: 'gross_weight',filtertype: 'checkedlist'},
						{text: 'Status', width: '10%', dataField: 'status',filtertype: 'checkedlist'},
						{text: 'Exchange Cart', width: '10%', dataField: 'is_exchange_cart',filtertype: 'checkedlist'},
                        {text: 'Actions', width: '10%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
                url = "{{url('admin/carts-list/show-ready')}}";
 source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'outgoing_cart_id'},
                        {name: 'shipping_date', type: 'date'},
                        {name: 'customer_number'},
						{name: 'department_name'},
						{name: 'number_of_items'},
						{name: 'net_weight'},
						{name: 'gross_weight'},
						{name: 'status'},
						{name: 'is_exchange_cart'},
                        {name: 'actions'}

                    ],
                    id: 'id',
                    url: url,
                    root: 'data'
                };

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid2").jqxGrid(
                {
                    width: "100%",
                    source: dataAdapter,
                    pageable: true,
                    autoheight: true,
                    sortable: true,
                    filterable: true,
                    columns: [
                        {text: 'Cart Number', width: '10%', dataField: 'outgoing_cart_id'},
						{text: 'Ship Date', width: '10%', dataField: 'shipping_date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Customer Number', width: '10%', dataField: 'customer_number',filtertype: 'checkedlist'},
						{text: 'Dept', width: '10%', dataField: 'department_name',filtertype: 'checkedlist'},
						{text: 'No. of Items', width: '10%', dataField: 'number_of_items',filtertype: 'checkedlist'},
						{text: 'Gross Weight lb/kg', width: '10%', dataField: 'net_weight',filtertype: 'checkedlist'},
						{text: 'Net Weight lb/kg', width: '10%', dataField: 'gross_weight',filtertype: 'checkedlist'},
						{text: 'Status', width: '10%', dataField: 'status',filtertype: 'checkedlist'},
						{text: 'Exchange Cart', width: '10%', dataField: 'is_exchange_cart',filtertype: 'checkedlist'},
                        {text: 'Actions', width: '10%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>
@endsection