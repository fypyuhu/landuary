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
    <div class="row">
        <div class="p-wrapper" style="width:384px;" id="printable">
        	<div class="row">
                <h3 class="align-center">{{$organization->name}}</h3>
                <h4 class="align-center">Date: {{$shipping_date}}</h4>
            </div>
            <div class="row" style="background:#fdfdfd; padding:15px 25px 25px;">
                <div class="pull-left">
                    <h4>Received From:</h4>
                    {{$customer->name}}<br />
                    {{$customer->shipping_address}}<br />
                    {{$customer->shipping_city}} {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br /><br />
                    <strong>Customer Number:</strong> {{$customer->customer_number}}
                </div>
                @if ($department != null)
                <div class="pull-right">
                    <strong>Department:</strong><br />
                    {{$department->department_name}}<br /> 
                </div>
                @endif
            </div>
            <!--<div class="row">
                <div class="pull-left">
                    <h4>Customer #: {{$customer->customer_number}}</h4>
                </div>
                <div class="pull-right">
                    <h4>Department #: {{$department->department_name or ''}}</h4>
                </div>
            </div>
            <div class="row">
                <h3 class="align-center">
                    {{$customer->shipping_address}}<br />
                    {{$customer->shipping_city}} {{$customer->shipping_state}}<br />
                    
                </h3>
            </div>-->
            
        	<div class="row"><h4 class="align-center">Cart #: {{$ogc->cart_id}}</h4></div>
            <div class="row">
                <table>
                    <tr>
                        <th>Item</th>
                        <th>Name</th>
                        <th class="align-right">Qty</th>
                    </tr>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td class="align-right">{{$item->quantity}}</td>
                    </tr>
                    @endforeach
    
                </table>
            </div>
        	<hr />
            <div class="row">
                <div class="pull-right align-right" style="font-weight: bold; background:#fdfdfd; padding:15px;">
                    Gross Weight: {{$cart->gross_weight}}<br />
                    Tare Weight: {{$initial_values->standard_tare_weight}}<br />
                    Net Weight: {{$cart->net_weight}}
                </div>
            </div>
        	<div class="row align-center">{{date('d/m/Y h:i:s A',time())}}</div>
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