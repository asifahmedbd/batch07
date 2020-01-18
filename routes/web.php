<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('home');
// });

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@index');
Route::get('/about', function () {
    return view('about');
});

// Route::get('/contact-us', function () {
//     return view('contact');
// });
Route::view('/contact-us', 'contact', ['name' => 'Taylor']);
Route::resource('showprofile', 'ShowProfile');
Route::get('contact', 'ContactController@contact');
Route::get('product/details/{product_id}', 'HomeController@productDetails');
Route::post('product/submitRating','HomeController@submitRating');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
// Cart Items
Route::post('/add-to-cart','CartController@addToCart');
Route::get('/mycart', 'CartController@mycart');
Route::post('/update-cart', 'CartController@updateCart');
Route::any('/cartItemDelete/{temp_order_row_id}', 'CartController@cartItemDelete');
Route::any('/cartItemDeleteAll', 'CartController@cartItemDeleteAll');

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/admin', 'LoginController@login');
    Route::post('/postAdminLogin', 'LoginController@postAdminLogin'); 
    Route::get('/admin/logout', 'LoginController@logout');        
    Route::get('/admin/dashboard', 'DashboardController@index');
});
