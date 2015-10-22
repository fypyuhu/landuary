<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemRelation;
use DB;

class ItemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {

        return view('admin.items', ['items' => Item::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request) {
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
        $items = DB::select(DB::raw('SELECT * FROM `items` where id not in (select child_id from item_relation)'));

        $data = array();
        foreach ($items as $item) {
            $row = array();
            $row["name"] = "<b>" . $item->name . "</b>";
            $row["item_number"] = "<b>" . $item->item_number . "</b>";
            $row["weight"] = "<b>" . $item->weight . "</b>";
            $row["transaction_type"] = "<b>" . $item->transaction_type . "</b>";
            $row["actions"] = "<b>test</b>";
            $data[] = $row;
            $sql = "select items.* from items join item_relation on items.id=item_relation.child_id where item_relation.parent_id='" . $item->id . "'";
            $sub_items = DB::select(DB::raw($sql));
            foreach ($sub_items as $sub_item) {
                $sub_row = array();
                $sub_row["name"] =$sub_item->name;
                $sub_row["item_number"] =$sub_item->item_number;
                $sub_row["weight"] =$sub_item->weight;
                $sub_row["transaction_type"] = $sub_item->transaction_type;
                $sub_row["actions"] = "test";
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
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
