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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
});

Route::prefix('admin')->group(function(){
    Route::get('/', 'Auth\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/add', function(){
        return view('admin.admin-created');
    })->middleware('auth:admin')->name('admin.created.form');
    Route::post('/created', 'Auth\AdminController@create')->name('admin.created'); //create
    Route::get('/delete/{admin}', 'Auth\AdminController@delete')->name('admin.delete'); //delete
    Route::get('/show/{admin}', 'Auth\AdminController@show')->name('admin.show'); //show
    Route::get('/edit/{admin}', 'Auth\AdminController@edit')->name('admin.edit'); //edit, patch
});

Route::get('datatables/anydata', 'DatatablesController@anyData')->name('datatables.data');
Route::get('datatables/getindex','DatatablesController@getIndex')->name('datatables');