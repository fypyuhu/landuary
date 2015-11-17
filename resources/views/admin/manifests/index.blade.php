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
            <fieldset>
                <legend>Shipping Manifests:</legend>
                <div class="row box">
                    <div id="jqxgrid"></div>
                </div>
            </fieldset>
        </div>
        <div class="row">
            <fieldset>
                <legend>Receiving Manifests:</legend>
                <div class="row box">
                    <div id="jqxgrid1"></div>
                </div>
            </fieldset>
        </div>
    
</section>

<!-- /Main Content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function (e) {
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
                        {text: 'Shipping Date', width: '25%', dataField: 'date', filtertype: 'date', cellsformat: 'dd-MMMM-yyyy'},
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
                        {text: 'Created On', width: '25%', dataField: 'date', filtertype: 'date', cellsformat: 'dd-MMMM-yyyy'},
                        {text: 'Actions', width: '20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>
@endsection