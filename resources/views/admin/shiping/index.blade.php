@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Shipping Manifest</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Shipping Manifest</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m3 l2 right-align">
                <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
            </div>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div id="shipmant" class="row no-rightmargin">
        <form action="/admin/shiping-manifest/create" Method="POST">
            <div class="col s12 m4">
                <fieldset>
                    <legend>Shipping Manifest:</legend>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Name:</label>
                            <select name="customer" id="customer">
                                <option value="-1" selected="selected">Please select a customer</option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col m6 s12">
                            <label>Department:</label>
                            <select name="department" id="department" disabled="disabled">
                                <option value="" disabled selected>Select Department</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Number:</label>
                            <div class="input-field">
                                <input id="name" type="text" name="name" disabled="disabled" value="Auto Fill">
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <label>Enter Ship Date:</label>
                                <div id="ship_date" type="text" name="ship_date" class="calendar"></div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label>Special text to appear after detail section for this manifest (different than manifest ending lines):</label>
                            <div class="input-field">
                                <textarea id="name" name="name"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
                
            </div>

            <div class="col s12 m8">
                <fieldset>
                    <legend>Select Cart(s):</legend>
                    <div class="row box">
                        <div class="row layout_table no-topmargin">
                            <div class="row heading">
                                <div class="col s1 center-align chkbx">
                                    <input type="checkbox" name="use_departments" id="use_departments">
                                    <label for="use_departments"></label>
                                </div>
                                <div class="col s1">Cart Number</div>
                                <div class="col s2">Department</div>
                                <div class="col s1">No. of Items</div>
                                <div class="col s2 center-align">Date Created</div>
                                <div class="col s3 right-align">Net Weight lb/kg</div>
                                <div class="col s2 center-align">Actions</div>
                            </div>
                            <div class="row records_list">
                                <div class="col s12 center-align"><strong>No Carts.</strong></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>

</section>

<!-- /Main Content -->

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
         $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true,disabled:true});
        $("#ship_date").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px',formatString: 'dd-MM-yyyy'});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true});
         $('#customer').on('change', function () {
            if ($("#customer").jqxComboBox('getSelectedIndex') != "-1" && $("#customer").val()!="-1") {
                $(".loading").css("display","block");
                $.ajax({
                    url: "/admin/shiping-manifest/details/" + $(this).val(),
                    context: document.body
                }).done(function (html) {
                    $("#shipmant").html(html);
                    $(".loading").css("display","none");
                });
            }
        });     
    });
    
</script>

@endsection