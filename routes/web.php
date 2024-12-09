<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    Route::get('/tolls', [App\Http\Controllers\TollController::class, 'index'])->name('tolls.index');
    Route::get('/gasprices', [App\Http\Controllers\GasPriceController::class, 'index'])->name('gasprices.index');
    Route::get('/units', [App\Http\Controllers\UnitController::class, 'index'])->name('units.index');
    Route::get('/routes', [App\Http\Controllers\RouteController::class, 'index'])->name('routes.index');
    Route::resource('/budgets', App\Http\Controllers\BudgetController::class);
});
