<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Storehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        //
        $data['orders'] = Order::paginate(3);
        // $data['customers']= Customer::all();
        return view('sales.saless')->with($data);
    }



    public function create()
    {
        // dd(Order::all());
        $data['orders'] = Order::all();
        $last_inserted_id = (Order::latest()->first()) ? Order::latest()->first()->id + 1 : 1;
        $data['lastId'] = str_pad($last_inserted_id, 7, 0, STR_PAD_LEFT);
        //    dd($data);
        // $data = "hello";

        return view('invoice.invoices')->with($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'invoiceType' => 'required|string|max:255',
            'numberInvoice' => 'required|string',
            'customerType' => 'required|string|max:255',
            'discountBercentageInvoice' => 'nullable|integer|max:15',
            'netInvoice' => 'required|integer',
            'customerCodeInvoice' => 'required|string',
            'customerNameInvoice' => 'required|string',
            'CustomerPhoneNumberInvoice' => 'required|string',
            'item_id' => 'array',
            'item_id.*' => 'required|exists:items,id',
            'quantityInvoice' => 'array',
            'quantityInvoice.*' => 'required',
            'unitSaleBriceInvoice' => 'array',
            'unitSaleBriceInvoice.*' => 'required',
            'notesInvoice' => 'array',
            'notesInvoice.*' => 'nullable',
            'discountBercentageInvoice' => 'nullable',
            'removeDecimal' => 'nullable',
            'netInvoice' => 'required',
        ]);

        if (in_array($request->user()->role->name, ['superadmin', 'admin'])) {
            if ($request->discountBercentageInvoice > 50) {
                session()->flash('error', 'قيمه الخصم يجب الا تكون ازيد من 50');
                return back();
            }
        } else {
            if ($request->discountBercentageInvoice > 15) {
                session()->flash('error', 'قيمه الخصم يجب الا تكون ازيد من 15');
                return back();
            }
        }

        DB::beginTransaction();
        $totalItems = count($request->item_id);

        // create order - user_id => auth()->user()
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'invoiceType' => $request->invoiceType,
            'numberInvoice' => $request->numberInvoice,
            'customerType' => $request->customerType,
            'discountBercentageInvoice' => $request->discountBercentageInvoice,
            'removeDecimal' => $request->removeDecimal,
            'netInvoice' => $request->netInvoice,
            'customerCodeInvoice' => $request->customerCodeInvoice,
            'customerNameInvoice' => $request->customerNameInvoice,
            'CustomerPhoneNumberInvoice' => $request->CustomerPhoneNumberInvoice,
            'totalItems' => $totalItems,
        ]);

        for ($i = 0; $i < $totalItems; $i++) {
            // loop and create order details
            OrderDetail::create([
                'order_id' => $order->id,
                'item_id' => $request->item_id[$i],
                'quantityInvoice' => $request->quantityInvoice[$i],
                'unitSaleBriceInvoice' => $request->unitSaleBriceInvoice[$i],
                'notesInvoice' => $request->notesInvoice[$i],
            ]);

            // edit storehouse
            $storehouse = Storehouse::where('item_id', $request->item_id[$i])->first();
            if (is_null($storehouse)) {
                $itemName = Item::where('id', $request->item_id)->first()->itemProductName;
                $request->session()->flash('error', "هذه الكميه غير متوفره في هذا المنتج - {$itemName}");
                DB::rollBack();
                return back();
            }
            if ($request->quantityInvoice[$i] > $storehouse->quantity) {
                $request->session()->flash('error', "هذه الكميه غير متوفره في هذا المنتج - {$storehouse->item->itemProductName} - الكميه المتوفره هي : {$storehouse->quantity}");
                DB::rollBack();
                return back();
            }
            $newQuantity = $storehouse->quantity - $request->quantityInvoice[$i];
            $storehouse->update([
                'quantity' => $newQuantity,
            ]);
        }

        $request->session()->flash('msg', 'عمليه ناجحه');
        DB::commit();
        return  redirect("/sales/orderDetails/show/$order->id"); // redirect to show
    }


    public function show(Order $order)
    {
        $data['order'] = $order;
        $data['orderDetails'] = $order->details;

        return view('sales.show')->with($data);
    }


    public function edit(Order $order)
    {
        $data['order'] = $order;
        $data['orderDetails'] = $order->details;

        return view('sales.salesUpdate')->with($data);
    }


    public function update(Request $request)
    {

        $request->validate([
            'invoiceType' => 'required|string|max:255',
            'discountBercentageInvoice' => 'nullable|integer|max:15',
            'netInvoice' => 'required|integer',
            'item_id' => 'array',
            'item_id.*' => 'required|exists:items,id',
            'quantityInvoice' => 'array',
            'quantityInvoice.*' => 'required',
            'unitSaleBriceInvoice' => 'array',
            'unitSaleBriceInvoice.*' => 'required',
            'notesInvoice' => 'array',
            'notesInvoice.*' => 'nullable',
            'discountBercentageInvoice' => 'nullable|integer',
            'removeDecimal' => 'nullable',
            'netInvoice' => 'required',
        ]);
        DB::beginTransaction();
        $totalItems = count($request->item_id);
        $order = Order::findOrFail($request->id)->update([
            // 'user_id' => auth()->user()->id,
            'invoiceType' => $request->invoiceType,
            'discountBercentageInvoice' => $request->discountBercentageInvoice,
            'removeDecimal' => $request->removeDecimal,
            'netInvoice' => $request->netInvoice,
            'totalItems' => $totalItems,
        ]);

        $orderDetails = '';



        for ($i = 0; $i < $totalItems; $i++) {
            // loop and create order details
            OrderDetail::findOrFail($request->id)->update([
                'item_id' => $request->item_id[$i],
                'quantityInvoice' => $request->quantityInvoice[$i],
                'unitSaleBriceInvoice' => $request->unitSaleBriceInvoice[$i],
                'notesInvoice' => $request->notesInvoice[$i],
            ]);

            // edit storehouse
            $storehouse = Storehouse::where('item_id', $request->item_id[$i])->first();
            if (is_null($storehouse)) {
                $itemName = Item::where('id', $request->item_id)->first()->itemProductName;
                $request->session()->flash('error', "هذه الكميه غير متوفره في هذا المنتج - {$itemName}");
                DB::rollBack();
                return back();
            }
            if ($request->quantityInvoice[$i] > $storehouse->quantity) {
                $request->session()->flash('error', "هذه الكميه غير متوفره في هذا المنتج - {$storehouse->item->itemProductName} - الكميه المتوفره هي : {$storehouse->quantity}");
                DB::rollBack();
                return back();
            }
            $newQuantity = $storehouse->quantity - $request->quantityInvoice[$i];
            $storehouse->update([
                'quantity' => $newQuantity,
            ]);
        }
        $request->session()->flash('msg', 'عمليه ناجحه');
        DB::commit();
        return back(); // redirect to show

    }


    public function destroy()
    {
    }
}
