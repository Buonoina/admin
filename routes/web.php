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



Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bunbougus', 'App\Http\Controllers\BunbouguController@index')->name('bunbougus.index');

Route::get('/bunbougus/create', 'App\Http\Controllers\BunbouguController@create')->name('bunbougu.create')->middleware('auth');;
Route::post('/bunbougus/store/', 'App\Http\Controllers\BunbouguController@store')->name('bunbougu.store')->middleware('auth');;

Route::get('/bunbougus/edit/{bunbougu}', 'App\Http\Controllers\BunbouguController@edit')->name('bunbougu.edit')->middleware('auth');;
Route::put('/bunbougus/edit/{bunbougu}','App\Http\Controllers\BunbouguController@update')->name('bunbougu.update')->middleware('auth');;

Route::get('/bunbougus/show/{bunbougu}', 'App\Http\Controllers\BunbouguController@show')->name('bunbougu.show');

Route::delete('/bunbougus/{bunbougu}','App\Http\Controllers\BunbouguController@destroy')->name('bunbougu.destroy')->middleware('auth');;


Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');

Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::post('/products/store/', 'App\Http\Controllers\ProductController@store')->name('product.store');

Route::get('/products/edit/{product}', 'App\Http\Controllers\ProductController@edit')->name('product.edit')->middleware('auth');
Route::put('/products/edit/{product}','App\Http\Controllers\ProductController@update')->name('product.update');

Route::get('/products/show/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show');
 
Route::delete('/products/{product}','App\Http\Controllers\ProductController@destroy')->name('product.destroy')->middleware('auth');

Route::get('/search', 'SearchController@search')->name('search');



Route::get('/blogs', 'App\Http\Controllers\BlogController@index')->name('blogs.index');
 
Route::get('/blogs/create', 'App\Http\Controllers\BlogController@create')->name('blog.create')->middleware('auth');
Route::post('/blogs/store/', 'App\Http\Controllers\BlogController@store')->name('blog.store')->middleware('auth');
 
Route::get('/blogs/edit/{blog}', 'App\Http\Controllers\BlogController@edit')->name('blog.edit')->middleware('auth');
Route::put('/blogs/edit/{blog}','App\Http\Controllers\BlogController@update')->name('blog.update')->middleware('auth');
 
Route::delete('/blogs/{blog}','App\Http\Controllers\BlogController@destroy')->name('blog.destroy')->middleware('auth');

Route::get('searchproduct', 'ProductController@search')->name('searchproduct');