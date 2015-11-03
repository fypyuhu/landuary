<legend>Items List:</legend>
<div class="row box">
  <form method="post" action="{{url('admin/out/item')}}" id="itemForm">
  {{csrf_field()}}
  <div class="row no-topmargin">
    <div class="col m8 s12">
      <select name="item_id" id="item_id">
        <option value="">Item Number</option>
        @foreach($items as $item)
        <option value="{{$item->id}}">{{$item->item_number}}</option>
        @endforeach
      </select>
      <label for="item_id" class="error"></label>
    </div>
    <div class="col m4 s12">
      <div class="input-field">
        <input id="quantity" type="text" name="quantity" placeholder="Quantity">
      </div>
      <label for="quantity" class="error"></label>
    </div>
  </div>
  <div class="row">
    <button type="submit" class="waves-effect btn" id="button-add-item">Add</button>
    <button class="waves-effect btn">Edit</button>
    <button class="waves-effect btn">Remove</button>
    <button class="btn btn-disabled">Clear</button>
  </div>
  </form>
  <div class="row layout_table">
    <div class="row heading">
        <div class="col s3">Item Number</div>
        <div class="col s5">Item Description</div>
        <div class="col s2 right-align">Quantity</div>
        <div class="col s2 right-align">Weight</div>
    </div>
    <div class="row records_list">
        <div class="col s3">Item 1</div>
        <div class="col s5">Lorem Ipsum doller sit</div>
        <div class="col s2 right-align">4</div>
        <div class="col s2 right-align">4 KG</div>
    </div>
  </div>
</div>
<div class="row">
<div class="col m4 s12">
  <div class="input-field">
    <input id="gross_weight" type="text" name="gross_weight" placeholder="Gross Weight">
  </div>
</div>
<div class="col m4 s12">
  <div class="input-field">
    <input id="net_weight" type="text" name="net_weight" placeholder="Net Weight">
  </div>
</div>
</div>