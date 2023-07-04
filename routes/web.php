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
Route::get('/login',"" );
Route::group(['perfix' => 'admin', 'middleware' => []],function(){

});

Route::group(['perfix' => 'admin', 'middleware' => ['auth','isAdmin']],function(){
    Route::resource('employees','EmployeeController');
    Route::resource('departments','DepartmentController');

});
Route::group(['perfix' => 'dashbord', 'middleware' => ['auth','isAdmin']],function(){
    Route::resource('employees','EmployeeController');
    Route::resource('departments','DepartmentController');

});
