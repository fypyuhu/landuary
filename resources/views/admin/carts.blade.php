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
    <a data-mode="ajax" href="/admin/carts/create" class="waves-effect btn create-clone-button">Add Cart</a>
    <div class="row no-rightmargin">
        <div class="col s9">
            <fieldset>
                <legend>Carts List:</legend>
                <div class="row box">
                    <div id="jqxgrid"></div>
                </div>
                <div class="row">
                	<div class="pull-right">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'xls', 'carts');" src="{{URL::asset('images/xls_icon.png')}}" alt="Export to XLS">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'pdf', 'carts');" src="{{URL::asset('images/pdf_icon.png')}}" alt="Export to PDF">
                    </div>
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
                        {text: 'Number', dataField: 'cart_number'},
                        {text: 'Tare Weight lb/kg', dataField: 'tare_weight'},
                        {text: 'Status', dataField: 'status'},
                        {text: 'Exchange Cart', dataField: 'use_as_exchange_cart'},
                        {text: 'Actions', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>

@endsection