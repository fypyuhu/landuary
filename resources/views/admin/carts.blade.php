@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Manage Carts</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Manage Carts</a>
            </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
	<a id="inline" href="#add-record" class="waves-effect btn create-clone-button">Add Cart</a>
    <div class="row no-rightmargin">
    	<div class="col s12" style="display: none;">
          <fieldset id="add-record" style="width: 500px;">
            <legend>Add Cart:</legend>
            <form method="post" action="{{url('admin/carts/create')}}" id="pageForm">
              {{csrf_field()}}
              <div class="row">
              	<input type="checkbox" name="chkbx_enb_cus_num" id="chkbx_enb_cus_num">
                <label for="chkbx_enb_cus_num">Use Custom Cart Number</label>
              </div>
              <div class="row">
                <div class="col s6">
                    <label>Cart Number:</label>
                    <div class="input-field">
                      <input id="number" type="text" name="cart_number" readonly="readonly" value="{{ $get_max_number }}">
                    </div>
                    <label for="cart_number" class="error" id="error-cart-number"></label>
                </div>
              </div>
              
              <div class="row">
                <ul class="ctabs">
                    <li class="current" data-corr-div-id="#cart-tab">Carts</li>
                </ul>
              </div>
              
              <div class="row tab-content no-topmargin first" id="cart-tab">
                  <fieldset style="margin-top:15px;">
                      <legend>Carts</legend>
                      <div class="row">
                        <div class="col s12">
                          <input type="checkbox" value="1" name="use_as_exchange_cart" id="use_as_exchange_cart" class="checkbox" data-corr-div-id="#cart-status-div">
                          <label for="use_as_exchange_cart">Use this as Exchange Cart</label>
                        </div>
                      </div>
                      <div class="row">
                        <label>Cart Tare Weight:</label>
                        <div class="input-field">
                            <input id="tare_weight" type="text" name="tare_weight">
                        </div>
                        <label for="tare_weight" class="error" id="error-tare-weight"></label>
                      </div>
                      <div class="row">
                        <label>Cart Status:</label>
                        <div class="input-field">
                          <select name="status" id="status">
                            <option value="">Please Select</option>
                            <option value="In" selected="selected">In</option>
                            <option value="Out">Out</option>
                            <option value="Ready">Ready</option>
                          </select>
                        </div>
                        <label for="status" class="error" id="error-status"></label>
                      </div>
                      <div id="cart-status-div" style="display: none">
                          <div class="row">
                            <label>Cart Current Location:</label>
                            <div class="input-field">
                                <input id="cart_current_location" type="text" name="cart_current_location" value="In House" readonly="readonly">
                            </div>
                            <label for="cart_current_location" class="error" id="error-cart-current-location"></label>
                          </div>
                          <div class="row">
                            <label>Customer Number:</label>
                            <div class="input-field">
                              <select name="customer_number" id="customer_number">
                                <option value="">Please Select</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                              </select>
                            </div>
                            <label for="customer_number" class="error" id="error-customer-number"></label>
                          </div>
                      </div>
                  </fieldset>
              </div>
              <div class="row">
                <button class="waves-effect btn">Save</button>
                <button class="waves-effect btn">Clear</button>
              </div>
          </form>
          </fieldset>
        </div>
        <div class="col s9">
          <fieldset>
              <legend>Carts List:</legend>
              <div class="row box">
                  <div id="jqxgrid"></div>
              </div>
          </fieldset>
        </div>
    </div>

  </section>
<!-- /Main Content -->
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function () {
		$("#status").jqxComboBox({width: '100%', autoDropDownHeight: true, disabled: true});
        $("#customer_number").jqxComboBox({width: '100%', autoDropDownHeight: true});
		
		$("#pageForm").validate({
            rules: {
                cart_number: "required",
                tare_weight: "required",
                status: "required",
                cart_current_location: { required:"#use_as_exchange_cart:checked" },
                customer_number: { required:"#use_as_exchange_cart:checked" }
            },
            submitHandler: function (form) {
                var options = {
                    success: showResponse
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                $(form).ajaxSubmit(options);
            }
        });
		
		var url = "{{url('admin/carts/show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'cart_number'},
                        {name: 'tare_weight'},
                        {name: 'status'},
                        {name: 'use_as_exchange_cart'},
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
                        {text: 'Number', dataField: 'cart_number', sortable:false},
                        {text: 'Tare Weight lb/kg', dataField: 'tare_weight', sortable:false},
                        {text: 'Status', dataField: 'status', sortable:false},
                        {text: 'Exchange Cart', dataField: 'use_as_exchange_cart', sortable:false},
                        {text: 'Actions', cellsalign: 'center', dataField: 'actions',sortable:false,filterable:false,exportable:false}
                    ]
                });
	});
</script>

@endsection