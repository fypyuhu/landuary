@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">
    <div class="p-wrapper">
    	<div class="row">
        	<a href="{{URL::previous()}}" class="waves-effect btn">Back</a>
            <button type="submit" class="waves-effect btn">Print</button>
        </div>
        <div class="row">
            <h3 class="align-center">Receiving Manifest</h3>
        </div>
        <div class="row">
            <div class="pull-left">
                <h4>{{$organization->legal_name}}</h4>
                <p>{{$organization->street_address}}<br />{{$organization->city}} {{$organization->state}} {{$organization->zipcode}}<br />{{$organization->country}}<br />
                Phone: {{$organization->phone}}
                </p>
            </div>
            <div class="pull-right">
                <p>Manifest #: {{$manifest->id}}<br />
                Receiving Date:<br />
                From: @date($manifest->date_from) - @date($manifest->date_to)</p>
            </div>
        </div>
        <div class="row" style="background:#fdfdfd; padding:15px 25px 25px;">
            <div class="pull-left">
                <h4>Received From:</h4>
                {{$customer->name}}<br />
                {{$customer->shipping_address}}<br />
                {{$customer->shipping_city}} {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br /><br />
                <strong>Customer Number:</strong> {{$customer->customer_number}}
            </div>
            @if ($department != '')
            <div class="pull-right">
                <strong>Department:</strong><br />
                {{$department}}<br /> 
            </div>
            @endif
        </div>
        <div class="row">
            <table>
                <tr>
                    <th>Cart #</th>
                    <th>Item #</th>
                    <th>Description</th>
                    <th class="align-right">Qty</th>
                    <th class="align-right">Net Weight</th>
                </tr>
                @foreach($items as $key=>$item)
                <tr>
                    <td>{{$key > 0 && $item->cart_id == $items[$key-1]->cart_id ? '...' : $item->cart_id}}</td>
                    <td>{{$item->item_number}}</td>
                    <td>{{$item->description}}</td>
                    <td class="align-right">{{$item->quantity}}</td>
                    <td class="align-right">{{$key > 0 && $item->cart_id == $items[$key-1]->cart_id ? '...' : $item->net_weight}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <hr />
        <div class="row">
            <div class="pull-right">
                <p>Total Gross Weight: {{$total_gross_weight}}<br />
                Total Net Weight: {{$total_net_weight}}</p>
            </div>
        </div>
    </div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
@endsection