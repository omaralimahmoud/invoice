<?php

use App\Http\Controllers\AdminController;


use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' ,[HomeController::class,'index']);
Route::get('/storehouse' ,[HomeController::class,'show']);
Route::get('/categorys',[HomeController::class,'show2']);


//Route::get('/{page}', 'AdminController@index');
//Route::get('/{page}',[AdminController::class,'index']);


