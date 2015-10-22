@extends('master')
@section('content')
    <!-- Main Content -->
  <section class="content-wrap">


    <!-- Breadcrumb -->
    <div class="page-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <h1>Manage Items</h1>

          <ul>
            <li>
              <a href="#"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i>
            </li>

            <li><a href='dashboard.html'>Manage Items</a>
            </li>
          </ul>
        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->
    <a id="inline" href="#add-record" class="waves-effect btn create-clone-button">Add Item</a>
    <div class="row no-rightmargin">
          <div class="col s9">
          	  <div style="display: none">
                  <fieldset id="add-record">
                      <legend> Item:</legend>
                      <form method="POST" action="{{url('admin/items/create')}}" id="pageForm">
                          {{csrf_field()}}
                        <div class="row s12">
                            <label>Name:</label>
                            <div class="input-field">
                                <input id="item_name" type="text" name="item_name">
                            </div>
                            <label for="item_name" class="error" id="error-item-name"></label>
                        </div>
                        
                        <div class="row">
                            <input type="checkbox" name="show_parent_item_div" id="show_parent_item_div" data-corr-div-id="#parent-item-div" class="checkbox">
                            <label for="show_parent_item_div">This is a sub item.</label>
                        </div>
                        
                        <div class="row" style="display: none;" id="parent-item-div">
                          <label>Please select the parent item of this product:</label>
                          <div class="input-field">
                              <select name="parent_item">
                                <option value="" disabled selected>Select Parent Item</option>
                                <option value="1" selected="selected">Item A</option>
                                <option value="2">Item B</option>
                              </select>
                          </div>
                          <label for="parent_item" class="error" id="error-parent-item"></label>
                        </div>
                        
                        <div class="row s12">
                            <label>Number:</label>
                            <div class="input-field">
                                <input id="item_number" type="text" name="item_number">
                            </div>
                            <label for="item_number" class="error" id="error-item-number"></label>
                        </div>
                      
                      <div class="row">
                        <label>Description:</label>
                        <div class="input-field">
                            <input id="item_desc" type="text" name="item_desc">
                        </div>
                        <label for="item_desc" class="error" id="error-item-desc"></label>
                      </div>
                      <div class="row">
                        <div class="col m6 s12">
                          <label>Weight:</label>
                          <div class="input-field">
                            <input id="item_weight" type="text" name="item_weight">
                          </div>
                          <label for="item_weight" class="error" id="error-item-weight"></label>
                        </div>
                        <div class="col m6 s12">
                          <label>Transaction Type:</label>
                          <div class="input-field">
                              <select name="transaction_type">
                                <option value="" disabled selected>Please Select</option>
                                <option value="In">In</option>
                                <option value="Out">Out</option>
                                <option value="Both">Both</option>
                              </select>
                          </div>
                          <label for="transaction_type" class="error" id="error-transaction-type"></label>
                        </div>
                      </div>
                      <div class="row">
                        <button type="submit" class="waves-effect btn">Save</button>
                        <button class="waves-effect btn">Clear</button>
                      </div>
                      </form>
                  </fieldset>
              </div>
              
              <fieldset>
                  <legend>Items List:</legend>
                  <div class="row box">
                      <div class="row no-topmargin">
                        <div class="col s12">
                          <div class="input-field">
                            <input id="search_item" type="text" name="search_item" placeholder="Search by Item Name or Item Number">
                          </div>
                        </div>
                      </div>
                      <div class="row layout_table">
                        <div class="row heading">
                        	<div class="col s1 center-align chkbx">
                            	<input type="checkbox" name="use_departments" id="use_departments">
                      			<label for="use_departments"></label>
                            </div>
                        	<div class="col s2">Name</div>
                            <div class="col s2">Number</div>
                            <div class="col s2 right-align">Weight lb/kg</div>
                            <div class="col s2 center-align">Transaction Type</div>
                            <div class="col s3 center-align">Actions</div>
                        </div>
                        <div class="row records_list parent_item">
                        	<div class="col s1 center-align chkbx">
                            	<input type="checkbox" name="use_departments" id="use_departments">
                      			<label for="use_departments"></label>
                            </div>
                            <div class="col s2">Item A</div>
                            <div class="col s2">123456</div>
                            <div class="col s2 right-align">10</div>
                            <div class="col s2 center-align">Both</div>
                            <div class="col s3 center-align"><a href="?action=edit">Edit</a> / <a href="?action=delete">Delete</a></div>
                        </div>
                        <div class="row records_list">
                        	<div class="col s1 center-align chkbx">
                            	<input type="checkbox" name="use_departments" id="use_departments">
                      			<label for="use_departments"></label>
                            </div>
                            <div class="col s2">**Sub Item A</div>
                            <div class="col s2">768903</div>
                            <div class="col s2 right-align">8</div>
                            <div class="col s2 center-align">In</div>
                            <div class="col s3 center-align"><a href="?action=edit">Edit</a> / <a href="?action=delete">Delete</a></div>
                        </div>
                        <div class="row records_list">
                        	<div class="col s1 center-align chkbx">
                            	<input type="checkbox" name="use_departments" id="use_departments">
                      			<label for="use_departments"></label>
                            </div>
                            <div class="col s2">**Sub Item B</div>
                            <div class="col s2">768903</div>
                            <div class="col s2 right-align">8</div>
                            <div class="col s2 center-align">In</div>
                            <div class="col s3 center-align"><a href="?action=edit" class="edit-button">Edit</a><a href="#add-record" class="edit-button hidden">Edit</a> / <a href="?action=delete">Delete</a></div>
                        </div>
                        <div class="row records_list parent_item">
                        	<div class="col s1 center-align chkbx">
                            	<input type="checkbox" name="use_departments" id="use_departments">
                      			<label for="use_departments"></label>
                            </div>
                            <div class="col s2">Item B</div>
                            <div class="col s2">123456</div>
                           <div class="col s2 right-align">10</div>
                            <div class="col s2 center-align">Both</div>
                            <div class="col s3 center-align"><a href="?action=edit" class="edit-button">Edit</a><a href="#add-record" class="edit-button hidden">Edit</a> / <a href="?action=delete">Delete</a></div>
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#pageForm").validate({
			rules: {
				item_name: "required",
				parent_item: "required",
				item_number: {
					required: true,
					digits: true,
				},
				item_desc: "required",
				item_weight: "required",
				phone_number: "required",
				transaction_type: "required"
			}
		});
	});
</script>

@endsection