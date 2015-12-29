@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Income Report</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Income Report</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="row no-rightmargin" id="adjustment">
        <div class="col s12">
            <fieldset>
                <legend>Income Report:</legend>
                <div class="row">
                    <div class="col m6 s12">
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Select Customer:</label>
                                <select name="customer" id="customer" class="dropdown">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Date Paid From:</label>
                                <div name="from_date" id="from_date"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>Due Paid To:</label>
                                <div name="to_date" id="to_date" class="datepicker"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <button type="button" class="waves-effect btn" onclick="$('#jqxgrid').jqxGrid('updatebounddata');">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box">
                    <div id="jqxgrid"></div>
                </div>
            </fieldset>
        </div>
    </div>
</section>

<!-- /Main Content -->
@endsection

@section('js')

<script>
    $(document).ready(function () {
        var oneWeekAgo = new Date();
        oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
        $('#from_date').jqxDateTimeInput({value: new Date(oneWeekAgo), width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
        $(".dropdown").jqxComboBox({width: '100%', autoDropDownHeight: true});
        $(".datepicker").jqxDateTimeInput({width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'invoice_number'},
                        {name: 'customer'},
                        {name: 'total_price'}

                    ],
                    cache: false,
                    url: '/admin/invoices/show-list',
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
                    name: $('#customer').val(),
                    from_date: $("#from_date").val(),
                    to_date: $("#to_date").val()
                });
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
                    showstatusbar: true,
                    statusbarheight: 20,
                    virtualmode: true,
                    selectionmode: "none",
                    showfiltermenuitems: false,
                    showaggregates: true,
                    rendergridrows: function (obj)
                    {
                        return obj.data;
                    },
                    columns: [
                        {text: 'Invoice Number', width: '30%', dataField: 'invoice_number'},
                        {text: 'Customer', width: '40%', dataField: 'customer'},
                        {text: 'Income', width: '30%', dataField: 'total_price',aggregates: ['sum']}
                    ]
                });
        

    });
</script>
@endsection