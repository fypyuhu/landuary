@extends('master')
@section('content')
  <!-- Main Content -->
  <section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Invoices</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Invoices</a>
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
    	<div class="col s12">
          <fieldset>
              <legend>Select Cart(s):</legend>
              <div class="row">
                  <div class="col m6 s12">
                      <div class="row">
                        <div class="col m6 s12">
                            <label>Select Customer:</label>
                            <select name="r_customer" id="r_customer" class="dropdown">
                                <option value="-1">Please Select</option>
                            </select>
                        </div>
                        <div class="col m6 s12">
                            <label>Select Department:</label>
                            <select name="r_department" id="r_department" class="dropdown">
                                <option value="-1">Please Select</option>
                            </select>
                        </div>
                      </div>
                      <div class="row">
                      	<div class="col m6 s12">
                        	<label>Status:</label>
                            <select name="r_department" id="r_department" class="dropdown">
                                <option value="-1">Please Select</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="col m6 s12">&nbsp;</div>
                      </div>
                      <div class="row">
                        <div class="col m6 s12">
                            <label>Date Generated:</label>
                            <div name="date_generated" id="date_generated" class="datepicker"></div>
                        </div>
                        <div class="col m6 s12">
                            <label>Due Date:</label>
                            <div name="due_date" id="due_date" class="datepicker"></div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row box">
                  <div class="row layout_table no-topmargin">
                    <div class="row heading">
                        <div class="col s2">Date Generated</div>
                        <div class="col s2">Customer</div>
                        <div class="col s2">Department</div>
                        <div class="col s1 right-align">Amount</div>
                        <div class="col s2">Status</div>
                        <div class="col s2">Due Date</div>
                        <div class="col s1 center-align">Actions</div>
                    </div>
                    <div class="row records_list">
                        <div class="col s2">10-02-2015</div>
                        <div class="col s2">Hadden Scott<br />#: 1235456</div>
                        <div class="col s2">Cardialogy<br />#: 1231456</div>
                        <div class="col s1 right-align">$500</div>
                        <div class="col s2">
                        	<select class="dropdown">
                            	<option>Select</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="col s2">10-02-2015</div>
                        <div class="col s1 center-align"><a href="/admin/invoices/invoice" class="edit-button">View</a></div>
                    </div>
                    <div class="row records_list">
                        <div class="col s2">10-02-2015</div>
                        <div class="col s2">Hadden Scott<br />#: 1235456</div>
                        <div class="col s2">Cardialogy<br />#: 1231456</div>
                        <div class="col s1 right-align">$500</div>
                        <div class="col s2">
                        	<select class="dropdown">
                            	<option>Select</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="col s2">10-02-2015</div>
                        <div class="col s1 center-align"><a href="/admin/invoices/invoice" class="edit-button">View</a></div>
                    </div>
                  </div>
              </div>
          </fieldset>
        </div>
    </div>
  </section>
  
  <!-- /Main Content -->
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $(".dropdown").jqxComboBox({autoComplete: true, width: '100%', autoDropDownHeight: true});
		$(".datepicker").jqxDateTimeInput({ width: 'auto', height: '25px', formatString: 'dd-MM-yyyy'});
	});
</script>
@endsection