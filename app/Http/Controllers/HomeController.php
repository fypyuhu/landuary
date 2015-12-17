<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\OutgoingCart;
use stdClass;
use App\Models\Customer;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $object = new stdClass();
        $start_date=Date("Y-m-d H:s:i",strtotime("-1 month"));
        $end_date=Date("Y-m-d H:s:i",time());
        $e_date=Date("Y-m-d",time());
        $object->unPaid=Invoice::organization()->where('status','=','Unpaid')->whereBetween('created_at', [$start_date,$end_date])->sum('total_price');
        $object->overDue=Invoice::organization()->where('status','=','Unpaid')->where('due_date','<=',$e_date)->sum('total_price');
        $object->paid=Invoice::organization()->where('status','=','Paid')->whereBetween('created_at', [$start_date,$end_date])->sum('total_price');
        $object->profit=Invoice::profitByCutomer();
        $object->readyCart=OutgoingCart::organization()->where('status','=','Ready')->count();
        $s_date=Date("Y-m-d",strtotime("-1 week"));
        $object->dueInvoice=Invoice::organization()->where('status','=','Unpaid')->whereBetween('due_date', [$s_date,$e_date])->count();
        return view('admin.index',['income'=>$object]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReconciliation()
    {
        $customers=Customer::organization()->get();
        return view("admin.invoices.reconciliation",["customers"=>$customers]);
    }

    public function getWeightData(Request $request)
    {
        $result=Invoice::getReconciliationData($request);
        $json = '{
		  "cols": [
				{"id":"","label":"Rewash Date","pattern":"","type":"string"},
				{"id":"","label":"In","pattern":"","type":"number"},
                                {"id":"","label":"Out","pattern":"","type":"number"},
			  ],
		  "rows": [';
		  		foreach($result as $key=>$value) {
                                    $date=Date("d-m-Y",time());
                                    $in_weight=0;
                                    $out_weight=0;
                                    if($value->in_date){
                                        $date=$value->in_date;
                                    }else{
                                        $date=$value->out_date;
                                    }
                                    if($value->in_weight){
                                        $in_weight=$value->in_weight;
                                    }
                                    if($value->out_weight){
                                        $out_weight=$value->out_weight;
                                    }
					$json .= '{"c":[{"v":"'.date('d-m-Y',strtotime($date)).'","f":null},{"v":'.$in_weight.',"f":null},{"v":'.$out_weight.',"f":null}]}';
					if(count($result) > 1 && $key < count($result)-1)
						$json .= ',';
				}
			  $json .= ']}';
        return $json;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
