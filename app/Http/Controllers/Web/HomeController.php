<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
      return view('home.index');
  }
  public function show()
  {
      return view('storehouse.modals');
  }
  public function show2()
  {
      return view('cat.categorys');
  }
}
