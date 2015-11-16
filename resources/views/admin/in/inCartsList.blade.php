@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


<!-- Breadcrumb -->
<div class="page-title">

  <div class="row">
    <div class="col s12 m9 l10">
      <h1>Incoming Carts List</h1>

      <ul>
        <li>
          <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
        </li>

        <li><a href='dashboard.html'>In Coming Carts</a>
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
          <legend>Incoming Cart(s):</legend>
          <div class="row box">
              <div class="row layout_table no-topmargin">
                <div class="row heading">
                    <div class="col s1">Cart Number</div>
                    <div class="col s2">Tran. Date</div>
                    <div class="col s1">Customer Number</div>
                    <div class="col s1">Dept</div>
                    <div class="col s2">No. of Items</div>
                    <div class="col s2">Gross Weight lb/kg</div>
                    <div class="col s1">Net Weight lb/kg</div>
                    <div class="col s1">Invoiced</div>
                    <div class="col s1 center-align">Actions</div>
                </div>
                @foreach($carts as $cart)
                <div class="row records_list">
                    <div class="col s1 right-align">{{$cart->incoming_cart_id}}</div>
                    <div class="col s2">{{$cart->receiving_date}}</div>
                    <div class="col s1 right-align">{{$cart->customer_number}}</div>
                    <div class="col s1">{{$cart->department_name}}</div>
                    <div class="col s2 right-align">{{$cart->number_of_items}}</div>
                    <div class="col s2 right-align">{{$cart->net_weight}}</div>
                    <div class="col s1 right-align">{{$cart->gross_weight}}</div>
                    <div class="col s1 right-align">No</div>
                    <div class="col s1 center-align"><a href="/admin/in/edit/{{$cart->incoming_cart_id}}" data-mode="ajax" >View/Edit</a></div>
                </div>
                @endforeach
              </div>
          </div>
      </fieldset>
    </div>
</div>
</section>

<!-- /Main Content -->
@endsection

@section('js')
@endsection