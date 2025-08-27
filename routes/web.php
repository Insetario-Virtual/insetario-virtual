<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsectController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SiteContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Login e Logout do Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Área Admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        Route::resource('insectary', InsectController::class)->except(['show']);

        Route::resource('orders', OrderController::class);
        Route::resource('families', FamilyController::class);
        Route::resource('cultures', CultureController::class);
        Route::resource('members', MemberController::class);
        Route::resource('site-data', SiteContentController::class);
    });

// Rotas públicas do insetário
Route::get('/insetario', [InsectController::class, 'index'])->name('insectary.public.index');
Route::get('/insetario/{id}', [InsectController::class, 'show'])->name('insectary.public.show');