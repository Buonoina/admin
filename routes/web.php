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



Route::get('/students', 'App\Http\Controllers\StudentController@index')->name('students.index');
 
Route::get('/students/create', 'App\Http\Controllers\StudentController@create')->name('student.create')->middleware('auth');
<<<<<<< HEAD
Route::get('/students/create', 'App\Http\Controllers\StudentController@create')->name('school_grade.create')->middleware('auth');
=======
>>>>>>> 6d2a0fe0526d9a21b0624f06546fa7ea01537733
Route::post('/students/store/', 'App\Http\Controllers\StudentController@store')->name('student.store')->middleware('auth');
 
Route::get('/students/edit/{student}', 'App\Http\Controllers\StudentController@edit')->name('student.edit')->middleware('auth');
Route::put('/students/edit/{student}','App\Http\Controllers\StudentController@update')->name('student.update')->middleware('auth');

Route::get('/students/show/{student}', 'App\Http\Controllers\StudentController@show')->name('student.show');

Route::delete('/students/{student}','App\Http\Controllers\StudentController@destroy')->name('student.destroy')->middleware('auth');

Route::get('/school_grades', 'App\Http\Controllers\School_gradeController@index')->name('school_grades.index');
<<<<<<< HEAD
Route::get('/school_grades', 'App\Http\Controllers\School_gradeController@create')->name('school_grade.create')->middleware('auth');
Route::get('/school_grades', 'App\Http\Controllers\School_gradeController@create')->name('student.create')->middleware('auth');
=======

>>>>>>> 6d2a0fe0526d9a21b0624f06546fa7ea01537733

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
