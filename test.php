<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="styles/jqx.classic.css" type="text/css" />
    <script type="text/javascript" src="public/jqwidgets/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="public/jqwidgets/jqxgrid.selection.js"></script>	
    <script type="text/javascript" src="public/jqwidgets/jqxdata.js"></script>	
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var theme = 'classic';
        
            var source =
            {
                 datatype: "json",
                 datafields: [
					 { name: 'id'},
					 { name: 'manifest_number'},
					 { name: 'customer_id'},
					 { name: 'department_id'},
					 { name: 'outgoing_cart_id'},
					 { name: 'shipping_date'}
                ],
			    url: 'test-data.php',
				root: 'Rows',
				beforeprocessing: function(data)
				{		
					source.totalrecords = data[0].TotalRows;
				}
            };		
			
		    var dataadapter = new $.jqx.dataAdapter(source);

            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
            {
                width: 600,
                source: dataadapter,
                theme: theme,
			    autoheight: true,
				pageable: true,
				virtualmode: true,
				rendergridrows: function()
				{
					  return dataadapter.records;     
				},
                columns: [
                      { text: 'ID', datafield: 'id', width: 250 },
                      { text: 'Manifest Number', datafield: 'manifest_number', width: 200 },
                      { text: 'Customer ID', datafield: 'customer_id', width: 200 },
                      { text: 'Department ID', datafield: 'department_id', width: 180 },
                      { text: 'Outgoing Cart', datafield: 'outgoing_cart_id', width: 100 },
                      { text: 'Shipping Date', datafield: 'shipping_date', width: 140 }
                  ]
            });
        });
    </script>
</head>
<body class="default">
    <div id="jqxWidget">
        <div id="jqxgrid"></div>
    </div>
</body>
</html>