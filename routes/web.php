<?php

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


Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

//-------------------invoices------------------------
Route::resource('invoices','InvoicesController');

Route::get('/Status_show/{id}', 'InvoicesController@show')->name('Status_show');

Route::post('/Status_Update/{id}', 'InvoicesController@Status_Update')->name('Status_Update');

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');

Route::get('Invoice_Partial','InvoicesController@Invoice_Partial');

Route::get('Print_invoice/{id}','InvoicesController@Print_invoice');

Route::get('export_invoices', 'InvoicesController@export');

//_______________________________________________________

//--------------------archive----------------------------

Route::resource('Archive', 'InvoiceAchiveController');
//_______________________________________________________


//--------------------------InvoicesDetails-------------------------------------------
Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');


//___________________________________________________________________________________________



//---------------sections-------------------------------
Route::resource('sections','SectionsController');
//____________________________________________________


//-------------products-------------------------------
Route::resource('products','ProductsController');
//____________________________________________________

Route::get('/section/{id}', 'InvoicesController@getproducts');



Route::group(['middleware' => ['auth']], function()
{
     Route::resource('roles','RoleController');
     Route::resource('users','UserController');

});


Route::get('invoices_report', 'Invoices_Report@index');

Route::post('Search_invoices', 'Invoices_Report@Search_invoices');

Route::get('customers_report', 'Customers_Report@index');

Route::post('Search_customers', 'Customers_Report@Search_customers');

Route::get('MarkAsRead_all','InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');


Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');


Route::get('/{page}', 'AdminController@index');

});


