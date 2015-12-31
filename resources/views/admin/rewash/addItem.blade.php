<script type="text/javascript">
	$(document).ready(function(){
		mousemove_counter = 0;
		if(mousemove_counter <= 0){
			layout_table_auto_height(mousemove_counter);
			mousemove_counter = 1;
		}
	});
</script>
<div class="row records_list">
    <div class="col s3">{{$item->name}} <input type="hidden" class="item-cart" name="item_cart[]" value="{{$item->id}}" /></div>
    <div class="col s3">{{$item->description}}</div>
    <div class="col s2 right-align quantity-div">{{$quantity}} <input type="hidden" name="item_quantity[]" value="{{$quantity}}" /></div>
    <div class="col s2 right-align weight-div">{{$item->weight}}</div>
    <div class="col s2 right-align"><button class="waves-effect btn" onclick="removeRow(this)">Remove</button></div>
</div>
