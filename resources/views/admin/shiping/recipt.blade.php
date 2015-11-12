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
    <button class="waves-effect btn" onclick='$("#printable").print();'>Print</button>
<div class="p-wrapper" id="printable">
	<div class="row">
		<h3 class="align-center">Shipping Manifest</h3>
    </div>
    <div class="row">
    	<div class="pull-left">
        	<h4>Phoenix Scale Company</h4>
            <p style="font-size:17px;">6802N. 47th Ave.<br />Ste 9<br />Glendale AZ 85301</p>
            <p>Phone: (800) 326-9860</p>
        </div>
        <div class="pull-right">
            <p>Manifest #: {{$manifest->id}}<br />
            Ship Date: {{$manifest->shipping_date}}</p>
        </div>
    </div>
    <div class="row">
    	<div class="pull-left">
            <p>Deliver To: {{$customer->name}}<br />
            Customer Number: {{$customer->customer_number}}<br />
            Department: NA</p>
        </div>
        <div class="pull-right">
            <p>{{$customer->shipping_address}} {{$customer->shipping_city}}<br />
            {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br />
            {{$customer->shipping_country}}</p>
        </div>
    </div>
    <div class="row">
    	<table>
        	<tr>
        		<th>Num</th>
                <th>Cart #</th>
                <th>Item #</th>
                <th>Description</th>
                <th class="align-right">Qty</th>
                <th class="align-right">Net Weight</th>
            </tr>
            <?php $netWeight=0;?>
            @foreach($items as $item)
            <tr>
        		<td>{{$item->row_number}}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->item_number}}</td>
                <td>{{$item->name}}</td>
                <td class="align-right">{{$item->quantity}}</td>
                <td class="align-right">{{($item->quantity*$item->weight)}}</td>
            </tr>
             <?php $netWeight+=($item->quantity*$item->weight);?>
            @endforeach
            
        </table>
    </div>
    <hr />
    <div class="row">
    	<div class="pull-left">
            <p>Numbered Carts: 0<br />
            Other Items: 1</p>
        </div>
        <div class="pull-right">
            <p>Total Gross Weight:{{($netWeight+$items[0]->tare_weight)}}<br />
            Total Net Weight: {{$netWeight}}<br />
            Total Shippment Weight: {{($netWeight+$items[0]->tare_weight)}}</p>
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