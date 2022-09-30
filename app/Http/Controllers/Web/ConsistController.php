<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Consist;
use Illuminate\Http\Request;

class ConsistController extends Controller
{
     public function index()
     {
        $data['consists']=Consist::paginate(10);
        return view('Consists.ConsitStore')->with($data);
     }


     public function store(Request $request)
     {
        $request->validate([


            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'consistsquantity' => 'required|string|max:255',
            'consistsSellingBrice' => 'nullable|string|max:255',
            'ConsistsNotes' => 'nullable|string',
        ]);

        $item = Consist::where('item_id', $request->item_id)->first();
        if (is_null($item)) {
            Consist::create([
                'item_id'   => $request->item_id,
                'supplier_id' => $request->supplier_id,
                'consistsquantity' => $request->consistsquantity,
                'consistsSellingBrice' => $request->consistsSellingBrice,
                'ConsistsNotes' => $request->ConsistsNotes,
            ]);
        } else {
            $item->update([
                'supplier_id' => $request->supplier_id,
                'consistsquantity' => $item->consistsquantity +  $request->consistsquantity,
                'consistsSellingBrice' => $request->consistsSellingBrice,
                'ConsistsNotes' => $request->ConsistsNotes,
            ]);
        }

        // dd($request->all());
        $request->session()->flash('msg', 'عمليه ناجحه');
        return back();
     }



     public function update(Request $request)
     {
         $request->validate([
             'id' => 'required|exists:consists,id',
             'consistsquantity' => 'required|string|max:255',
             'consistsSellingBrice' =>  'nullable|string|max:255',
             'ConsistsNotes' => 'nullable|string',
         ]);
         Consist::findOrFail($request->id)->update([
             'consistsquantity' => $request->consistsquantity,
             'consistsSellingBrice' => $request->consistsSellingBrice,
             'ConsistsNotes' => $request->ConsistsNotes,
         ]);
         $request->session()->flash('msg', ' تم التعديل بنجاح');
         return back();
     }


     public function delete(Consist $consist, Request $request)
     {

         try {
             $consist->delete();
             $msg = "تم الحذف بنجاح";
         } catch (\Exception $e) {
             $msg = "تم الحذف بنجاح";
         }
         $request->session()->flash('msg', $msg);
         return back();
     }


}





