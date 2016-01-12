@extends('masterProfile')
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    @include('admin.profile.steps')
    <div class="row starter" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<h4>Customers List</h4>
        <ul class="custom-list-style pull-left">
            <li>lorem ipsum</li>
            <li>lorem ipsum</li>
            <li>lorem ipsum</li>
        </ul>
        <div class="pull-right" style="margin-top:-30px;">
        	<img src="{{URL::asset('images/customer.jpg')}}" alt="" width="300" />
        </div>
        <!--<div class="row">
        	<button onclick="$(this).parents('.starter').css('display', 'none'); $('#taxes-div').fadeIn('slow');" class="waves-effect btn">Next</button>
        </div>-->
    </div>
    <div class="row" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
        <a data-mode="ajax" href="/admin/customers/create" class="waves-effect btn create-clone-button">Add Customer</a>
        <div class="row no-rightmargin">
            <div class="col s12">
                <fieldset>
                    <legend>Customers:</legend>
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
        <div class="row">
        	<div class="pull-left"><a href="/admin/profile/step2" class="waves-effect btn">Previous Step</a></div>
        	<div class="pull-right"><a href="/admin/profile/step4" class="waves-effect btn">Next Step</a></div>
        </div>
    </div>
</section>
<!-- End Main Content -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{url('admin/profile/customers-show')}}";
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