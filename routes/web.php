<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\Catcontroller;
use App\Http\Controllers\Web\ConsistController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ItemController;
use App\Http\Controllers\Web\ReplaceOrderController;
use App\Http\Controllers\Web\ReturnOrderController;
use App\Http\Controllers\Web\SupplierController;
use App\Http\Controllers\Web\StorehouseController;
use App\Http\Controllers\Web\UserAdminController;
use App\Models\Customer;
use App\Models\ReplaceOrder;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
  //  Route::get('/return', [HomeController::class, 'store']);
    Route::get('/categorys', [Catcontroller::class, 'index']);
    Route::post('/categorys/store', [Catcontroller::class, 'store']);
    Route::post('/categorys/update', [Catcontroller::class, 'update']);
    Route::get('/categorys/delete/{cat}', [Catcontroller::class, 'delete']);
    Route::get('/categorys/search', [Catcontroller::class, 'search']);

    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::post('/supplier/store', [SupplierController::class, 'store']);
    Route::get('/supplier/delete/{supplier}', [SupplierController::class, 'delete']);
    Route::post('/supplier/update', [SupplierController::class, 'update']);
    Route::get('/supplier/search', [SupplierController::class, 'search']);

    Route::get('/itemCode', [ItemController::class, 'index']);
    Route::post('/itemCode/store', [ItemController::class, 'store']);
    Route::get('/itemCode/delete/{item}', [ItemController::class, 'delete']);
    Route::post('/itemCode/update', [ItemController::class, 'update']);
    Route::get('/itemCode/search', [ItemController::class, 'search']);

    Route::get('/itemCode/{code}', [ItemController::class, 'getByCode']);

    Route::get('/storehouse', [StorehouseController::class, 'index']);
    Route::post('/storehouse/store', [StorehouseController::class, 'store']);
    Route::get('/storehouse/delete/{storehouse}', [StorehouseController::class, 'delete']);
    Route::post('/storehouse/update', [StorehouseController::class, 'update']);

    Route::get('/storehouse/search', [StorehouseController::class, 'getByDate']);

    Route::get('/sales', [OrderController::class, 'index']);
    Route::get('/invoice', [OrderController::class, 'create']); /// retren view
    Route::post('/invoice/store', [OrderController::class, 'store']);
    Route::get('/sales/orderDetails/show/{order}', [OrderController::class, 'show']);
    Route::get('/sales/orderDetails/update/{order}',[OrderController::class,'edit']);
    Route::post('/sales/orderDetails/updateOrder',[OrderController::class,'update']);///في مشكله هنا

    Route::get('/editPassword',[UserAdminController::class,'index'])->middleware('IsSuperAdmin');
    Route::post('/editPassword/update',[UserAdminController::class,'update'])->middleware('IsSuperAdmin');

    Route::get('/return',[ReturnOrderController::class,'index']);
    Route::get('/showReturenOrder',[ReturnOrderController::class,'create']);
    Route::get('/showDetails/{ReturnOrder}',[ReturnOrderController::class,'show']);
    Route::post('/return/store',[ReturnOrderController::class,'store']);

    Route::get('/ConsitStore',[ConsistController::class,'index']);
    Route::post('/ConsitStore/store',[ConsistController::class,'store']);
    Route::post('/ConsitStore/update',[ConsistController::class,'update']);
    Route::get('/ConsitStore/delete/{consist}',[ConsistController::class,'delete']);
    Route::get('/replacementinvoice',[ReplaceOrderController::class,'index']);
    Route::get('/repalceshow',[ReplaceOrderController::class,'create']);
    Route::get('/replaceShowDeatil/{replaceOrder}',[ReplaceOrderController::class,'show']);
    Route::post('/repalces/Store',[ReplaceOrderController::class,'store']);
});


//////////////////////////////////////AJAX/////////



Route::prefix('ajax')->group(function () {
    Route::get('categories/get-by-code/{code}', [Catcontroller::class, 'getByCode']);
    Route::get('categories/input-search/{key}', [Catcontroller::class, 'inputSearch']);
    Route::get('categories/get-by-name/{name}', [Catcontroller::class, 'getByName']);

    Route::get('items/get-by-code/{code}', [ItemController::class, 'getByCode']);
    Route::get('items/input-search/{key}', [ItemController::class, 'inputSearch']);
    Route::get('items/get-by-name/{name}', [ItemController::class, 'getByName']);

    Route::get('suppliers/get-by-code/{code}', [SupplierController::class, 'getByCode']);
    Route::get('suppliers/input-search/{key}', [SupplierController::class, 'inputSearch']);
    Route::get('suppliers/get-by-name/{name}', [SupplierController::class, 'getByName']);

    ///////////////
    Route::get('invoice/get-by-code/{code}', [CustomerController::class, 'getByCode']);
    Route::get('invoice/input-search/{key}', [CustomerController::class, 'inputSearch']);
    Route::get('invoice/get-by-name/{name}', [CustomerController::class, 'getByName']);
    Route::get('invoice/get-by-phone/{phone}', [CustomerController::class, 'getByPhone']);
});

// Route::post('/invoice', [OrderController::class, 'store']);   ///الاضافه
// Route::get('/sales', [OrderController::class, 'index']); ترجع الداتا  retren view
//  عشان ترجع الداتا قلي انت عاوزها






//Route::get('/invoice', [HomeController::class, 'invoice']);
//Route::get('/sales', [HomeController::class, 'sales']);
//Route::get('/{page}', 'AdminController@index');
//Route::get('/{page}',[AdminController::class,'index']);
