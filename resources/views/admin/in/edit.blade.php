<div id="clone-container" class="hidden">
    <div class="row records_list">
        <div class="col s4" style="padding: 7px 7px 8px;">
            <select name="gender">
                <option value="" disabled>Item Number</option>
                <option value="male" selected="selected">01</option>
                <option value="female">02</option>
                <option value="other">03</option>
                <option value="other">04</option>
            </select>
        </div>
        <div class="col s4 right-align"><div class="input-field"><input type="text" value="4" /></div></div>
        <div class="col s4 center-align btn-icons" style="padding: 7px;">
            <button class="waves-effect btn" title="delete">x</button>
        </div>
    </div>
</div>

<div class="row s12">
    <fieldset id="add-record">
      <legend>Edit Cart</legend>
      <form action="#!">
      <div class="row">
        <div class="col s6">
            <label>Cart Number:</label>
            <div class="input-field">
              <input id="customer_number" type="text" name="customer_number" value="10" disabled="disabled">
            </div>
        </div>
      </div>
      <div class="row">
        <ul class="ctabs">
            <li data-corr-div-id="#cart-info-tab">Cart Information</li>
            <li data-corr-div-id="#items-tab">Items</li>
        </ul>
      </div>
      <div class="row tab-content-group">
          <div class="row tab-content no-topmargin first" id="cart-info-tab">
              <fieldset>    
                  <legend>Cart Information</legend>
                  <div class="row">
                    <div class="col s12">
                      <label>Customer Number</label>
                      <div class="input-field">
                          <select name="gender" disabled="disabled">
                            <option value="" disabled>Customer Number</option>
                            <option value="male" selected="selected">100</option>
                            <option value="female">110</option>
                            <option value="other">120</option>
                            <option value="other">130</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col m6 s12">
                      <label>Gross Weight</label>
                      <div class="input-field">
                        <input id="tare_weight" type="text" name="tare_weight">
                      </div>
                    </div>
                    <div class="col m6 s12">
                      <label>Net Weight</label>
                      <div class="input-field">
                        <input id="tare_weight" type="text" name="tare_weight">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <label>Ship Date</label>
                      <div class="input-field">
                          <select name="gender">
                            <option value="" disabled selected>Ship Date</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col pull-right">
                      <button class="waves-effect btn">Save</button>
                      <button class="waves-effect btn">Clear</button>
                      <button class="waves-effect btn">Exit</button>
                    </div>
                  </div>
              </fieldset>
          </div>
          <div class="row tab-content no-topmargin" id="items-tab">
              <fieldset>
                  <legend>Items List:</legend>
                  <div class="row box">
                      <div class="row layout_table" id="items_list_table">
                        <div class="row heading">
                            <div class="col s4">Item Number</div>
                            <div class="col s4 right-align">Quantity</div>
                            <div class="col s4 center-align">Actions</div>
                        </div>
                        <div class="row records_list">
                            <div class="col s4" style="padding: 7px 7px 8px;">
                                <select name="gender">
                                    <option value="" disabled>Item Number</option>
                                    <option value="male" selected="selected">01</option>
                                    <option value="female">02</option>
                                    <option value="other">03</option>
                                    <option value="other">04</option>
                                </select>
                            </div>
                            <div class="col s4 right-align"><div class="input-field"><input type="text" value="4" /></div></div>
                            <div class="col s4 center-align btn-icons" style="padding: 7px;">
                                <button class="waves-effect btn" title="delete">x</button>
                            </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col pull-left">
                          <button class="waves-effect btn create-clone-button" data-corr-div-id="#clone-container">Add Another Item</button>
                        </div>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col pull-right">
                      <button class="waves-effect btn">Save</button>
                      <button class="waves-effect btn">Clear</button>
                      <button class="waves-effect btn">Exit</button>
                    </div>
                  </div>
              </fieldset>
          </div>
      </div>
      </form>
    </fieldset>
</div>