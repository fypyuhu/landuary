@extends('masterProfile')
@section('content')
<!-- Main Content -->

<div id="clone-container" class="hidden">
    <div class="row records_list">
        <div class="col m4 s12">
            <label>Component name</label>
            <div class="input-field">
                <input type="text" name="component_name[]" />
            </div>
        </div>
        <div class="col m4 s12">
            <label>Agency name</label>
            <div class="input-field">
                <input type="text" name="component_agency_name[]" />
            </div>
        </div>
        <div class="col m3 s12">
            <label>Rate</label>
            <div class="input-field">
                <input type="text" name="component_tax_rate[]" />
            </div>
        </div>
        <div class="col m1 s12" style="padding-top:26px;">
            <a href="javascript:void(0);" onclick="$(this).parent().parent().remove();" class="waves-effect btn">X</a>
        </div>
    </div>
</div>

<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    @include('admin.profile.steps')
    <!--<div class="row starter" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<h4>Tax Master List</h4>
        <ul class="custom-list-style pull-left">
            <li>Add the list of all your taxes to the tax master list.</li>
            <li>Add single or multiple tax rates.</li>
            <li>Add item tracking type, item number.</li>
        </ul>
        <div class="pull-right" style="margin-top:-30px;">
            <img src="{{URL::asset('images/tax.jpg')}}" alt="" width="300" />
        </div>
    </div>-->
    <div class="row" id="taxes-div" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<div class="row starter" style="margin-bottom: 30px;">
            <h4>Tax Master List</h4>
            <ul class="custom-list-style pull-left">
                <li>Add the list of all your taxes to the tax master list.</li>
                <li>Add single or multiple tax rates.</li>
                <li>Add item tracking type, item number.</li>
            </ul>
        </div>
    
        <a data-mode="ajax" href="/admin/taxes/create" class="waves-effect btn create-clone-button">Add Tax</a>
        <div class="row no-rightmargin">
            <div class="col s12">
                <fieldset>
                    <legend>Tax:</legend>
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
        	<div class="pull-left"><a href="/admin/profile/step1" class="waves-effect btn">Previous Step</a></div>
        	<div class="pull-right"><a href="/admin/profile/step3" class="waves-effect btn">Next Step</a></div>
        </div>
    </div>
</section>
<!-- End Main Content -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{url('admin/profile/taxes-show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
						{name: 'tax_type'},
                        {name: 'tax_name'},
						{name: 'component_name'},
                        {name: 'agency_name'},
                        {name: 'tax_rate'},
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
						{text: 'Tax Type', dataField: 'tax_type', sortable:false},
                        {text: 'Tax Name', dataField: 'tax_name', sortable:false},
						{text: 'Component Name', dataField: 'component_name', sortable:false},
                        {text: 'Agency Name', dataField: 'agency_name', sortable:false},
                        {text: 'Tax Rate', dataField: 'tax_rate', sortable:false},
                        {text: 'Actions', cellsalign: 'center', dataField: 'actions',sortable:false,filterable:false,exportable:false}
                    ]
                });
    });
</script>
@endsection