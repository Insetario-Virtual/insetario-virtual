<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/insetario', [InsectController::class, 'index'])->name('insectary.index');

Route::get('/insetario/{id}', [InsectController::class, 'show'])->name('insectary.show');

Route::get('/insetario/search', [InsectController::class, 'search'])->name('insectary.search');