@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">
    <div class="p-wrapper">
    	<div class="row">
        	<a href="/admin/receiving-manifest" class="waves-effect btn">Back</a>
            <button type="submit" class="waves-effect btn">Print</button>
        </div>
        <div class="row">
            <h3 class="align-center">Receiving Manifest</h3>
        </div>
        <div class="row">
            <div class="pull-left">
                <h4>{{$user->legal_name}}</h4>
            <p style="font-size:17px;">{{$user->street_address}}<br />{{$user->state}}<br />{{$user->city}}</p>
            <p>Phone: {{$user->phone}}</p>
            </div>
            <div class="pull-right">
                <p>Manifest #: {{$manifest->id}}<br />
                Receiving Date:<br />
                From: {{$manifest->date_from}} - {{$manifest->date_to}}</p>
            </div>
        </div>
        <div class="row">
            <div class="pull-left">
                <p><strong>Deliver To:</strong><br />
                Customer Number: {{$customer->customer_number}}<br />
                <strong>Department:</strong><br />
                @if ($department_range[0] != '')
                From: {{$department_range[0]}}<br /> 
                @endif
                
                @if ($department_range[1] != '')
                To: {{$department_range[1]}}</p>
                @endif
            </div>
            <div class="pull-right">
                <p>{{$customer->name}}<br />
                {{$customer->shipping_address}}<br />
                {{$customer->shipping_city}} {{$customer->shipping_state}} {{$customer->shipping_zipcode}}</p>
            </div>
        </div>
        <div class="row">
            <table>
                <tr>
                    <th>Sr.</th>
                    <th>Cart #</th>
                    <th>Item #</th>
                    <th>Description</th>
                    <th class="align-right">Qty</th>
                    <th class="align-right">Net Weight</th>
                </tr>
                @foreach($items as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->incoming_cart_id}}</td>
                    <td>{{$item->item_number}}</td>
                    <td>{{$item->description}}</td>
                    <td class="align-right">{{$item->quantity}}</td>
                    <td class="align-right">{{$item->weight * $item->quantity}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <hr />
        <div class="row">
            <div class="pull-right">
                <p>Total Gross Weight: {{$items[0]->gross_weight}}<br />
                Total Net Weight: {{$items[0]->net_weight}}<br />
                Total Shippment Weight: {{$items[0]->gross_weight}}</p>
            </div>
        </div>
    </div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
@endsection