<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes(["register"=>false]);
//Route::get('/{page}', [AdminController::class,"index"]);






Route::resource('invoices',InvoicesController::class);
Route::get('section/{id}',[InvoicesController::class,"getproducts"]);
Route::resource("products",ProductsController::class);

Route::resource('sections',SectionsController::class);

Route::resource('/{page}',AdminController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


