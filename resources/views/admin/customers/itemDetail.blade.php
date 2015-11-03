<div class="row records_list" >
    <div class="col s3" id="t-category-rec">{{$parent->name or $item->name}}</div>
    <div class="col s2">@if($parent) {{$item->name}} @else N/A @endif</div>
    <div class="col s2 right-align">{{$item->weight or $parent->weight}}</div>
    <div class="col s3" id="t-type-rec">{{$item->transaction_type or $parent->transaction_type}}</div>
    <div class="col s2 center-align" style="padding:4px;">
        <input type="checkbox" name="chkbx_taxable[{{$item->id}}]" id="chkbx_taxable_{{$item->id}}" value="{{$item->id or $parent->id}}">
        <label for="chkbx_taxable_{{$item->id}}"></label>
    </div>
    <div class="col s2 price-field" style="display:none;"  >
        <div class="input-field"><input type="text" name="price_field[{{$item->id}}]"/></div>
    </div>
</div>