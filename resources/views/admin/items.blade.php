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

                    <li><a href='dashboard.html'>Manage Items</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <a data-mode="ajax" href="/admin/items/create" class="waves-effect btn create-clone-button">Add Item</a>
    <div class="row no-rightmargin">
        <div class="col s9">
            <fieldset>
                <legend>Items List:</legend>
                <div class="row box">
                	<form id="search_form">
                	<div class="row" style="margin-bottom:15px;">
                      <div class="pull-left">
                          <label style="font-size:12px;">Search by Item Name or Item Number</label>
                          <div class="input-field">
                            <input id="search_string" type="text" name="search_string">
                          </div>
                          <label for="search_string" class="error"></label>
                      </div>
                      <div class="pull-left" style="padding-top:19px; padding-left:10px;">
 						  <button type="submit" class="waves-effect btn">Search</button>                  
                      </div>
                    </div>
                    </form>
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
<!-- /Main Content -->
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function () {
		/*$("#search_form").validate({
            rules: {
                search_string: "required"
            }
        });*/
		
		var url = "{{url('admin/items/show')}}";
		$("#search_form").submit(function(e){
			e.preventDefault();
			if($('#search_string').val() != '') {
				var querystring = '?search_string='+$('#search_string').val();
				loadTable(url+querystring);
			} else {
				loadTable(url);
			}
		});
		loadTable(url);
    });
	
	function loadTable(url) {
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
	}
</script>

@endsection