<?php

use App\Http\Controllers\CategoryController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


// Dashboard
Route::get('/dashdoard',[HomeController::class,'dashboard'])->name('dashboard')->middleware('auth');



//profile edit route
Route::resource('/profile', 'App\Http\Controllers\ProfileController')->middleware('auth');
Route::post('/profile/changePassword/{id}', 'App\Http\Controllers\ProfileController@changePassword')->name('changePassword')->middleware('auth');


//category route
Route::resource('/category', 'App\Http\Controllers\CategoryController')->middleware('auth');
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware('auth:sanctum');



//Customer route
Route::view('/customer','pages.customer.customer')->middleware('auth:sanctum')->name('customer');
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware('auth:sanctum');
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware('auth:sanctum');
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware('auth:sanctum');
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware('auth:sanctum');
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware('auth:sanctum');



//Product route
Route::view('/product','pages.product.product')->middleware('auth:sanctum')->name('product');
Route::post("/create-product",[ProductController::class,'ProductCreate'])->middleware('auth:sanctum');
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware('auth:sanctum');
Route::post("/delete-product",[ProductController::class,'ProductDelete'])->middleware('auth:sanctum');
Route::post("/update-product",[ProductController::class,'ProductUpdate'])->middleware('auth:sanctum');
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware('auth:sanctum');


//Order route
Route::view('/sale','pages.sale.sale')->middleware('auth:sanctum')->name('sale');





//invoice route
Route::view('/invoice','pages.invoice.invoice')->middleware('auth:sanctum')->name('invoice');




//report route
Route::view('/report','pages.report.report')->middleware('auth:sanctum')->name('report');
