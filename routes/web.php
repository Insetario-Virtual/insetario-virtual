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

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Login e Logout do Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Área Admin (apenas para usuários autenticados e admins)
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        // Insetos (CRUD) para admin
        Route::get('insectary', [InsectController::class, 'indexAdmin'])->name('insectary.index');
        Route::get('insectary/create', [InsectController::class, 'create'])->name('insectary.create');
        Route::post('insectary', [InsectController::class, 'store'])->name('insectary.store');
        Route::get('insectary/{insect}/edit', [InsectController::class, 'edit'])->name('insectary.edit');
        Route::put('insectary/{insect}', [InsectController::class, 'update'])->name('insectary.update');
        Route::delete('insectary/{insect}', [InsectController::class, 'destroy'])->name('insectary.destroy');

        Route::resource('orders', OrderController::class);
        Route::resource('families', FamilyController::class);
        Route::resource('cultures', CultureController::class);
        Route::resource('members', MemberController::class);
        Route::resource('site-data', SiteContentController::class);
    });

// Rotas públicas do Insetário
Route::prefix('insetario')->name('insectary.')->group(function () {
    Route::get('/', [InsectController::class, 'indexPublic'])->name('index');
    Route::get('/{id}', [InsectController::class, 'show'])->name('show');
});