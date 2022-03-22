<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Cat;
use App\Models\Item;
use App\Models\Storehouse;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

//use App\Http\Web\Controllers\StorehouseController;

class StorehouseController extends Controller
{

    public function index()
    {
        $data['storehouses'] = Storehouse::paginate(10);
        return view('storehouse.store')->with($data);
    }

    public function getByDate(Request $request)
    {

        $request->validate([
            'from' => 'required_with:to|date',
            'to' => 'required_with:from|date|after:from',
            'id' => 'required|integer',
        ]);

        $data['storehouses'] = Item::findOrFail($request->id)
            ->storehouse()
            ->whereBetween('purchasedDate', [$request->from, $request->to])
            ->get();

        return view('searchStore.searchStore')->with($data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'openingBalance' => 'nullable|integer|min:1|max:1000000',
            'purchasedDate' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|string|max:255',
            'PurchasingBrice' => 'required|string|max:255',
            'sellingBrice' => 'nullable|string|max:255',
            'finalBriceEnd' => 'nullable|string|max:255',
            'storehouseNotes' => 'nullable|string',
        ]);

        $item = Storehouse::where('item_id', $request->item_id)->first();
        if (is_null($item)) {
            Storehouse::create([
                'item_id'   => $request->item_id,
                'openingBalance' => $request->openingBalance,
                'purchasedDate' => $request->purchasedDate,
                'supplier_id' => $request->supplier_id,
                'quantity' => $request->quantity,
                'PurchasingBrice' => $request->PurchasingBrice,
                'sellingBrice' => $request->sellingBrice,
                'finalBriceEnd' => $request->finalBriceEnd,
                'storehouseNotes' => $request->storehouseNotes,
            ]);
        } else {
            $item->update([
                'openingBalance' => $request->openingBalance,
                'purchasedDate' => $request->purchasedDate,
                'supplier_id' => $request->supplier_id,
                'quantity' => $item->quantity + $request->quantity,
                'PurchasingBrice' => $request->PurchasingBrice,
                'sellingBrice' => $request->sellingBrice,
                'finalBriceEnd' => $request->finalBriceEnd,
                'storehouseNotes' => $request->storehouseNotes,
            ]);
        }

        // dd($request->all());
        $request->session()->flash('msg', 'عمليه ناجحه');
        return back();
    }

    ///////////////////////////////////////////////////////////////////////////////////
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:storehouses,id',
            'openingBalance' => 'nullable|integer|min:1|max:1000000',
            'quantity' => 'required|string|max:255',
            'PurchasingBrice' => 'required|string|max:255',
            'sellingBrice' =>  'nullable|string|max:255',
            'finalBriceEnd' =>  'nullable|string|max:255',
            'storehouseNotes' => 'nullable|string',
        ]);
        Storehouse::findOrFail($request->id)->update([
            'openingBalance' => $request->openingBalance,
            'purchasedDate' => $request->purchasedDate,
            'quantity' => $request->quantity,
            'PurchasingBrice' => $request->PurchasingBrice,
            'sellingBrice' => $request->sellingBrice,
            'finalBriceEnd' => $request->finalBriceEnd,
            'storehouseNotes' => $request->storehouseNotes,
        ]);
        $request->session()->flash('msg', ' تم التعديل بنجاح');
        return back();
    }
    ////////////////////////////////////////////////////////////////////////////

    public function delete(Storehouse $storehouse, Request $request)
    {

        try {
            $storehouse->delete();
            $msg = "تم الحذف بنجاح";
        } catch (\Exception $e) {
            $msg = "تم الحذف بنجاح";
        }
        $request->session()->flash('msg', $msg);
        return back();
    }
}
