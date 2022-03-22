<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;

class Catcontroller extends Controller
{
    public function index()
    {
        $data['cats']=Cat::paginate(10);
        //dd($data);
        return view('cat.categorys')->with($data);
    }
   public function store(Request $request)
   {
    $request->validate([
       'storeCode' =>'required|integer|min:1|max:1000000|unique:cats,storeCode',
         'StoreName'=> 'required|string|max:255 ',
          'Notes'=>'nullable|string',
        ]);
    Cat::create([
        'storeCode'=> $request->storeCode,
        'StoreName'=> $request->StoreName,
        'Notes'=>$request->Notes,
    ]);
     $request->session()->flash('msg','عمليه ناجحه');

     return back();
     //dd($request->all());
   }

   public function search(Request $request)
  {
      $search=$request->search;
    $cats=Cat::where('StoreName','like',"%$search%")->get();
    return view('search.search',[
        'search'=>$search,
        'cats'=>$cats,
    ]);
  }

   public function update(Request $request )
   {
    $request->validate([
        'id'=> 'required|exists:cats,id',

         'StoreName'=> 'required|string|max:255 ',
          'Notes'=>'nullable|string',
        ]);
    Cat::findOrFail($request->id)->update([
        'storeCode'=> $request->storeCode,
        'StoreName'=> $request->StoreName,
        'Notes'=>$request->Notes,
    ]);
     $request->session()->flash('msg',' تم التعديل بنجاح');

     return back();
     //dd($request->all());
   }

   public function delete(Cat $cat, Request $request)
   {
     try {
        $cat->delete();
        $msg="تم الحذف بنجاح";
     } catch (Exception $e) {
        $msg="تم الحذف بنجاح";
    }

     $request->session()->flash('msg',$msg);
     return back();
   }


      //start ajax get cat code
      public function getByCode($code)
      {
          $cat = Cat::where('storeCode', $code)->first();

          if (!$cat) {
              return response()->json([], 404);
          }

          return response()->json([
              'cat' => $cat,
          ]);
      }
      //end ajax get cat code

    //   start ajax input serch for name select
    public function inputSearch($key)
    {
        $cats = Cat::where('StoreName', 'LIKE', "%$key%")->get();

        if (count($cats) < 1) {
            return response()->json([], 404);
        }

        return response()->json([
            'cats' => $cats,
        ]);
    }

    //  //////////////////       End////////////////////////////////////


   //////////////////////////////////start ajax get CAtName////////
   public function getByName($name)
   {
       $cat = Cat::where('StoreName', $name)->first();

       if (!$cat) {
           return response()->json([], 404);
       }

       return response()->json([
           'cat' => $cat,
       ]);
   }

 //////////////////////////////////////////End//////////////


}
