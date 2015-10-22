@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
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
    <a id="inline" href="#add-record" class="waves-effect btn create-clone-button">Add Item</a>
    <div class="row no-rightmargin">
        <div class="col s9">
            <div style="display: none">
                <fieldset id="add-record">
                    <legend> Item:</legend>
                    <form method="POST" action="{{url('admin/items/create')}}" id="pageForm">
                        {{csrf_field()}}
                        <div class="row s12">
                            <label>Name:</label>
                            <div class="input-field">
                                <input id="item_name" type="text" name="item_name">
                            </div>
                            <label for="item_name" class="error" id="error-item-name"></label>
                        </div>

                        <div class="row">
                            <input type="checkbox" name="show_parent_item_div" id="show_parent_item_div" data-corr-div-id="#parent-item-div" class="checkbox">
                            <label for="show_parent_item_div">This is a sub item.</label>
                        </div>

                        <div class="row" style="display: none;" id="parent-item-div">
                            <label>Please select the parent item of this product:</label>
                            <div class="input-field">
                                <select name="parent_item" id="parent_item">
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach  
                                </select>
                            </div>
                            <label for="parent_item" class="error" id="error-parent-item"></label>
                        </div>

                        <div class="row s12">
                            <label>Number:</label>
                            <div class="input-field">
                                <input id="item_number" type="text" name="item_number">
                            </div>
                            <label for="item_number" class="error" id="error-item-number"></label>
                        </div>

                        <div class="row">
                            <label>Description:</label>
                            <div class="input-field">
                                <input id="item_desc" type="text" name="item_desc">
                            </div>
                            <label for="item_desc" class="error" id="error-item-desc"></label>
                        </div>
                        <div class="row">
                            <div class="col m6 s12">
                                <label>Weight:</label>
                                <div class="input-field">
                                    <input id="item_weight" type="text" name="item_weight">
                                </div>
                                <label for="item_weight" class="error" id="error-item-weight"></label>
                            </div>
                            <div class="col m6 s12">
                                <label>Transaction Type:</label>
                                <div class="input-field">
                                    <select name="transaction_type" id="transaction_type">
                                        <option value="In">In</option>
                                        <option value="Out">Out</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                                <label for="transaction_type" class="error" id="error-transaction-type"></label>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="waves-effect btn">Save</button>
                            <button class="waves-effect btn">Clear</button>
                        </div>
                    </form>
                </fieldset>
            </div>

            <fieldset>
                <legend>Items List:</legend>
                <div class="row box">
                    <div id="jqxgrid"></div>
                    <button type="button" class="waves-effect btn" onclick="$('#jqxgrid').jqxGrid('exportdata', 'xls', 'items');"><i class="fa fa-file-excel-o"></i>Export XLS</button>
                     <button type="button" class="waves-effect btn" onclick="$('#jqxgrid').jqxGrid('exportdata', 'pdf', 'items');">Export PDF</button>
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

        $("#transaction_type").jqxComboBox({width: '100%', autoDropDownHeight: true});
        $("#parent_item").jqxComboBox({width: '100%', autoDropDownHeight: true});

        $("#pageForm").validate({
            rules: {
                item_name: "required",
                item_number: {
                    required: true,
                    digits: true,
                },
                item_desc: "required",
                item_weight: "required",
                transaction_type: "required"
            },
            submitHandler: function (form) {
                var options = {
                    success: showResponse
                };
                function showResponse(responseText, statusText, xhr, $form) {
                    location.reload();
                }
                $(form).ajaxSubmit(options);
            }
        });
        var url = "{{url('admin/items/show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
                        {name: 'name'},
                        {name: 'item_number'},
                        {name: 'weight'},
                        {name: 'transaction_type'},
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
                        {text: 'Name', dataField: 'name'},
                        {text: 'Number', dataField: 'item_number'},
                        {text: 'Weight lb/kg', dataField: 'weight'},
                        {text: 'Transaction Type', dataField: 'transaction_type'},
                        {text: 'Actions', dataField: 'actions',sortable:false,filterable:false,exportable:false}
                    ]
                });
    });
</script>

@endsection