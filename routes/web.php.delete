<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', 'frontend\IndexController');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shop.html/{id?}', 'FrontendController@shop');
Route::get('/wishlist.html', 'FrontendController@wishlist');
Route::get('/cart.html', 'FrontendController@cart');
Route::get('/product-single.html', 'FrontendController@single');
Route::post('subscribe', 'FrontendController@subscribe');

//
// Route::get('/shop', 'ShopController')->name('shop');
// Route::get('/', 'IndexController@index');
// Route::group('/', function(){
//     Route::get('users/{id}', function ($id) {

//     });
// });

Auth::routes();
date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::ASIA)[27]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/cate_manage', 'CategoryController@index');

// Route::resource('/cate_manage', function () {

//     return view('category.list');

// });

//Route::get('/cate_manage', 'CategoryController@index');
/*Route::middleware(['team'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/cate_manage', 'CategoryController@index');
    });
});*/

// chuc nang cua nhan vien
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('cate_manage', 'CategoryController');
        Route::resource('product_manage', 'ProductController');
        Route::resource('user_manage', 'UserController');
        Route::resource('customer_manage', 'CustomerController');
        Route::resource('comment_manage', 'CommentController');
        Route::group(['prefix' => 'admin'], function () {
        });
        //  Route::get('dashboard', 'Dashboard1Controller');
        // Route::group(['prefix' => 'admin'], function () {
        // });
    });
});

// CHuc nang cua admin
Route::middleware(['auth', 'team'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('order_manage', 'OrderController');
        Route::resource('employee_manage', 'EmployeeController');
    });
});
