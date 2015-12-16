@extends('master')
@section('css')
<style type="text/css">
	.p-wrapper {
		width: 814px;
		margin: 0 auto;
	}
	
	table td {
		padding: 5px 10px;
	}
</style>
@endsection
@section('content')
<section class="content-wrap">
	<div class="row">
    	<a href="{{URL::previous()}}" class="waves-effect btn">Back</a>
    	<button class="waves-effect btn" onclick='$("#printable").print();'>Print</button>
    </div>
    <div class="p-wrapper" id="printable">
        <div class="row">
            <h3 class="align-center">Shipping Manifest</h3>
        </div>
        <div class="row">
            <div class="pull-left">
                <h4>{{$user->legal_name}}</h4>
                <p>{{$user->street_address}}<br />{{$user->city}} {{$user->state}} {{$user->zipcode}}<br />Phone: {{$user->phone}}</p>
            </div>
            <div class="pull-right">
                <p>Manifest #: {{$manifest->id}}<br />
                Ship Date: {{$manifest->shipping_date}}</p>
            </div>
        </div>
        <div class="row" style="background:#fdfdfd; padding:15px 25px 25px;">
            <div class="pull-left">
                <h4>Deliver To:</h4>
                {{$customer->name}}<br />
                {{$customer->shipping_address}}<br />
                {{$customer->shipping_city}} {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br /><br />
                <strong>Customer Number:</strong> {{$customer->customer_number}}
            </div>
        </div>
        <div class="row">
        	<table>
                <tr>
                    <th>Cart #</th>
                    <th>Item #</th>
                    <th>Name</th>
                    <th class="align-right">Qty</th>
                    <th class="align-right">Net Weight</th>
                </tr>
                @foreach($items as $key=>$item)
                <tr>
                    <td>{{$key > 0 && $item->cart_id == $items[$key-1]->cart_id ? '...' : $item->cart_id}}</td>
                    <td>{{$item->item_number}}</td>
                    <td>{{$item->name}}</td>
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
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        
    });
    
</script>

@endsection