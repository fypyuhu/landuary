@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9">
                <h1>Manage Items</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Manage Customers</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <a data-mode="ajax" href="/admin/customers/create" class="waves-effect btn create-clone-button">Add Customer</a>
    <div class="row no-rightmargin">
        <div class="col s9">
            <fieldset>
                <legend>Customer List:</legend>
                <div class="row box">
                    <div id="jqxgrid"></div>
                </div>
                <div class="row">
                    <div class="pull-right">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'xls', 'items');" src="{{URL::asset('images/xls_icon.png')}}" alt="Export to XLS">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'pdf', 'items');" src="{{URL::asset('images/pdf_icon.png')}}" alt="Export to PDF">
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

</section>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {



        var url = "{{url('admin/customers/show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'name'},
                        {name: 'number'},
                        {name: 'phone'},
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
                        {text: 'Name', width:'30%',dataField: 'name'},
                        {text: 'Customer Number', width:'25%' ,dataField: 'number'},
                        {text: 'Phone', width:'25%', dataField: 'phone'},
                        {text: 'Actions', width:'20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>

@endsection