@extends('master')
@section('content')
<!-- Main Content -->
<section class="content-wrap">


<!-- Breadcrumb -->
<div class="page-title">

  <div class="row">
    <div class="col s12 m9 l10">
      <h1>Manifests</h1>

      <ul>
        <li>
          <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
        </li>

        <li><a href='dashboard.html'>Manifests</a>
        </li>
      </ul>
    </div>
    <div class="col s12 m3 l2 right-align">
      <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
    </div>
  </div>

</div>
<!-- /Breadcrumb -->

<div class="row no-rightmargin" id="adjustment">
    <div class="col s6">
      <div class="row" style="margin-bottom: 20px;">
      	<h5>Receiving Manifest Filter:</h5>
        <div class="row">
        	<div class="col m6 s12">
            	<label>Customer</label>
            	<select id="rm_customer" name="rm_customer">
                	<option value="">Please Select</option>
                    <option value="1">Customer A</option>
                    <option value="2">Customer B</option>
                </select>
            </div>
            <div class="col m6 s12">
            	<label>Receiving Date</label>
            	<div id="receiving_date" name="receiving_date" class="calendar"></div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="waves-effect btn">Save</button>
            <button class="waves-effect btn">Clear</button>
        </div>
      </div>
      <div class="row">
          <fieldset>
              <legend>Receiving Manifests:</legend>
              <div class="row box">
                  <div class="row layout_table no-topmargin">
                    <div class="row heading">
                        <div class="col s3">Manifest Number</div>
                        <div class="col s3">Customer Name</div>
                        <div class="col s3">Created On</div>
                        <div class="col s3 center-align">Action</div>
                    </div>
                    @foreach($receiving_manifests as $manifest)
                    <div class="row records_list">
                        <div class="col s3">{{$manifest->id}}</div>
                        <div class="col s3">{{$manifest->customer->name}}</div>
                        <div class="col s3">{{$manifest->created_at}}</div>
                        <div class="col s3 center-align"><a href="/admin/receiving-manifest/receipt/{{$manifest->id}}">View</a></div>
                    </div>
                    @endforeach
                  </div>
              </div>
          </fieldset>
      </div>
    </div>
    
    <div class="col s6">
      <div class="row" style="margin-bottom:20px;">
      	<h5>Shipping Manifest Filter:</h5>
        <div class="row">
        	<div class="col m6 s12">
            	<label>Customer</label>
            	<select id="rm_customer" name="rm_customer">
                	<option value="">Please Select</option>
                    <option value="1">Customer A</option>
                    <option value="2">Customer B</option>
                </select>
            </div>
            <div class="col m6 s12">
            	<label>Receiving Date</label>
            	<div id="receiving_date" name="receiving_date" class="calendar"></div>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="waves-effect btn">Save</button>
            <button class="waves-effect btn">Clear</button>
        </div>
      </div>
      <div class="row">
          <fieldset>
              <legend>Shipping Manifests:</legend>
              <div class="row box">
                  <div class="row layout_table no-topmargin">
                    <div class="row heading">
                        <div class="col s2">Manifest Number</div>
                        <div class="col s3">Customer Name</div>
                        <div class="col s3">From</div>
                        <div class="col s2">To</div>
                        <div class="col s2 center-align">Action</div>
                    </div>
                    @foreach($shipping_manifests as $manifest)
                    <div class="row records_list">
                        <div class="col s2">{{$manifest->id}}</div>
                        <div class="col s3">{{$manifest->customer->id}}</div>
                        <div class="col s3">{{$manifest->date_from}}</div>
                        <div class="col s2">{{$manifest->date_to}}</div>
                        <div class="col s2 center-align"><a href="/admin/receiving-manifest/receipt/{{$manifest->id}}">View</a></div>
                    </div>
                    @endforeach
                  </div>
              </div>
          </fieldset>
      </div>
    </div>
</div>
</section>

<!-- /Main Content -->
@endsection

@section('js')
	<script type="text/javascript">
    	$(document).ready(function(e) {
			$("#rm_customer, #sp_customer").jqxComboBox({width: '100%', autoDropDownHeight: true});
			$(".calendar").jqxDateTimeInput({min: new Date(), width: 'auto', height: '25px', formatString: 'dd-MM-yyyy' });
		});
    </script>
@endsection