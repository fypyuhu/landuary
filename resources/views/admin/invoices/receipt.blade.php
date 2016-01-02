@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap" style="background: #ffffff;">
      <div class="row">
    	<a href="{{URL::previous()}}" class="waves-effect btn">Back</a>
    	<button class="waves-effect btn" onclick='$("#printable").print();'>Print</button>
    </div>
    <div class="row receipt">
    <div class="p-wrapper" id="printable">
    <div class="row">
    	 <div class="pull-left">
                <h4>{{$user->legal_name}}</h4>
                <p style="font-size:17px;">{{$user->street_address}}<br />{{$user->city}} {{$user->state}}</p>
                <p>Phone: {{$user->phone}}</p>
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
                <th>Cart #</th>
                <th>Item #</th>
                <th>Item Name</th>
                <th>Quantity</th>
            </tr>
            @foreach($invoice_data as $key=>$data)
            <tr>
                <td>@date($data->shipping_date)</td>
                <td>{{$data->id}}</td>
                <td>{{$data->cart_number}}</td>
                <td>{{$data->item_number}}</td>
                <td>{{$data->item_name}}</td>
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
            @foreach($tax_componenets as $component)
            <p>{{$component->component_name}} Tax: ${{($invoice->total_tax)/(($tax_data->accumulative_rate)/100)*(($component->tax_rate)/100)}}</p>
            @endforeach
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
@endsection