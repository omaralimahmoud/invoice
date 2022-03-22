<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
   public function  index()
   {
       $data['users']= User::paginate(10);
       return view('editPassword.editPassword')->with($data);
   }
   public function update(Request $request)
   {

    $user=User::findOrFail($request->id);
     $request->validate([
         'id'=>'required|exists:users,id',
         'password'=>'required|string|confirmed',
     ]);
     if ($request->password ===$request->password_confirmation) {
        $user->update([
            'password'=> Hash::make($request->password),
        ]);
        $request->session()->flash("msg","تم التعديل بنجاح");
     }
     else{
        $request->session()->flash("msg"," حدث خطاء في التعديل بنجاح");
        return back();
     }
     return back();
   }
}
