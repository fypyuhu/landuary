@extends('masterProfile')
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    @include('admin.profile.steps')
    <div class="row starter" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<h4>Lorem ipusm dolle sit</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="row">
        	<button onclick="$(this).parents('.starter').css('display', 'none'); $('#taxes-div').fadeIn('slow');" class="waves-effect btn">Next</button>
        </div>
    </div>
    <div class="row" id="taxes-div" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px; display:none;">
        <a data-mode="ajax" href="/admin/customers/create" class="waves-effect btn create-clone-button">Add Tax</a>
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
        	<a href="/admin/profile/step2" class="waves-effect btn">Next Step</a>
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