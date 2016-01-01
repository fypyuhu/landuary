@extends('master')
@section('content')

<div id="clone-container" class="hidden">
    <div class="row records_list">
        <div class="col m4 s12">
            <label>Component Name</label>
            <div class="input-field">
                <input type="text" name="component_name[]" class="component_name" />
            </div>
            <label class="error">Example: New York City or Santa Clara County</label>
        </div>
        <div class="col m4 s12">
            <label>Agency Name</label>
            <div class="input-field">
                <input type="text" name="component_agency_name[]" class="component_agency_name" />
            </div>
            <label class="error">Example: Arizona Dept. of Revenue</label>
        </div>
        <div class="col m3 s12">
            <label>Rate</label>
            <div class="input-field">
                <input type="text" name="component_tax_rate[]" class="component_tax_rate" />
            </div>
            <label class="error">%</label>
        </div>
        <div class="col m1 s12" style="padding-top:26px;">
            <a href="javascript:void(0);" onclick="$(this).parent().parent().remove();" class="waves-effect btn">X</a>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="content-wrap" id="tax-page">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Manage Tax</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Manage Tax</a>
            </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
    <a data-mode="ajax" href="/admin/taxes/create" class="waves-effect btn create-clone-button">Add Tax</a>
    <div class="row no-rightmargin">
          <div class="col s9">
              <fieldset>
                  <legend>Tax List:</legend>
                  <div class="row box">
                    <div id="jqxgrid"></div>
                  </div>
                  <div class="row">
                    <div class="pull-right">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'xls', 'items');" src="{{URL::asset('images/xls_icon.png')}}" alt="Export to XLS">
                        <img class="export-button" onclick="$('#jqxgrid').jqxGrid('exportdata', 'pdf', 'items');" src="{{URL::asset('images/pdf_icon.png')}}" alt="Export to PDF">
                    </div>
                  </div>
              </fieldset>
          </div>
    </div>

  </section>
<!-- /Main Content -->
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{url('admin/taxes/show')}}";
        // prepare the data
        var source =
                {
                    datatype: "json",
                    datafields: [
						{name: 'tax_type'},
                        {name: 'tax_name'},
						{name: 'component_name'},
                        {name: 'agency_name'},
                        {name: 'tax_rate'},
                        {name: 'actions'}
                    ],
                    id: 'id',
                    url: url,
                    root: 'data'
                };
        var dataAdapter = new $.jqx.dataAdapter(source);
		
        $("#jqxgrid").jqxGrid(
                {
                    width: "100%",
                    source: dataAdapter,
                    pageable: true,
                    autoheight: true,
                    sortable: true,
                    filterable: true,
                    columns: [
						{text: 'Tax Type', dataField: 'tax_type', sortable:false},
                        {text: 'Tax Name', dataField: 'tax_name', sortable:false},
						{text: 'Component Name', dataField: 'component_name', sortable:false},
                        {text: 'Agency Name', dataField: 'agency_name', sortable:false},
                        {text: 'Tax Rate', dataField: 'tax_rate', sortable:false},
                        {text: 'Actions', cellsalign: 'center', dataField: 'actions',sortable:false,filterable:false,exportable:false}
                    ]
                });
    });
</script>

@endsection