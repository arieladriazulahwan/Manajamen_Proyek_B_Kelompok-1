<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);


Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/pdf/{type?}', [ReportController::class, 'exportPdf'])->name('reports.pdf');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/items', [ItemController::class, 'index']);
Route::resource('/incoming', \App\Http\Controllers\IncomingController::class);
Route::resource('/outgoing', \App\Http\Controllers\OutgoingController::class);



// Barang Masuk
// Route::get('/incoming', function () {
//     return view('incoming.index');
// });

// Barang Keluar
// Route::get('/outgoing', function () {
//     return view('outgoing.index');
// });

// Laporan
// Route::get('/reports', function () {
//     return view('reports.index');
// });

// Pengaturan
Route::get('/settings', function () {
    return view('settings.index');
});
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
