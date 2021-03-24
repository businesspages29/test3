<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

Route::group(['middleware' => ['auth'],'prefix'=>'admin','as'=>'admin.'], function() {
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('company', App\Http\Controllers\Admin\CompanyController::class);
    Route::resource('employee', App\Http\Controllers\Admin\EmployeeController::class);
});
    


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
