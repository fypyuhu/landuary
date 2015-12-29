@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Invoices</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Invoices</a>
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
                <legend>Invoice(s):</legend>
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
                            <div class="col m6 s12" id="department_div" >
                                <label>Select Department:</label>
                                <select name="s_department" id="s_department" class="dropdown">
                                    <option value="-1">Please Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Status:</label>
                                <select name="status" id="status" class="dropdown">
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </div>
                            <div class="col m6 s12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Date Generated From:</label>
                                <div name="from_date" id="from_date"></div>
                            </div>
                            <div class="col m6 s12">
                                <label>Due Generated To:</label>
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
        $(".dropdown").jqxComboBox({autoComplete: true,width: '100%', autoDropDownHeight: true});
        $(".datepicker").jqxDateTimeInput({width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy'});
        if ($('#customer').jqxComboBox('getSelectedIndex') != "-1") {
            $.ajax({
                url: "/admin/customers/get-departments/" + $("#customer").val(),
                context: document.body
            }).done(function (html) {
                $('#s_department').jqxComboBox('destroy');
                $('#department_div').html(html);
                $("#s_department").jqxComboBox({width: '100%', autoDropDownHeight: true, checkboxes: true});
            });
        }
        $("body").on("change", "#customer", function (e) {
            if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val() != "-1") {
                $('.loading').css('display', 'block');
                $.ajax({
                    url: "/admin/customers/get-departments/" + $("#customer").val(),
                    type: 'GET',
                    success: function (html)
                    {
                        $('#s_department').jqxComboBox('destroy');
                        $('#department_div').html(html);
                        $("#s_department").jqxComboBox({width: '100%', autoDropDownHeight: true, checkboxes: true});
                        $('.loading').css('display', 'none');
                    }
                });
            }
        });
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'created_date', type: 'date'},
                        {name: 'customer'},
                        {name: 'department'},
                        {name: 'amount'},
                        {name: 'status'},
                        {name: 'due_date', type: 'date'},
                        {name: 'actions'}

                    ],
                    cache: false,
                    url: '/admin/invoices/show',
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
                var items = $("#s_department").jqxComboBox('getCheckedItems');
                var checkedItems = "";
                if (items) {
                    $.each(items, function (index) {
                        checkedItems += this.value + ",";
                    });
                }
                if (checkedItems !== "") {
                    checkedItems = checkedItems.substring(0, checkedItems.length - 1);
                }
                $.extend(data, {
                    name: $('#customer').val(),
                    department: checkedItems,
                    status: $('#status').val(),
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
                    virtualmode: true,
                    selectionmode: "none",
                    showfiltermenuitems: false,
                    rendergridrows: function (obj)
                    {
                        return obj.data;
                    },
                    columns: [
                        {text: 'Date Generated', width: '10%', dataField: 'created_date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Customer', width: '20%', dataField: 'customer'},
                        {text: 'Department', width: '30%', dataField: 'department'},
                        {text: 'Amount', width: '10%', dataField: 'amount'},
                        {text: 'Paid', width: '10%', dataField: 'status', cellsalign: 'center'},
                        {text: 'Due Date', width: '10%', dataField: 'due_date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Actions', width: '10%', cellsalign: 'center', dataField: 'actions'}
                    ]
                });
        $("body").on("change", ".invoice_status_checkbox", function (e) {    
            var status = "";
            if ($(this).is(":checked")) {
                status = "Paid";
            }
            else {
                status = "Unpaid";
            }
            $('.loading').css('display', 'block');
            $.ajax({
                url: "/admin/invoices/change-status/" + $(this).val()+"/"+status,
                type: 'GET',
                success: function (html)
                {
                    $('.loading').css('display', 'none');
                }
            });
        });

    });

</script>
@endsection