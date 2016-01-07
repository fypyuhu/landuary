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
    	<button class="waves-effect btn" id="btn-printable" onclick='$("#printable").print();'>Print</button>
    </div>
    <div class="row receipt">
    <div class="p-wrapper" id="printable">
    <img src="{{URL::asset('images/c1.jpg')}}" class="client-logo" />
    <div class="row">
    	 <div class="pull-left">
                <h4>{{$user_p->legal_name}}</h4>
                <p style="font-size:17px;">{{$user_p->street_address}}<br />{{$user_p->city}} {{$user_p->state}}</p>
                <p>Phone: {{$user_p->phone}}</p>
            </div>
        <div class="pull-right">
            <p>Invoice #: {{$invoice->invoice_number}}<br />
            Creation Date: @date($invoice->created_at)<br />
            Due Date: @date($invoice->due_date)</p>
        </div>
    </div>
    <div class="row highlighted">
    	<div class="row">
            <p>Ship To: {{$customer->name}}<br />
                Customer Number: {{$customer->customer_number}}<br /><br />
                {{$customer->shipping_address}} {{$customer->shipping_city}}<br />
                {{$customer->shipping_state}} {{$customer->shipping_zipcode}}<br />
                {{$customer->shipping_country}}
                </p>
        </div>
    </div>
    <div class="row">
    	<table>
        	<tr class="receipt-heading">
        		<th>Ship Date</th>
                <th>Manifest #</th>
                <th>No. of Carts</th>
                <th>No. of Items</th>
                <th>Cart Net Weight</th>
            </tr>
            @foreach($invoice_data as $key=>$data)
            <tr>
                <td>@if($key > 0 && $data->shipping_date == $invoice_data[$key-1]->shipping_date) ... @else @date($data->shipping_date) @endif</td>
                <td>{{$key > 0 && $data->id == $invoice_data[$key-1]->id ? '...' : $data->id}}</td>
                <td>{{$data->total_carts}}</td>
                <td>{{$data->total_items}}</td>
                <td>{{$data->quantity}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <hr />
    <div class="row">
        <div class="pull-right align-right" style="font-weight: bold; padding:15px;">
            <p>Sub Total: ${{$invoice->price}}<br />
            {{$tax->tax_name}} Tax: ${{$invoice->total_tax}}<br /></p>
            <hr />
            <p> Total Invoice: ${{$invoice->total_price}}</p>
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