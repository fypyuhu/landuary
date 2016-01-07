@extends('master')
@section('css')
<style type="text/css">
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
  <!-- Main Content -->
  <section class="content-wrap" style="background: #ffffff;">
  	<div class="row">
        	<a href="{{URL::previous()}}" class="waves-effect btn">Back</a>
            <button type="submit" id="btn-printable" class="waves-effect btn">Print</button>
        </div>
    
    <div class="row receipt">    
    <div class="p-wrapper" id="printable">
    	@if ($user_profile->logo != '')
        <img src="{{URL::asset('uploads/profile')}}/{{$user_profile->logo}}" alt="{{$user->first_name}}" class="client-logo">
        @endif
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
        <div class="row highlighted">
            <div class="row">
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
                <tr class="receipt-heading">
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
            <div class="pull-right align-right" style="font-weight: bold; padding:15px;">
                <p>Total Gross Weight: {{$total_gross_weight}}<br />
                Total Net Weight: {{$total_net_weight}}</p>
            </div>
        </div>
    </div>
    </div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
<script type="text/javascript">
    $( window ).load(function() {
        $("#btn-printable").trigger('click');
    });
    
</script>
@endsection