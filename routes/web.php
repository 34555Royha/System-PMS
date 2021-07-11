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

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PostController;

Route::group(['middleware'=> ['auth']],function () {
    Route::resource('employee', 'EmployeeController');
    Route::get('employees/delete/{id}', 'EmployeeController@delete');
    Route::get('employees/detail', 'EmployeeController@detail');
    Route::get('employees/search', 'EmployeeController@search');
    Route::get('employees/searchdetail', 'EmployeeController@searchdetail');
    Route::resource('customer', 'CustomerController');
    Route::get('customers/delete/{id}', 'CustomerController@delete');
    Route::get('customers/search/', 'CustomerController@search');
    Route::resource('spouse', 'SpouseController');
    Route::get('spouses/delete/{id}', 'SpouseController@delete');
    Route::get('spouses/search', 'SpouseController@search');
    Route::resource('invoice', 'InvoiceController');
    Route::get('invoices/delete/{id}', 'InvoiceController@delete');
    Route::resource('payment', 'PaymentController');
    Route::get('payments/delete/{id}', 'PaymentController@delete');
    Route::get('payments/search', 'PaymentController@search');

    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::get('/posts/search', 'PostController@search');
    Route::get('/posts/delete/{id}', 'PostController@delete');
    Route::get('categorys/detail', [CategoryController::class,'detail'])->name('post.detail');
    Route::get('/posts/detail', [PostController::class,'detail'])->name('post.detail');
    Route::get('/category/delete/{id}', 'CategoryController@delete');
    Route::get('/categorys/searchcetegory', 'CategoryController@searchcategory');
    Route::get('/frontend/searchcetegory', 'FrontendController@searchcategory');
    Route::get('/frontend/searchpost', 'FrontendController@searchpost');
    Route::get('/posts/searchpost', 'PostController@searchpostdetail');
    Route::get('/categorys/category/{category}', 'CategoryController@getByCategory');
    Route::get('/invoices/search', [InvoiceController::class,'search'])->name('invoice.search');
    
    // Search
    Route::get('/','CategoryController@index');
    Route::get('/show/{post}','FrontendController@show');
    Route::get('/frontend/category/{category}', 'FrontendController@getByCategory');
    Route::get('/frontend/search/', 'FrontendController@getBySearch');

});

/*Route::get('/admin', function () {
    return view('admin.index');
});*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@admin')    
->middleware('admin')->name('admin');
