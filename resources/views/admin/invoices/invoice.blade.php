@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">
    <div class="p-wrapper">
    <div class="row">
    	<div class="pull-left">
        	<h4>Phoenix Scale Company</h4>
            <p style="font-size:17px;">6802N. 47th Ave.<br />Ste 9<br />Glendale AZ 85301</p>
            <p>Phone: (800) 326-9860</p>
        </div>
        <div class="pull-right">
            <p>Invoice #: 200<br />
            Date: 11/06/2015</p>
        </div>
    </div>
    <div class="row">
    	<div class="pull-left">
            <p>Ship To:<br />
            Customer Number: 0001<br />
            Department: NA</p>
        </div>
        <div class="pull-right">
            <p>Baptist Hospital<br />
            123 N.19th Avenue<br />
            Phoenix AZ 85015</p>
        </div>
    </div>
    <div class="row">
    	<div class="pull-left">
    		<p>Reference:  NA<br/ >
            Terms: NET 30<br />
            Dates Covered: 11-04-2015 through 11-20-2015</p>
        </div>
        <div class="pull-right">
            <p>Bill Type: Incoming<br />
            Departments: All<br />
            Due Date: 12-31-2015</p>
        </div>
    </div>
    <div class="row">
    	<table>
        	<tr>
        		<th>Date</th>
                <th>Manifest #</th>
                <th>Item #</th>
                <th>Description</th>
                <th class="align-right">Quantity</th>
                <th class="align-right">Price</th>
                <th class="align-right">Total</th>
            </tr>
            <tr>
        		<td>01-01-2015</td>
                <td>100001</td>
                <td>02</td>
                <td>King Sheets</td>
                <td class="align-right">10.00</td>
                <td class="align-right">50.00</td>
                <td class="align-right">500.00</td>
            </tr>
            <tr>
        		<td>01-01-2015</td>
                <td>100001</td>
                <td>02</td>
                <td>King Sheets</td>
                <td class="align-right">10.00</td>
                <td class="align-right">50.00</td>
                <td class="align-right">500.00</td>
            </tr>
        </table>
    </div>
    <hr />
    <div class="row">
        <div class="pull-right">
            <p>Sub Total: $1000.00<br />
            Sales Tax: $6.00<br />
            <hr />
            Total Invoice: $150.00</p>
        </div>
    </div>
</div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
@endsection