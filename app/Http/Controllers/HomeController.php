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
        echo"";
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
