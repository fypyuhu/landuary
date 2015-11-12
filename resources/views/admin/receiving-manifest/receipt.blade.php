@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">
    <div class="p-wrapper">
    	<div class="row">
            <button type="submit" class="waves-effect btn">Print</button>
        </div>
        <div class="row">
            <h3 class="align-center">Receiving Manifest</h3>
        </div>
        <div class="row">
            <div class="pull-left">
                <h4>Phoenix Scale Company</h4>
                <p style="font-size:17px;">6802N. 47th Ave.<br />Ste 9<br />Glendale AZ 85301</p>
                <p>Phone: (800) 326-9860</p>
            </div>
            <div class="pull-right">
                <p>Manifest #: 200<br />
                Ship Date: 11/06/2015</p>
            </div>
        </div>
        <div class="row">
            <div class="pull-left">
                <p>Deliver To:<br />
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
            <table>
                <tr>
                    <th>Num</th>
                    <th>Cart #</th>
                    <th>Item #</th>
                    <th>Description</th>
                    <th class="align-right">Qty</th>
                    <th class="align-right">Net Weight</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td>100001</td>
                    <td>02</td>
                    <td>King Sheets</td>
                    <td class="align-right">50</td>
                    <td class="align-right">50.0</td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>100001</td>
                    <td>02</td>
                    <td>King Sheets</td>
                    <td class="align-right">50</td>
                    <td class="align-right">50.0</td>
                </tr>
            </table>
        </div>
        <hr />
        <div class="row">
            <div class="pull-left">
                <p>Numbered Carts: 0<br />
                Other Items: 1</p>
            </div>
            <div class="pull-right">
                <p>Total Gross Weight: 0.0<br />
                Total Net Weight: 50.0<br />
                Total Shippment Weight: 50.0</p>
            </div>
        </div>
    </div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
@endsection