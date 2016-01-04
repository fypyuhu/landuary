@extends('masterProduction')
@section('content')
<!-- Main Content -->
<section class="content-wrap">

    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9">
                <h1>Manage Machines</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='/production/machine'>Manage Machines</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->
    <a data-mode="ajax" href="/production/machine/create" class="waves-effect btn create-clone-button">Add Machine</a>
    <div class="row no-rightmargin">
        <div class="col s9">
            <fieldset>
                <legend>Machines List:</legend>
                <div class="row box">
                	<form id="search_form">
                	<div class="row" style="margin-bottom:15px;">
                      <div class="pull-left">
                          <label style="font-size:12px;">Search by Machine Name or Machine Number</label>
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
		
		var url = "{{url('production/machine/show')}}";
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
                        {name: 'machine_name'},
                        {name: 'machine_number'},
                        {name: 'machine_description'},
                        {name: 'machine_capacity'},
						{name: 'machine_image'},
                        {name: 'actions'},
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
                        {text: 'Name', width:'17%',dataField: 'machine_name', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Number', width:'17%' ,dataField: 'machine_number', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Description', width:'17%', dataField: 'machine_description', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Capacity', width:'17%', dataField: 'machine_capacity', sortable: false,cellsrenderer: rowRenderer},
						{text: 'Image', width:'17%', dataField: 'machine_image', sortable: false,cellsrenderer: rowRenderer},
                        {text: 'Actions', width:'15%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
	}
</script>

@endsection