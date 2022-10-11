<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
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
//Auth::routes();
//Route::get('/{page}', [AdminController::class,"index"]);



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    });

Route::post("Search_customers",[Customers_Report::class,"Search_customers"]);
Route::get("customers_report",[Customers_Report::class,"index"]);
Route::post('Search_invoices', [Invoices_Report::class,"Search_invoices"]);
Route::get('invoices_report', [Invoices_Report::class,"index"]);
Route::get('export_invoices', [InvoicesController::class, 'export']);
Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
Route::resource('Archive',InvoiceAchiveController::class);
Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);
Route::get('Invoice_UnPaid',[InvoicesController::class,'Invoice_UnPaid']);
Route::get('Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);
Route::get('/edit_invoice/{id}', [InvoicesController::class,"edit"]);
Route::post('/Status_Update/{id}', [InvoicesController::class,"Status_Update"])->name('Status_Update');
Route::get('/show_invoice/{id}', [InvoicesController::class,"show"])->name("Status_show");
Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);
Route::resource('invoices',InvoicesController::class);
Route::get('section/{id}',[InvoicesController::class,"getproducts"]);
Route::get('InvoicesDetails/{id}',[InvoicesDetailsController::class,"edit"]);
Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,"get_file"]);
Route::get('View_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,"open_file"]);
Route::resource("products",ProductsController::class);
Route::post('delete_file' ,[InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::resource('sections',SectionsController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/{page}',AdminController::class);



