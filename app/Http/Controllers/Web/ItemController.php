<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Item;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ItemController extends Controller
{
    public function index()
    {
        $data['items'] = Item::paginate(10);
        $data['cats'] = Cat::all();
        // dd($data);
        return view('itemCode.itemcode')->with($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'itemProductCode' => 'required|integer|min:1|max:1000000|unique:items,itemProductCode',
            'itemProductName' => 'required|string|max:255',
            'itemUnitProductCode' => 'required|integer|min:1|max:1000000|unique:items,itemUnitProductCode',
            'itemOnlyProduct' => 'required|string|max:255',
            'itemProductNotes' => 'nullable|string',
            'cat_id' => 'required|exists:cats,id',
        ]);

        Item::create([
            'itemProductCode' => $request->itemProductCode,
            'itemProductName' => $request->itemProductName,
            'itemUnitProductCode' => $request->itemUnitProductCode,
            'itemOnlyProduct' => $request->itemOnlyProduct,
            'itemProductNotes' => $request->itemProductNotes,
            'cat_id' => $request->cat_id,
        ]);

        //  dd($request->all());
        $request->session()->flash('msg', 'عمليه ناجحه');
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:items,id',
            'itemProductName' => 'required|string|max:255',
            'itemOnlyProduct' => 'required|string|max:255',
            'itemProductNotes' => 'nullable|string',
        ]);
        Item::findOrFail($request->id)->update([
            'itemProductName' => $request->itemProductName,
            'itemOnlyProduct' => $request->itemOnlyProduct,
            'itemProductNotes' => $request->itemProductNotes,

        ]);

        $request->session()->flash('msg', ' تم التعديل  بنجاح');
        return back();
    }
    public function search(Request $request)
    {
        $search=$request->search;
      $items=Item::where('itemProductName','like',"%$search%")->get();
      return view('itemsearch.itemCodeSearch',[
          'search'=>$search,
          'items'=>$items,
      ]);
    }

    public function delete(Item $item, Request $request)
    {
        try {
            $item->delete();
            $msg = "تم الحذف بنجاح";
        } catch (\Exception $e) {
            $msg = "تم الحذف بنجاح";
        }
        $request->session()->flash('msg', $msg);
        return back();
    }

    public function getByCode($code)
    {
        $item = Item::where('itemProductCode', $code)->with('cat')->first();

        if (!$item) {
            return response()->json([], 404);
        }

        return response()->json([
            'item' => $item,
        ]);
    }

    public function inputSearch($key)
    {
        $items = Item::where('itemProductName', 'LIKE', "%$key%")->with('cat')->get();

        if (count($items) < 1) {
            return response()->json([], 404);
        }

        return response()->json([
            'items' => $items,
        ]);
    }

    public function getByName($name)
    {
        $item = Item::where('itemProductName', $name)->with('cat')->first();

        if (!$item) {
            return response()->json([], 404);
        }

        return response()->json([
            'item' => $item,
        ]);
    }
}
