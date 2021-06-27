<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;

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

Route::get('/', function(){
    return view('welcome');
});

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@verify');

Route::get('/register', [UserController::class,'index']);
Route::post('/register', [UserController::class,'insert']);

Route::group(['middleware'=>['sess']], function(){

    Route::get('/admin/index', 'LoginController@admin');
    Route::get('/buyer/index', 'LoginController@buyer');
    Route::get('/seller/index', 'LoginController@seller');

    Route::group(['middleware'=>['seller']], function(){
        Route::get('/seller/addProduct', 'ProductController@add')->name('add');
        Route::post('/seller/addProduct', 'ProductController@insert')->name('insert');
        Route::get('/seller/showProduct', 'ProductController@show')->name('show');
        Route::get('/seller/dashboard/{id}', 'OrderController@dashboard')->name('dashboard');

        Route::get('/seller/showProduct/search', 'ProductController@search');
        Route::get('/seller/showProduct/all', 'ProductController@show');

        Route::get('/seller/showOrder/search', 'OrderController@search');
        Route::get('/seller/showOrder/all', 'OrderController@showOrder');
        Route::post('/seller/showOrder/{id}', 'OrderController@track');
        Route::get('/seller/export', 'OrderController@export');
        
        Route::get('/product/{name}/edit', 'ProductController@edit');
        Route::post('/product/{name}/edit', 'ProductController@update');
        Route::get('/product/{name}/delete', 'ProductController@delete');
        
        Route::get('/seller/showOrderList', 'OrderController@showOrder')->name('showOrder');
    });
    Route::group(['middleware'=>['buyer']], function(){});
});

Route::get('/logout', 'LogoutController@index')->name('logout');
