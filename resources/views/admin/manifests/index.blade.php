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
    
    <div class="col s6">
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
</section>

<!-- /Main Content -->
@endsection

@section('js')
@endsection