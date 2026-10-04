<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'main']) -> name('main');
Route::get('/category', [SiteController::class, 'category']) -> name('category');
Route::get('/journalist', [SiteController::class, 'journalist']) -> name('journalist');
Route::get('/admin', [SiteController::class, 'admin']) -> name('admin');