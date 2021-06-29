<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Models;

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
    $product = DB::table('product')->get();
    return view('welcome',['product'=> $product]);
});

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@verify');


Route::get('/register', [UserController::class,'index']);
Route::post('/register', [UserController::class,'insert']);

Route::group(['middleware'=>['sess']], function(){
    Route::group(['middleware'=>['seller']], function(){
        Route::get('/seller/index', 'LoginController@seller');
        Route::get('/seller/addProduct', 'ProductController@add')->name('add');
        Route::post('/seller/addProduct', 'ProductController@insert')->name('insert');
        Route::get('/seller/showProduct', 'ProductController@show')->name('show');
        Route::get('/seller/dashboard/{id}', 'OrderController@dashboard')->name('dashboard');

        Route::get('/seller/profile/{id}', 'UserController@profile')->name('profile');
        Route::post('/seller/profile/{id}', 'UserController@profileupdate');
        Route::post('/seller/pic/{id}', 'UserController@profileimage');



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
    Route::group(['middleware'=>['buyer']], function(){
        Route::get('/buyer/index',[LoginController::class,'buyer']);
        Route::get('/buyer/profile/{id}', 'BuyerController@buyerProfile')->name('buyerProfile');
        Route::get('/buyer/edit/{id}','BuyerController@edit')->name('edit');
        Route::post('/buyer/edit/{id}','BuyerController@editProfile');
        Route::get('buyer/edit/buyer/cpass/{id}','BuyerController@cpass');

    });

    Route::group(['middleware'=>['admin']], function(){
        Route::get('/admin/index', 'LoginController@admin');

        Route::get('/admin/ApproveProduct', 'ProductController@approve')->name('approve');
        Route::post('/admin/status/{id}', 'ProductController@status');
        Route::get('/admin/showProduct/search', 'ProductController@adminsearch');
        Route::get('/admin/showProduct/all', 'ProductController@approve');

        Route::get('/admin/addUser', 'UserController@addUser')->name('adduser');
        Route::post('/admin/addUser', 'UserController@insertuser');
        Route::get('/admin/showUser', 'UserController@showUser')->name('showuser');
        Route::get('/admin/showuser/search', 'UserController@usersearch');
        Route::get('/admin/showuser/all', 'UserController@showUser');

        Route::get('/admin/{id}/edit', 'UserController@edit');
        Route::post('/admin/{id}/edit', 'UserController@update');
        Route::get('/admin/{id}/delete', 'UserController@delete');

        Route::get('/admin/profile/{id}', 'UserController@profileadmin')->name('profile');
        Route::post('/admin/profile/{id}', 'UserController@adminupdate');
        Route::post('/admin/pic/{id}', 'UserController@adminimage');
        Route::get('/admin/dashboard/', 'OrderController@admindashboard');
    });
});

Route::get('/logout', 'LogoutController@index')->name('logout');
