@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Rewash</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Rewash</a>
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
       <div class="row tab-content first no-topmargin" id="incoming-carts-div">
            <div class="row no-topmargin" style="margin-bottom:25px;">
                <div class="col m6 s12">
                    <div class="row">
                        <label>Select Customer:</label>
                        <select name="i_customer" id="i_customer">
                            <option value="-1">Please Select</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>From:</label>
                            <div id="i_date_from" name="i_date_from" class="r_calendar"></div>
                        </div>
                        <div class="col m6 s12">
                            <label>To:</label>
                            <div id="i_date_to" name="i_date_to" class="calendar"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <button type="button" onclick="$('#jqxgrid').jqxGrid('updatebounddata');" class="waves-effect btn">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col m7 s12">
                    <fieldset>
                        <legend>Rewash:</legend>
                        <div class="row box">
                            <div id="jqxgrid"></div>
                        </div>
                    </fieldset>
                </div>
                <div class="col m5 s12">
                    <!--<select id="format-select">
                      <option value="">none</option>
                      <option value="decimal" selected>decimal</option>
                      <option value="scientific">scientific</option>
                      <option value="percent">percent</option>
                      <option value="currency">currency</option>
                      <option value="short">short</option>
                      <option value="long">long</option>
                    </select>-->
                    <div id="chart_div"></div>
                </div>
            </div>
       </div>
    </div>

</section>

<!-- /Main Content -->
@endsection

@section('js')
<script type="text/javascript">
	
	google.load('visualization', '1', {'packages':['corechart']});
	google.setOnLoadCallback(drawChart);
	
	function drawChart() {
      var jsonData = $.ajax({
          url: "/admin/rewash/json",
		  type: 'GET',
		  data: {name: $('#i_customer').val(), start_date: $("#i_date_from").val(), end_date: $("#i_date_to").val()},
          dataType: "json",
          async: false
          }).responseText;
		  
		  $('#chart_div').html(jsonData);
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(JSON.parse(jsonData.replace(/&quot;/g,'"')));
	
	  var options = {
		   title: "",
		   width: 450,
		   height: 300,
		   legend: 'none',
		   bar: {groupWidth: '10%'},
		   vAxis: { gridlines: { count: 4 } }
		 };
	  
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    $(document).ready(function (e) {
        var oneWeekAgo = new Date();
        oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
        $("#i_customer, #format-select").jqxComboBox({width: '100%', autoDropDownHeight: true});
        $(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
        $(".r_calendar").jqxDateTimeInput({value: new Date(oneWeekAgo), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
        var url = "{{url('admin/rewash/list-show')}}";
// prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'rewash_date', type: 'date'},
						{name: 'customer_name'},
                        {name: 'customer_number'},
                        {name: 'department_name'},
                        {name: 'number_of_items'},
                        {name: 'total_weight'},
                        {name: 'actions'}

                    ],
                    cache: false,
                    url: url,
                    filter: function ()
                    {
                        // update the grid and send a request to the server.
                        $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    root: 'data',
                    beforeprocessing: function (data)
                    {
                        if (data != null)
                        {
                            source.totalrecords = data.TotalRows;
                        }
                    }
                };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadError: function (xhr, status, error)
            {
                alert(error);
            },
            formatData: function (data) {
                $.extend(data, {
                    name: $('#i_customer').val(),
                    start_date: $("#i_date_from").val(),
                    end_date: $("#i_date_to").val()
                });
				drawChart();
                return data;
            }
        });
        $("#jqxgrid").jqxGrid(
                {
                    width: "100%",
                    source: dataAdapter,
                    filterable: true,
                    sortable: false,
                    autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    showfiltermenuitems: false,
                    rendergridrows: function (obj)
                    {
                        return obj.data;
                    },
                    columns: [
                        {text: 'Rewash Date', width: '14%', dataField: 'rewash_date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
						{text: 'Customer Name', width: '14%', dataField: 'customer_name', filtertype: 'checkedlist'},
                        {text: 'Customer Number', width: '14%', dataField: 'customer_number', filtertype: 'checkedlist'},
                        {text: 'Dept', width: '14%', dataField: 'department_name', filtertype: 'checkedlist'},
                        {text: 'No. of Items', width: '14%', dataField: 'number_of_items', filtertype: 'checkedlist'},
                        {text: 'Total Weight', width: '14%', dataField: 'total_weight', filtertype: 'checkedlist'},
                        {text: 'Actions', width: '16%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
			
		
	});
	
</script>
@endsection