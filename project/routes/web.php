<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@verify');

Route::group(['middleware'=>['sess']], function(){

    Route::get('/admin/index', 'LoginController@admin');
    Route::get('/buyer/index', 'LoginController@buyer');
    Route::get('/seller/index', 'LoginController@seller');

    Route::group(['middleware'=>['seller']], function(){
        Route::get('/seller/addProduct', 'ProductController@add')->name('add');
        Route::post('/seller/addProduct', 'ProductController@insert')->name('insert');
        Route::get('/seller/showProduct', 'ProductController@show')->name('show');

        Route::post('/seller/showProduct/search', 'ProductController@search');
        Route::post('/seller/showProduct/all', 'ProductController@show');
        
        Route::get('/product/{name}/edit', 'ProductController@edit');
        Route::post('/product/{name}/edit', 'ProductController@update');
        Route::get('/product/{name}/delete', 'ProductController@delete');
        
    });
});

Route::get('/logout', 'LogoutController@index')->name('logout');
