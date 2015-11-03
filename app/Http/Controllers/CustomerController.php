<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemRelation;
use DB;
class CustomerController extends Controller
{
    public function getIndex()
    {
        return view('admin.customers.index');
    }

    public function getCreate()
    {
        $parent_items = DB::select(DB::raw('SELECT items.id,items.name FROM `items` where id not in (select child_id from item_relation) AND items.status=1'));
        return view('admin.customers.add',["parent_items"=>$parent_items]);
    }
    public function postCreate(Request $request){
        
    }
    public function getGetChildren($id){
        $sql = "select items.id,items.name from items join item_relation on items.id=item_relation.child_id where items.status=1 AND item_relation.parent_id='" . $id . "'";
        $items = DB::select(DB::raw($sql));
        $return="<select name='child_item' id='child_item'>";
        foreach($items as $item){
            $return.="<option value='".$item->id."'>".$item->name."</option>";
        }
        return $return."</select>";
    }
    public function getItemDetail($id){
        $item=Item::find($id);
        $sql = "select items.* from items join item_relation on items.id=item_relation.parent_id where items.status=1 AND item_relation.child_id='" . $id . "'";
        $parent_item = DB::select(DB::raw($sql));
        if($parent_item){
            $parent_item=$parent_item[0];
        }
        return view('admin.customers.itemDetail',['item'=>$item,"parent"=>$parent_item]);    
    }
    public function getShow($id)
    {
        //
    }

    public function getEdit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
