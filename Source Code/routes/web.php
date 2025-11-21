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
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth Routes (tanpa middleware)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Routes yang membutuhkan login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Items
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');

    // Categories, Products, Orders
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    // Barang Masuk / Keluar
    Route::resource('incoming', IncomingController::class);
    Route::resource('outgoing', OutgoingController::class);

    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf/{type?}', [ReportController::class, 'exportPdf'])->name('reports.pdf');

    // Pengaturan
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');
    Route::post('/settings/update-profile', [SettingsController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::post('/settings/update-warehouse', [SettingsController::class, 'updateWarehouse'])->name('settings.updateWarehouse');
    Route::post('/settings/dark-mode', [SettingsController::class, 'toggleDarkMode'])->name('settings.toggleDarkMode');

});


/*
|--------------------------------------------------------------------------
| Halaman Utama (Welcome)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
