@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">
    <div class="p-wrapper">
    	<div class="row">
        	<a href="/admin/receiving-manifest" class="waves-effect btn">Back</a>
            <button type="submit" class="waves-effect btn">Print</button>
        </div>
        <div class="row">
            <h3 class="align-center">Receiving Manifest</h3>
        </div>
       
        
        <div class="row">
            <table>
                <tr>
                    <th>Sr.</th>
                    <th>Cart #</th>
                    <th>Item #</th>
                    <th>Description</th>
                    <th class="align-right">Qty</th>
                    <th class="align-right">Net Weight</th>
                </tr>
                
            </table>
        </div>
        <hr />
        
    </div>
  </section>
  <!-- End Content -->
@endsection

@section('js')
@endsection