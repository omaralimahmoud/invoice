<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $data['suppliers'] = Supplier::paginate(10);
        // dd($data);
        return view('supplierCode.supplier')->with($data);
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'SupplierCode' => 'required|integer|min:1|max:1000000|unique:suppliers,SupplierCode',
            'SupplierName' => 'required|string|max:255',
            'supplierNotes' => 'nullable|string',
        ]);
        Supplier::create([
            'SupplierCode' => $request->SupplierCode,
            'SupplierName' => $request->SupplierName,
            'supplierNotes' => $request->supplierNotes,
        ]);
        $request->session()->flash('msg', 'عمليه ناجحه');
        return back();
    }

    public function update(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:suppliers,id',
            'SupplierName' => 'required|string|max:255',
            'supplierNotes' => 'nullable|string',
        ]);
        Supplier::findOrFail($request->id)->update([
            'SupplierCode' => $request->SupplierCode,
            'SupplierName' => $request->SupplierName,
            'supplierNotes' => $request->supplierNotes,
        ]);
        $request->session()->flash('msg', ' تم التعديل بنجاح');
        return back();
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $suppliers = Supplier::where('SupplierName', 'like', "%$search%")->get();
        return view('supplierSearch.supplierSearch', [
            'search' => $search,
            'suppliers' => $suppliers,
        ]);
    }





    public function delete(Supplier $supplier, Request $request)
    {
        try {
            $supplier->delete();
            $msg = "تم الحذف بنجاح";
        } catch (Exception $e) {
            $msg = "تم الحذف بنجاح";
        }

        $request->session()->flash('msg', $msg);
        return back();
    }


    // startAjax get code
    public function getByCode($code)
    {
        $supplier = Supplier::where('SupplierCode', $code)->first();

        if (!$supplier) {
            return response()->json([], 404);
        }

        return response()->json([
            'supplier' => $supplier,
        ]);
    }

          //end ajax code

          //start ajax  input search

          public function inputSearch($key)
          {
              $suppliers = Supplier::where('SupplierName', 'LIKE', "%$key%")->get();

              if (count($suppliers) < 1) {
                  return response()->json([], 404);
              }

              return response()->json([
                  'suppliers' => $suppliers,
              ]);
          }

          //end ajax input search
       //start ajax supplierName
       public function getByName($name)
       {
           $supplier = Supplier::where('SupplierName', $name)->first();

           if (!$supplier) {
               return response()->json([], 404);
           }

           return response()->json([
               'supplier' => $supplier,
           ]);
       }
       //start ajax supplierName

}
