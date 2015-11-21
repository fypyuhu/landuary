<div class="row records_list">
    <div class="col s3">{{$item->name}} <input type="hidden" class="item-cart" name="item_cart[]" value="{{$item->id}}" /></div>
    <div class="col s3">{{$item->description}}</div>
    <div class="col s2 right-align">{{$quantity}} <input type="hidden" name="item_quantity[]" value="{{$quantity}}" /></div>
    <div class="col s2 right-align">{{$item->weight}} kg/lb</div>
    <div class="col s2 right-align"><button  class="waves-effect btn" type="button" onclick="removeRow(this)">Remove</button></div>
</div>