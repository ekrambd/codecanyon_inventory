<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AjaxController;
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

Route::get('/', [IndexController::class, 'loginPage']);

Route::post('admin-login', [AccessController::class, 'adminLogin']);

Route::get('/logout', [AccessController::class, 'Logout']);


Route::group(['middleware' => 'prevent-back-history'],function(){
  
  //admin dashboard

    Route::get('/dashboard', [DashboardController::class, 'Dashboard']);

    //categories
    Route::resource('categories', CategoryController::class);

    //subcategories
    Route::resource('subcategories', SubcategoryController::class);

    //products
    Route::resource('products', ProductController::class);

    //suppliers
    Route::resource('suppliers', SupplierController::class);

    //customers
    Route::resource('customers', CustomerController::class);

});


//ajax requests
Route::get('/all-categories', [AjaxController::class, 'allCategories']);
Route::post('get-subcategories', [AjaxController::class, 'getSubcategories']);