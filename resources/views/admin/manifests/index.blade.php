@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Manifests</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Manifests</a>
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
       <div class="col m10 s12">
           <div class="row">
              <ul class="ctabs">
                <li class="current" data-corr-div-id="#receiving-manifest-div">Receiving Manifests</li>
                <li data-corr-div-id="#shipping-manifest-div">Shipping Manifests</li>
              </ul>
           </div>
           <div class="row tab-content first no-topmargin" id="receiving-manifest-div">
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
                        <legend>Receiving Manifests:</legend>
                        <div class="row box">
                            <div id="jqxgrid1"></div>
                        </div>
                    </fieldset>
                </div>
            </div>
           <div class="row tab-content no-topmargin" id="shipping-manifest-div">
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
                        <legend>Shipping Manifests:</legend>
                        <div class="row box">
                            <div id="jqxgrid"></div>
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
		
        var url = "{{url('admin/manifests/show-shipping')}}";
// prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'id'},
                        {name: 'name'},
                        {name: 'date', type: 'date'},
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
                        {text: 'Manifest Number', width: '10%', dataField: 'id'},
                        {text: 'Customer Name', width: '45%', dataField: 'name',filtertype: 'checkedlist'},
                        {text: 'Shipping Date', width: '25%', dataField: 'date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Actions', width: '20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
                url = "{{url('admin/manifests/show-receiving')}}";
 source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'id'},
                        {name: 'name'},
                        {name: 'date', type: 'date'},
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
                        {text: 'Manifest Number', width: '10%', dataField: 'id'},
                        {text: 'Customer Name', width: '45%', dataField: 'name',filtertype: 'checkedlist'},
                        {text: 'Created On', width: '25%', dataField: 'date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Actions', width: '20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>
@endsection