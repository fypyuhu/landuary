<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditItemRequest;
use App\Http\Requests\AddItemRequest;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemRelation;
use DB;
use Auth;
class ItemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {

        return view('admin.items');
    }

    public function getCreate() {

        return view('admin.addItem', ['items' => Item::organization()->get()]);
    }
	
	public function getAddItemForm() {
		return view('admin.addItemForm', ['items' => Item::organization()->get()]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(AddItemRequest $request) {
        $item = new Item;
        $item->name = $request->item_name;
        $item->item_number = $request->item_number;
        $item->description = $request->item_desc;
        $item->weight = $request->item_weight;
        $item->transaction_type = $request->transaction_type;
        $item->save();
        if ($request->has('show_parent_item_div')) {
            $relation = new ItemRelation;
            $relation->parent_id = $request->parent_item;
            $relation->child_id = $item->id;
            $relation->save();
        }
    }

    public function getShow(Request $request) {
		$search_filter = '';
		if ($request->has('search_string'))
			$search_filter = " and name like '%$request->search_string%' or item_number = '$request->search_string'";
			
        $items = DB::select(DB::raw("SELECT * FROM `items` where id not in (select child_id from item_relation) AND items.status=1 $search_filter and items.organization_id = ".Auth::user()->organization_id));
        $data = array();
        foreach ($items as $item) {
            $row = array();
            $row["name"] = $item->name;
            $row["item_number"] = $item->item_number;
            $row["status"] = '1';
            $row["weight"] = $item->weight;
            $row["transaction_type"] = $item->transaction_type;
            $row["actions"] = '<a href="/admin/items/edit/' . $item->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/items/delete/' . $item->id . '" data-mode="ajax">Delete</a>';
            $data[] = $row;
            $sql = "select items.* from items join item_relation on items.id=item_relation.child_id where items.status=1 AND item_relation.parent_id='" . $item->id . "' and items.organization_id = ".Auth::user()->organization_id;
            $sub_items = DB::select(DB::raw($sql));
            foreach ($sub_items as $sub_item) {
                $sub_row = array();
                $sub_row["name"] = $sub_item->name;
                $sub_row["item_number"] = $sub_item->item_number;
                $sub_row["status"] = '0';
                $sub_row["weight"] = $sub_item->weight;
                $sub_row["transaction_type"] = $sub_item->transaction_type;
                $sub_row["actions"] = '<a href="/admin/items/edit/' . $sub_item->id . '" data-mode="ajax" >Edit</a> / <a href="/admin/items/delete/' . $sub_item->id . '" data-mode="ajax">Delete</a>';
                $data[] = $sub_row;
            }
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        return view('admin.editItem', ['current' => Item::find($id), 'items' => Item::organization()->get(), 'parent' => ItemRelation::/*organization()->*/where('child_id', '=', $id)->first()]);
    }

    public function postEdit($id, EditItemRequest $request) {
        $item = Item::find($id);
        $item->name = $request->item_name;
        $item->item_number = $request->item_number;
        $item->description = $request->item_desc;
        $item->weight = $request->item_weight;
        $item->transaction_type = $request->transaction_type;
        $item->save();
        ItemRelation::where('child_id', '=', $id)->delete();
        if ($request->has('show_parent_item_div')) {
            $relation = new ItemRelation;
            $relation->parent_id = $request->parent_item;
            $relation->child_id = $item->id;
            $relation->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id) {
        return view('admin.deleteItem', ['id' => $id, 'isParent' => ItemRelation::where('parent_id', '=', $id)->first()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDelete($id, Request $request) {
        $item = Item::find($id);
        $item->status = 0;
        $item->save();
        if ($request->has('parent')) {
            DB::statement("Update `items` Set items.status='0' where id in (select child_id from item_relation where parent_id='" . $id . "')");
        }
    }

}
