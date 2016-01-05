<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\UserProfile;
use App\Models\Invoice;
use App\Models\InitialValue;
use App\Models\Customer;
use App\Models\CustomerDepartment;
use App\Models\ShipManifest;
use App\Models\CustomerTax;
use App\Models\Tax;
use App\Models\CustomerBilling;
use App\Models\TaxComponent;
use App\Models\OutgoingCart;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $customers=Customer::organization()->get();
        return view('admin.invoices.index',["customers"=>$customers]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate(){
        $customers=Customer::organization()->get();
		
		$rec_id = '';
		$current_customer = '';
		if (session('status')) {
			$last_rec = Invoice::orderBy('id', 'desc')->first();
			$rec_id = $last_rec->id;
			$current_customer = $last_rec->customer_id;
		}
        return view('admin.invoices.create',["customers"=>$customers, 'rec_id' => $rec_id, 'current_customer' => $current_customer]);
    }
    public function postCreate(Request $request)
    {
        $invoice=new Invoice;
        $initial_values = InitialValue::where('organization_id', '=', Auth::user()->organization_id)->first();
        $invoice->customer_id=$request->customer;
        $invoice->invoice_number=$initial_values->invoice_number;
        $invoice->manifest_ids=implode(",",$request->manifests);
        $invoice->department_ids=implode(",",$request->department);
        $customer_tax=CustomerTax::where('customer_id','=',$request->customer)->first();
        $tax_data=Tax::getTaxRateById($customer_tax->tax_id);
        $tax=0.00;
        if($tax_data[0]->tax_type=="single"){
            $tax+=$tax_data[0]->tax_rate;
        }else{
            $tax+=$tax_data[0]->accumulative_rate;
        }
        $invoice_data=Invoice::getInvoicePriceByManifestIds($invoice->manifest_ids,$request->customer);
        $net_weight=0.00;//net weight of invoice
        $price_by_item=0.00;// item price calucated based on billing by price
        $price_by_weight=0.00;// item price calculated based on billing by weight
        $item_by_price_weight=0.00;// weight of items based on billing by price
        $taxable_weight=0.00;
        $custom_price=0.00;
        $tax_on_weight_items=0.00;
        $tax_on_price_items=0.00;
        $total_tax=0.00;
        $total_price=0.00;
        $temp=array();
        foreach($invoice_data as $data){
            $custom_price=$data->custom_price;
            if(!in_array($data->cart_id,$temp)){
                $net_weight+=$data->net_weight;
                $temp[]=$data->cart_id;
            }
            if($data->billing_by==0){
                if($data->taxable==1){
                    $taxable_weight+=$data->weight*$data->quantity;
                }
            }
            else{
                $item_by_price_weight+=$data->weight*$data->quantity;
                $price_by_item+=$data->price*$data->quantity;
                if($data->taxable==1){
                    $tax_on_price_items+=($data->price*$data->quantity)*($tax/100);
                }
            }
        }
        $net_weight-=$item_by_price_weight;
        $tax_on_weight_items+=($taxable_weight*$custom_price)*($tax/100);
        $price_by_weight+=($net_weight*$custom_price)+$tax_on_weight_items;
        $price_by_item+=$tax_on_price_items;
        $total_tax+=$tax_on_price_items+$tax_on_weight_items;
        $total_price+=$price_by_weight+$price_by_item;
        $invoice->total_price=$total_price;
        $invoice->total_tax=$total_tax;
        $invoice->price=($total_price-$total_tax);
        $customer_billing=CustomerBilling::where('customer_id','=',$request->customer)->first(['due_date']);
        $invoice->due_date=date('Y-m-d',strtotime(' +'.$customer_billing->due_date.' day'));
        $invoice->save();
        $initial_values->invoice_number+=1;
        $initial_values->save();
        foreach($request->manifests as $manifest_id){
            $manifest=ShipManifest::find($manifest_id);
            $manifest->invoiced=1;
            $manifest->save();
            $out_going_carts=explode(",",$manifest->outgoing_cart_id);
            foreach($out_going_carts as $out_going_cart_id){
                $out_going_cart=OutgoingCart::find($out_going_cart_id);
                $out_going_cart->invoiced=1;
                $out_going_cart->save();
            }
        }
        //return redirect('/admin/invoices/receipt/' . $invoice->id);
		return redirect('/admin/invoices')->with('status', 'Invoice has been created successfully.');
    }
	
    public function getDetails($id,$department_ids=""){
        $active_customer=Customer::find($id);
        $customers=Customer::organization()->get();
        $departments=CustomerDepartment::where('customer_id','=',$id)->get();
        $ship_manifests=ShipManifest::getManifestsForInvoice($id,$department_ids);
        return view('admin.invoices.details',["ship_manifests"=>$ship_manifests,"customers"=>$customers,"active_customer"=>$active_customer,"departments"=>$departments,"department_ids"=>explode(",",$department_ids)]);
    }
	
   public function getReceipt($id){
       $user=UserProfile::where('user_id','=',Auth::user()->id)->first();
       $invoice=Invoice::find($id);
       $customer=Customer::find($invoice->customer_id);
       $invoice_data=Invoice::getInvoicePriceByManifestIds($invoice->manifest_ids,$invoice->customer_id);
	   if(strpos($invoice->department_ids, '-1') === false) {
       		$departments=CustomerDepartment::whereRaw("FIND_IN_SET(id,'".$invoice->department_ids."')")->get();
	   } else {
	   		$departments=CustomerDepartment::all();
	   }
       $customer_tax=CustomerTax::where('customer_id','=',$invoice->customer_id)->first();
       $tax=Tax::find($customer_tax->tax_id);
       $tax_componenets=TaxComponent::where('tax_id','=',$tax->id)->get();
       $tax_data=Tax::getTaxRateById($tax->id);
       return view('admin.invoices.receipt',["user"=>$user,
           "invoice"=>$invoice,
           "customer"=>$customer,
           "departments"=>$departments,
           "invoice_data"=>$invoice_data,
           "tax"=>$tax,
           "tax_componenets"=>$tax_componenets,
           "tax_data"=>$tax_data[0]
           ]);
   }
   
   public function getReceiptSummary($id){
       $user=UserProfile::where('user_id','=',Auth::user()->id)->first();
       $invoice=Invoice::find($id);
       $customer=Customer::find($invoice->customer_id);
       $invoice_data=Invoice::getInvoicePriceByManifestIds($invoice->manifest_ids,$invoice->customer_id);
	   if(strpos($invoice->department_ids, '-1') === false) {
       		$departments=CustomerDepartment::whereRaw("FIND_IN_SET(id,'".$invoice->department_ids."')")->get();
	   } else {
	   		$departments=CustomerDepartment::all();
	   }
       $customer_tax=CustomerTax::where('customer_id','=',$invoice->customer_id)->first();
       $tax=Tax::find($customer_tax->tax_id);
       $tax_componenets=TaxComponent::where('tax_id','=',$tax->id)->get();
       $tax_data=Tax::getTaxRateById($tax->id);
       return view('admin.invoices.receipt',["user"=>$user,
           "invoice"=>$invoice,
           "customer"=>$customer,
           "departments"=>$departments,
           "invoice_data"=>$invoice_data,
           "tax"=>$tax,
           "tax_componenets"=>$tax_componenets,
           "tax_data"=>$tax_data[0]
           ]);
   }
   
   public function getShow(Request $request){
       if($request->department!=""){
            $invoices=Invoice::with('customer')->organization()->where('customer_id', '=', $request->name)->where('status', '=', $request->status)->whereBetween('created_at', [date("Y-m-d", strtotime($request->from_date)), date("Y-m-d 23:29:29", strtotime($request->to_date))])->whereRaw("FIND_IN_SET('".$request->department."',department_ids)")->skip($request->recordstartindex)->take($request->pagesize)->get();
       }
       else{
           $invoices=Invoice::with('customer')->organization()->where('customer_id', '=', $request->name)->where('status', '=', $request->status)->whereBetween('created_at', [date("Y-m-d", strtotime($request->from_date)), date("Y-m-d 23:29:29", strtotime($request->to_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
       }
       $data = array();
       foreach($invoices as $invoice){
           $row=array();
           //$row["created_date"]=$invoice->created_at->format('d m Y');
		   $row["created_date"]= date('d F, Y', strtotime($invoice->created_at));
           $row["customer"]=$invoice->customer->name;
           $departments=CustomerDepartment::whereRaw("FIND_IN_SET(id,'".$invoice->department_ids."')")->get();
           $row["department"]="";
           foreach($departments as $department){
               $row["department"].=$department->department_name.", ";
           }
           $row["amount"]=$invoice->total_price;
           if($invoice->status=="Unpaid"){
               $row["status"]='<input type="checkbox" value="'.$invoice->id.'" name="invoice_status_'.$invoice->id.'" id="invoice_status_'.$invoice->id.'" class="invoice_status_checkbox">
                            <label for="invoice_status_'.$invoice->id.'"></label>';
           }
           else{
               $row["status"]='<input checked type="checkbox" value="'.$invoice->id.'" name="invoice_status_'.$invoice->id.'" id="invoice_status_'.$invoice->id.'" class="invoice_status_checkbox">
                            <label for="invoice_status_'.$invoice->id.'"></label>';
           }
           //$row["due_date"]=$invoice->due_date->format('d m Y');
		   $row["due_date"]= date('d F, Y', strtotime($invoice->due_date));
           $row["actions"]='<a href="/admin/invoices/receipt/' . $invoice->id . '">View</a>';;
           $data[] = $row;
       }
       echo "{\"data\":" . json_encode($data) . "}";
   }
   public function getChangeStatus($id,$status){
       $invoice=Invoice::find($id);
       $invoice->status=$status;
       $invoice->save();
   }
   public function getIncome(){
       $customers = Customer::organization()->get();
       return view('admin.invoices.income', ["customers" => $customers]);
   }
   public function getShowList(Request $request) {
        $invoices = Invoice::with('customer')->organization()->where('customer_id', '=', $request->name)->whereBetween('created_at', [date("Y-m-d", strtotime($request->from_date)), date("Y-m-d 23:29:29", strtotime($request->to_date))])->skip($request->recordstartindex)->take($request->pagesize)->get();
        $data = array();
        foreach ($invoices as $invoice) {
            $row = array();
            $row["invoice_number"] = $invoice->invoice_number;
            $row["customer"] = $invoice->customer->name;
            $row["total_price"] = $invoice->total_price;
            //$row["updated_at"] = $invoice->updated_at->format('d m Y');
			$row["updated_at"] = date('d F, Y', strtotime($invoice->updated_at));
            $data[] = $row;
        }
        echo "{\"data\":" . json_encode($data) . "}";
    }
}