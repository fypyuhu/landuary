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
        <div class="p-wrapper" style="width:384px;" id="printable">
        	@if ($user_profile_global->logo != '')
            <img src="{{URL::asset('uploads/profile')}}/{{$user_profile_global->logo}}" alt="{{$user_global->first_name}}" class="client-logo">
            @endif
        	<div class="row">
                <h3 class="align-center">{{$organization->name}}</h3>
                <h4 class="align-center">Date: @date($shipping_date)</h4>
            </div>
            <div class="row highlighted">
                <div class="row" align="center">
                    <h4>Ship To:</h4>
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
            
        	<div class="row"><h4 class="align-center">Cart #: {{$cart->cart_id}}</h4></div>
            <div class="row">
                <table>
                    <tr class="receipt-heading">
                        <th>Item</th>
                        <th>Name</th>
                        <th class="align-right">Qty</th>
                    </tr>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item->item_number}}</td>
                        <td>{{$item->name}}</td>
                        <td class="align-right">{{$item->quantity}}</td>
                    </tr>
                    @endforeach
    
                </table>
            </div>
        	<hr />
            <div class="row">
                <div class="pull-right align-right" style="font-weight: bold; padding:15px;">
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
    @if (!session('status'))
        <script type="text/javascript">
            $( window ).load(function() {
                $("#btn-printable").trigger('click');
            });
        </script>
    @endif
@endsection