<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReplaceOrder;
use App\Models\ReplaceOrderDetail;
use App\Models\Storehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReplaceOrderController extends Controller
{
    public function index()
 {
    $data['ReplaceOrders'] = ReplaceOrder::all();
        $last_inserted_id = (ReplaceOrder::latest()->first()) ? ReplaceOrder::latest()->first()->id + 1 : 1;
        $data['lastId'] = str_pad($last_inserted_id, 7, 0, STR_PAD_LEFT);
    return view('replacement.replacementinvoice')->with($data);
 }



 public function create()// تمام
 {
     $data['replaceOrders']= ReplaceOrder::paginate(10);
     $data['replaceOrderDetails']=ReplaceOrderDetail::all();
     return view('replacement.repalceshow')->with($data);
 }


 public function show(ReplaceOrder $replaceOrder)
 {
    $data['replaceOrder']=$replaceOrder;
    $data['ReplaceOrderDetails'] = $replaceOrder->ReplaceOrderDetails;

    //dd($data['ReturnOrder']);


  // $data['ReturnOrderDetails'] = ReturnOrderDetails::where('return_orders_id',$ReturnOrder->id)->first();


     return view('replacement.replaceShowDeatil')->with($data);
 }

 public function store(Request $request)
 {

   // dd($request->all());
     $request->validate([
         'replaceInvoiceType' => 'required|string|max:255',
         'replaceNumberInvoice' => 'required|string',
         'replaceCustomerType' => 'required|string|max:255',
         'replaceCustomerCodeInvoice' => 'required|string',
         'replaceCustomerNameInvoice' => 'required|string',
         'replaceCustomerPhoneNumberInvoice' => 'required|string',
         'item_id' => 'array',
         'item_id.*' => 'required|exists:items,id',
         'replaceQuantityInvoice' => 'array',
         'replaceQuantityInvoice.*' => 'required',
         'replaceNotesInvoice' => 'array',
         'replaceNotesInvoice.*' => 'nullable',



     ]);



     DB::beginTransaction();
     $replaceTotalItems = count($request->item_id);

     // create order - user_id => auth()->user()
     $replaceOrder = ReplaceOrder::create([
         'user_id' => auth()->user()->id,
         'replaceInvoiceType' => $request->replaceInvoiceType,
         'replaceNumberInvoice' => $request->replaceNumberInvoice,
         'replaceCustomerType' => $request->replaceCustomerType,
         'replaceCustomerCodeInvoice' => $request->replaceCustomerCodeInvoice,
         'replaceCustomerNameInvoice' => $request->replaceCustomerNameInvoice,
         'replaceCustomerPhoneNumberInvoice' => $request->replaceCustomerPhoneNumberInvoice,
         'replaceTotalItems' => $replaceTotalItems,
     ]);

     for ($i = 0; $i < $replaceTotalItems; $i++) {
         // loop and create order details
         ReplaceOrderDetail::create([
             'replace_order_id' => $replaceOrder->id,
             'item_id' => $request->item_id[$i],
             'replaceQuantityInvoice' => $request->replaceQuantityInvoice[$i],
             'replaceNotesInvoice' => $request->replaceNotesInvoice[$i],
         ]);

         // edit storehouse
         $storehouse = Storehouse::where('item_id', $request->item_id[$i])->first();

         $newQuantity = $storehouse->quantity - $request->replaceQuantityInvoice[$i];
         $storehouse->update([
             'quantity' => $newQuantity,
         ]);
     }

     $request->session()->flash('msg', 'عمليه ناجحه');
     DB::commit();
     return  redirect("/replaceShowDeatil/$replaceOrder->id"); // redirect to return
 }

}
