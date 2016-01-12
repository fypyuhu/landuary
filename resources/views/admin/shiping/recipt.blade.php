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
	
	.p-wrapper {
		position: relative;
	}
	
	.client-logo {
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0.1;
		width: 100%;
		height: 100%;
	}
</style>
@endsection
@section('content')
<section class="content-wrap" style="background: #ffffff;">
	<div class="row">
    	<a href="{{URL::previous()}}" class="waves-effect btn">Back</a>
    	<button class="waves-effect btn" id="btn-printable" onclick='$("#printable").print();'>Print</button>
    </div>
    <div class="row receipt">
        <div class="p-wrapper" id="printable">
        	@if ($user_profile_global->logo != '')
            <img src="{{URL::asset('uploads/profile')}}/{{$user_profile_global->logo}}" alt="{{$user_global->first_name}}" class="client-logo">
            @endif
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
                    Ship Date: @date($manifest->shipping_date)</p>
                </div>
            </div>
            <div class="row highlighted">
                <div class="row" align="center">
                    <h4>Deliver To:</h4>
                    {{$customer->name}}<br />
                    {{$customer->shipping_address}}<br />
                    {{$customer->shipping_city}} {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br /><br />
                    <strong>Customer Number:</strong> {{$customer->customer_number}}
                </div>
            </div>
            <div class="row">
                <table>
                    <tr class="receipt-heading">
                        <th>Cart #</th>
                        <th>Item #</th>
                        <th>Name</th>
                        <th class="align-right">Qty</th>
                        <th class="align-right">Cart Net Weight</th>
                    </tr>
                    @foreach($items as $key=>$item)
                    <tr>
                        <td><strong>{{$key > 0 && $item->cart_id == $items[$key-1]->cart_id ? '...' : $item->cart_id}}</strong></td>
                        <td>{{$item->item_number}}</td>
                        <td>{{$item->name}}</td>
                        <td class="align-right">{{$item->quantity}}</td>
                        <td class="align-right"><strong>{{$key > 0 && $item->cart_id == $items[$key-1]->cart_id ? '...' : $item->net_weight}}</strong></td>
                    </tr>
                    @endforeach
                    
                </table>
            </div>
            <hr />
            <div class="row">
                <div class="pull-right align-right" style="font-weight: bold; padding:15px;">
                    <p>Total Gross Weight: {{$total_gross_weight}}<br />
                    Total Net Weight: {{$total_net_weight}}</p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="pull-left">
                    Driver Signature: _____________________
                </div>
                <div class="pull-right align-right">
                    Receiver Signature: _____________________
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    @if (!session('status'))
        <script type="text/javascript">
            $( window ).load(function() {
                $("#btn-printable").trigger('click');
            });
        </script>
    @endif
@endsection