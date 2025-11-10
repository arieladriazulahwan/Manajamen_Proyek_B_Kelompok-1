<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\ReportController;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('/items', ItemController::class);
Route::resource('/items', ItemController::class);

Route::resource('/incoming', IncomingController::class)->only(['create', 'store']);
Route::resource('/outgoing', OutgoingController::class)->only(['create', 'store']);
Route::get('/reports', [ReportController::class, 'index']);
