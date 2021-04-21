<?php

use App\Http\Controllers\StafController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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
    // return response('Hello World', 200)
    //               ->header('Content-Type', 'text/plain');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Staf
Route::resource('staf', 'StafController');
Route::post('staf/update', 'StafController@update')->name('staf.update');

//category
Route::get('category', 'Category\CatKendaraanController@index')->name('category.index');
Route::get('category/show', 'Category\CatDetailController@show')->name('category.show');

Route::get('category/tableKendaraan', 'Category\CatKendaraanController@datatable')->name('category.tableKendaraan');
Route::post('category/storeKendaraan', 'Category\CatKendaraanController@store')->name('category.storeKendaraan');
Route::delete('category/{id}/destroyKendaraan', 'Category\CatKendaraanController@destroy')->name('category.destroyKendaraan');

Route::get('category/tableType', 'Category\CatTypeController@datatable')->name('category.tableType');
Route::post('category/storeType', 'Category\CatTypeController@store')->name('category.storeType');
Route::delete('category/{id}/destroyType', 'Category\CatTypeController@destroy')->name('category.destroyType');
Route::get('category/{id}/selectType', 'Category\CatTypeController@selectType')->name('category.selectType');

Route::get('category/tableNama', 'Category\CatNamaController@datatable')->name('category.tableNama');
Route::post('category/storeNama', 'Category\CatNamaController@store')->name('category.storeNama');
Route::delete('category/{id}/destroyNama', 'Category\CatNamaController@destroy')->name('category.destroyNama');
Route::get('category/{id}/selectNama', 'Category\CatNamaController@selectNama')->name('category.selectNama');

Route::get('category/tableDetail', 'Category\CatDetailController@datatable')->name('category.tableDetail');
Route::post('category/storeDetail', 'Category\CatDetailController@store')->name('category.storeDetail');
Route::delete('category/{id}/destroyDetail', 'Category\CatDetailController@destroy')->name('category.destroyDetail');

//loan NEW
Route::GET('loan/index', 'LoanController@index')->name('loan.index');
Route::GET('loan/data', 'LoanController@data')->name('loan.data');
// Route::GET('loanProses/data', 'LoanProsesController@index')->name('loanProses.data');
Route::GET('loan/flush', 'LoanController@sessionFlush')->name('loan.flush');
Route::GET('loan/datatablePeminjaman', 'LoanController@dataTableLoanTransaksi')->name('loan.datatablePeminjaman');
Route::GET('loan/{id}/showDataLoan', 'LoanController@showDataLoan');

Route::GET('loan/proses/datatable', 'LoanProsesController@dataTableLoan')->name('loan.prosesDatatable');
Route::get('loan/proses/{id}/selectType', 'LoanProsesController@selectType');
Route::get('loan/proses/{id}/selectNama','LoanProsesController@selectNama');
Route::get('loan/proses/{id}/detailBan','LoanProsesController@detailBan');
Route::get('loan/proses/{id}/addData','LoanProsesController@addData');
Route::get('loan/proses/{id}/editJumlah','LoanProsesController@editJumlah')->name('loan.editJumlah');

Route::POST('loan/proses/store','LoanProsesController@store')->name('loanProses.store');
Route::POST('loan/proses/editJumlahStore','LoanProsesController@editJumlahStore')->name('loanProses.editJumlahStore');

Route::DELETE('loan/proses/{id}/destroy','LoanProsesController@destroy')->name('loanProses.destroy');

Route::POST('loan/transaksi/store','LoanTransaksiController@store')->name('loanTransaksi.store');


//Product
Route::resource('mobil','MobilController');
Route::get('dataTable','MobilController@dataTable')->name('dataTable');


//Loan
Route::get('loan', 'LoanController@index')->name('loan.index');
Route::get('loan', 'LoanController@store')->name('loan.store');




//example Upload Image Ajax

Route::resource('uploadImage','UploadImageController');





Route::GET('permission','PermissionController@index')->name('permission.index');
Route::POST('permission/setPermission','PermissionController@roleSetPermission')->name('permission.setPermission');
Route::POST('permission/store','PermissionController@store')->name('permission.store');
Route::GET('permission/datatable','PermissionController@dataTable')->name('permission.datatable');

Route::GET('role','RoleController@index')->name('role.index');
Route::GET('role/datatable','RoleController@dataTable')->name('role.datatable');
Route::POST('role/store','RoleController@store')->name('role.store');
Route::POST('role/setUser','RoleController@setRoleUser')->name('role.setUser');

