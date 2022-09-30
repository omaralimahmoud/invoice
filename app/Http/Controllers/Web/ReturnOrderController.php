<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ReturnOrder;
use App\Models\ReturnOrderDetails;
use App\Models\Storehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnOrderController extends Controller
{
    public function index()//تمام لايوجد بيه مشكله
    {
        $data['ReturnOrders'] = ReturnOrder::all();
        $last_inserted_id = (ReturnOrder::latest()->first()) ? ReturnOrder::latest()->first()->id + 1 : 1;
        $data['lastId'] = str_pad($last_inserted_id, 7, 0, STR_PAD_LEFT);
        // dd($data);
        return view('SalesReturn.return')->with($data);
    }

    public function create()// تمام
    {
        $data['returenOrders']= ReturnOrder::paginate(10);
        $data['returnOrderDetails']=ReturnOrderDetails::all();
        return view('SalesReturn.showReturenOrder')->with($data);
    }

////////////////////////////////////////////////////////////////


    public function store(Request $request)
    {

     //   dd($request->all());
        $request->validate([
            'returnInvoiceType' => 'required|string|max:255',
            'returnNumberInvoice' => 'required|string',
            'returnCustomerType' => 'required|string|max:255',
            'returnDiscountBercentageInvoice' => 'nullable|string|max:15',
            'returnNetInvoice' => 'required|string',
            'returnCustomerCodeInvoice' => 'required|string',
            'returnCustomerNameInvoice' => 'required|string',
            'returnCustomerPhoneNumberInvoice' => 'required|string',
            'item_id' => 'array',
            'item_id.*' => 'required|exists:items,id',
            'returnQuantityInvoice' => 'array',
            'returnQuantityInvoice.*' => 'required',
            'returnUnitSaleBriceInvoice' => 'array',
            'returnUnitSaleBriceInvoice.*' => 'required',
            'returnNotesInvoice' => 'array',
            'returnNotesInvoice.*' => 'nullable',
            'returnDiscountBercentageInvoice' => 'nullable',
            'returnRemoveDecimal' => 'nullable',
            'returnNetInvoice' => 'required',
        ]);



        DB::beginTransaction();
        $returnTotalItems = count($request->item_id);

        // create order - user_id => auth()->user()
        $returnOrder = ReturnOrder::create([
            'user_id' => auth()->user()->id,
            'returnInvoiceType' => $request->returnInvoiceType,
            'returnNumberInvoice' => $request->returnNumberInvoice,
            'returnCustomerType' => $request->returnCustomerType,
            'returnDiscountBercentageInvoice' => $request->returnDiscountBercentageInvoice,
            'returnRemoveDecimal' => $request->returnRemoveDecimal,
            'returnNetInvoice' => $request->returnNetInvoice,
            'returnCustomerCodeInvoice' => $request->returnCustomerCodeInvoice,
            'returnCustomerNameInvoice' => $request->returnCustomerNameInvoice,
            'returnCustomerPhoneNumberInvoice' => $request->returnCustomerPhoneNumberInvoice,
            'returnTotalItems' => $returnTotalItems,
        ]);

        for ($i = 0; $i < $returnTotalItems; $i++) {
            // loop and create order details
            ReturnOrderDetails::create([
                'return_order_id' => $returnOrder->id,
                'item_id' => $request->item_id[$i],
                'returnQuantityInvoice' => $request->returnQuantityInvoice[$i],
                'returnUnitSaleBriceInvoice' => $request->returnUnitSaleBriceInvoice[$i],
                'returnNotesInvoice' => $request->returnNotesInvoice[$i],
            ]);

            // edit storehouse
            $storehouse = Storehouse::where('item_id', $request->item_id[$i])->first();

            $newQuantity = $storehouse->quantity + $request->returnQuantityInvoice[$i];
            $storehouse->update([
                'quantity' => $newQuantity,
            ]);
        }

        $request->session()->flash('msg', 'عمليه ناجحه');
        DB::commit();
        return  redirect("/showDetails/$returnOrder->id"); // redirect to return
    }

    public function show(ReturnOrder $ReturnOrder)
    {
       $data['ReturnOrder']=$ReturnOrder;
       $data['ReturnOrderDetails'] = $ReturnOrder->ReturnOrderDetails;

       //dd($data['ReturnOrder']);


     // $data['ReturnOrderDetails'] = ReturnOrderDetails::where('return_orders_id',$ReturnOrder->id)->first();


        return view('SalesReturn.showDetails')->with($data);
    }


}
