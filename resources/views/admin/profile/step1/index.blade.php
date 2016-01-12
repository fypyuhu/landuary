@extends('masterProfile')
@section('content')
<!-- Main Content -->
<section class="content-wrap" id="customers" style="margin-left:0; width: 1000px; margin:0 auto; padding:0; background:#ffffff; margin-top:25px; margin-bottom:25px;">
    @include('admin.profile.steps')
    <div class="row starter" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
    	<h4>Items Master List</h4>
        <ul class="custom-list-style pull-left">
            <li>Add the list of all your items to the item master list.</li>
            <li>Add item weights.</li>
            <li>Add item tracking type and item number.</li>
        </ul>
        <div class="pull-right" style="margin-top:-30px;">
        	<img src="{{URL::asset('images/items.jpg')}}" alt="" width="300" />
        </div>
        <!--<div class="row">
        	<button onclick="$(this).parents('.starter').css('display', 'none'); $('#taxes-div').fadeIn('slow');" class="waves-effect btn">Next</button>
        </div>-->
    </div>
    <div class="row" style="border: 1px solid #d0cece; background:#f5f5f5; padding:30px;">
        <a data-mode="ajax" href="/admin/items/create" class="waves-effect btn create-clone-button">Add Item</a>
        <div class="row no-rightmargin">
            <div class="col s12">
                <fieldset>
                    <legend>Items:</legend>
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
        	<div class="pull-right"><a href="/admin/profile/step2" class="waves-effect btn">Next Step</a></div>
        </div>
    </div>
</section>
<!-- End Main Content -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{url('admin/profile/items-show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'name'},
                        {name: 'item_number'},
                        {name: 'weight'},
                        {name: 'transaction_type'},
                        {name: 'actions'},
                        {name:'status' }
                        
                    ],
                    id: 'id',
                    url: url,
                    root: 'data'
                };
        var rowRenderer = function (row, column, value, defaultHtml, columnSettings, rowData) {
            if(rowData.status==="1"){
                    var element = $(defaultHtml);
                    element.css({ 'font-weight': 'bold'});
                    return element[0].outerHTML;
                }
            else if(column==="name" && rowData.status==="0"){
                 var element = $(defaultHtml);
                    element.css({ 'margin-left': '20px'});
                    return element[0].outerHTML;
            }    
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
                        {text: 'Name', width:'30%',dataField: 'name', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Number', width:'15%' ,dataField: 'item_number', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Weight lb/kg', width:'15%', dataField: 'weight', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Tracking Type', width:'20%', dataField: 'transaction_type', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Actions', width:'20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });
</script>
@endsection