<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', '\App\Http\Controllers\AuthController@getLogin')->name('login');
Route::post('/login','\App\Http\Controllers\AuthController@postLogin' )->name('login');



Route::group([ 'middleware' => ['auth'],'namespace'=>'App\Http\Controllers' ],function(){
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::group(['middleware' =>['isAdmin']],function(){
        Route::resource('employees','EmployeeController');
        Route::resource('departments','DepartmentController');
    
    });

});

