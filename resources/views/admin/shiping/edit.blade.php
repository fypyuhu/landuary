@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Edit Shipping Manifest</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
                    </li>

                    <li><a href='dashboard.html'>Edit  Shipping Manifest</a>
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
        <form action="/admin/shiping-manifest/edit/{{$manifest->id}}" Method="POST" id="pageForm">
            {{csrf_field()}}
            <div class="col s12 m5">
                <fieldset>
                    <legend>Edit Shipping Manifest:</legend>
                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Name:</label>
                            <select name="customer" id="customer">
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            </select>
                        </div>
                        <div class="col m6 s12">
                            <label>Department:</label>
                            <select name="department" id="department">
                                @if($department)
                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @else
                                <option value="-1" selected>Select Department</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m6 s12">
                            <label>Customer Number:</label>
                            <div class="input-field">
                                <input id="name" type="text" name="name" disabled="disabled" value="{{$customer->customer_number}}">
                            </div>
                        </div>
                        <div class="col m6 s12">
                            <label>Enter Ship Date:</label>
                            <div id="ship_date" type="text" name="ship_date"></div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label>Special text to appear after detail section for this manifest (different than manifest ending lines):</label>
                            <div class="input-field">
                                <textarea id="name" readonly name="discription">{{$manifest->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col">
                        <label  class="error" id="error-select_cart"></label>
                    </div>
                    <div class="col pull-right">
                        <button class="waves-effect btn" type="submit">Save</button>
                        <button class="waves-effect btn">Clear</button>
                    </div>
                </div>
            </div>

            <div class="col s12 m7">
                <fieldset>
                    <legend>Select Cart(s):</legend>
                    <div class="row box">
                        <div class="row layout_table no-topmargin">
                            <div class="row heading">
                                <div class="col s1 center-align chkbx">
                                    <input type="checkbox" name="all_carts" id="all_carts">
                                    <label for="all_carts"></label>
                                </div>
                                <div class="col s2">Cart Number</div>
                                <div class="col s3">Date Created</div>
                                <div class="col s3 right-align">Net Weight lb/kg</div>
                                <div class="col s3 center-align">Actions</div>
                            </div>
                            @if(!$carts->isEmpty())
                            @foreach($carts as $cart)
                            <div class="row records_list">
                                <div class="col s1 center-align chkbx">
                                    <input type="checkbox" class="all_cart_checkbox" name="carts[{{$cart->id}}]" value="{{$cart->id}}" id="carts[{{$cart->id}}]">
                                    <label for="carts[{{$cart->id}}]"></label>
                                </div>
                                <div class="col s2">{{$cart->cart_id}}</div>
                                <div class="col s3">@date($cart->shipping_date)</div>
                                <div class="col s3 right-align">{{$cart->net_weight}}</div>
                                <div class="col s3 center-align"><a href="/admin/out/show-receipt/{{$cart->id}}"   class="edit-button">View</a> | <a href="/admin/out/edit/{{$cart->id}}" class="edit-button">Edit</a> | <a href="/admin/out/delete/{{$cart->id}}" data-mode="ajax">Delete</a></div>
                            </div>
                            @endforeach
                            @endif
                            @foreach($selected_carts as $cart)
                            <div class="row records_list">
                                <div class="col s1 center-align chkbx">
                                    <input type="checkbox" class="all_cart_checkbox" checked="checked" name="carts[{{$cart->id}}]" value="{{$cart->id}}" id="carts[{{$cart->id}}]">
                                    <label for="carts[{{$cart->id}}]"></label>
                                </div>
                                <div class="col s2">{{$cart->cart_id}}</div>
                                <div class="col s3">{{date('d-m-Y',strtotime($cart->shipping_date))}}</div>
                                <div class="col s3 right-align">{{$cart->net_weight}}</div>
                                <div class="col s3 center-align"><a href="/admin/out/show-receipt/{{$cart->id}}"   class="edit-button">View</a> | <a href="/admin/out/edit/{{$cart->id}}"  class="edit-button">Edit</a></div>
                            </div>
                            @endforeach
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
        $("#department").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true, disabled: true});
        $("#ship_date").jqxDateTimeInput({value:new Date("@date($manifest->shipping_date)"), width: 'auto', height: '25px', formatString: 'MMMM dd, yyyy', disabled: true});
        $("#customer").jqxComboBox({width: '100%', autoComplete: true, autoDropDownHeight: true, disabled: true});
        $("#pageForm").validate({
                ignore: [],
                rules: {
                    customer: "required"
            },
            submitHandler: function (form) {
				$('.loading').show();
                if($(".all_cart_checkbox").length<1 || $('.all_cart_checkbox:checked').length<1){
                $("#error-select_cart").html("Please select at least one cart");
                $("#error-select_cart").show();
                }
                else{
                    $(form).validate().cancelSubmit = true;
                    $(form).submit();
                }
            }
            });  
    });

</script>

@endsection