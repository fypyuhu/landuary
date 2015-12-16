@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Manifests</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Manifests</a>
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
        <div class="col m10 s12">
            <div class="row">
                <ul class="ctabs">
                    <li class="current" data-corr-div-id="#receiving-manifest-div">Receiving Manifests</li>
                    <li data-corr-div-id="#shipping-manifest-div">Shipping Manifests</li>
                </ul>
            </div>
            <div class="row tab-content-group">
                <div class="row tab-content first no-topmargin" id="receiving-manifest-div">
                    <div class="row no-topmargin" style="margin-bottom:25px;">
                        <div class="col m6 s12">
                            <div class="row">
                                <label>Select Customer:</label>
                                <select name="r_customer" id="r_customer">
                                    <!--<option value="-1">Please Select</option>-->
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col m6 s12">
                                    <label>From:</label>
                                    <div id="r_date_from" name="r_date_from" ></div>
                                </div>
                                <div class="col m6 s12">
                                    <label>To:</label>
                                    <div id="r_date_to" name="r_date_to" class="calendar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <button type="buton" class="waves-effect btn" onclick="$('#jqxgrid1').jqxGrid('updatebounddata');">Filter</button>
                                    <button type="reset" class="waves-effect btn">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <fieldset>
                            <legend>Receiving Manifests:</legend>
                            <div class="row box">
                                <div id="jqxgrid1"></div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row tab-content no-topmargin" id="shipping-manifest-div">
                    <div class="row no-topmargin" style="margin-bottom:25px;">
                        <div class="col m6 s12">
                            <div class="row">
                                <div class="col m6 s12">
                                    <label>Select Customer:</label>
                                    <select name="s_customer" id="s_customer">
                                        @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col m6 s12" id="s_department_div">
                                    <label>Select Department:</label>
                                    <select name="s_department" id="s_department">
                                        <option value='-1'>Select Department</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m6 s12">
                                    <label>From:</label>
                                    <div id="s_date_from" name="s_date_from" ></div>
                                </div>
                                <div class="col m6 s12">
                                    <label>To:</label>
                                    <div id="s_date_to" name="s_date_to" class="calendar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <button type="button" class="waves-effect btn" onclick="$('#jqxgrid').jqxGrid('updatebounddata');">Filter</button>
                                    <button type="reset" class="waves-effect btn">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <fieldset>
                            <legend>Shipping Manifests:</legend>
                            <div class="row box">
                                <div id="jqxgrid"></div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /Main Content -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function (e) {
         if ($('#s_customer').jqxComboBox('getSelectedIndex') != "-1") {
            $.ajax({
                url: "/admin/customers/get-departments/" + $("#s_customer").val(),
                context: document.body
            }).done(function (html) {
                $('#s_department_div').html(html);
                $("#s_department").jqxComboBox({width: '100%', autoDropDownHeight: true});
            });
        }
        $("body").on("change", "#s_customer", function (e) {
            $('.loading').css('display', 'block');
            $.ajax({
                url: "/admin/customers/get-departments/" + $("#s_customer").val(),
                type: 'GET',
                success: function (html)
                {
                    $('#s_department').jqxComboBox('destroy');
                    $('#s_department_div').html(html);
                    $("#s_department").jqxComboBox({width: '100%', autoDropDownHeight: true});
                    $('.loading').css('display', 'none');
                }
            });
        });
        var oneWeekAgo = new Date();
        oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
        $('#s_date_from, #r_date_from').jqxDateTimeInput({value: new Date(oneWeekAgo), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
        $("#r_customer, #s_customer").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
        $("#r_date_to,  #s_date_to").jqxDateTimeInput({ width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});


        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'id'},
                        {name: 'name'},
                        {name: 'department'},
                        {name: 'date', type: 'date'},
                        {name: 'actions'}

                    ],
                    cache: false,
                    url: '/admin/manifests/show-shipping',
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
                    name: $('#s_customer').val(),
                    department: $('#s_department').val(),
                    start_date: $("#s_date_from").val(),
                    end_date: $("#s_date_to").val()
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
                    showfiltermenuitems: false,
                    rendergridrows: function (obj)
                    {
                        return obj.data;
                    },
                    columns: [
                        {text: 'Manifest Number', width: '20%', dataField: 'id'},
                        {text: 'Customer Name', width: '20%', dataField: 'name', filtertype: 'checkedlist'},
                        {text: 'Department', width: '20%', dataField: 'department'},
                        {text: 'Shipping Date', width: '20%', dataField: 'date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Actions', width: '20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
        url = "{{url('admin/manifests/show-receiving')}}";
        source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'id'},
                        {name: 'name'},
                        {name: 'department'},
                        {name: 'date', type: 'date'},
                        {name: 'actions'}

                    ],
                    cache: false,
                    url: url,
                    filter: function ()
                    {
                        // update the grid and send a request to the server.
                        $("#jqxgrid1").jqxGrid('updatebounddata', 'filter');
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
                    name: $('#r_customer').val(),
                    start_date: $("#r_date_from").val(),
                    end_date: $("#r_date_to").val()
                });
                return data;
            }
        });
        $("#jqxgrid1").jqxGrid(
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
                        {text: 'Manifest Number', width: '20%', dataField: 'id'},
                        {text: 'Customer Name', width: '20%', dataField: 'name', filtertype: 'checkedlist'},
                        {text: 'Department', width: '20%', dataField: 'department'},
                        {text: 'Created On', width: '20%', dataField: 'date', filtertype: 'date', cellsformat: 'dd MMMM, yyyy'},
                        {text: 'Actions', width: '20%', cellsalign: 'center', dataField: 'actions', sortable: false, filterable: false, exportable: false}
                    ]
                });
    });

</script>
@endsection