<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'main'])->name('main');
Route::get('/catalog', [SiteController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{category}', [SiteController::class, 'catalogCategory'])->name('catalog.category');
Route::get('/news/{id}', [SiteController::class, 'show'])->name('news.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('journalist')->group(function () {
        Route::get('/journalist', [SiteController::class, 'journalist'])->name('journalist');
        Route::post('/news', [SiteController::class, 'store'])->name('news.store');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [SiteController::class, 'admin'])->name('admin');
    });
});