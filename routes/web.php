<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\AlumniInfoController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->prefix('alumni-info')
    ->name('alumni-info.')
    ->group(function () {
        Route::get('/create', [AlumniInfoController::class, 'create'])->name('create');
        Route::post('/', [AlumniInfoController::class, 'store'])->name('store');

        Route::get('/{alumniInfo}/edit', [AlumniInfoController::class, 'edit'])->name('edit');
        Route::put('/{alumniInfo}', [AlumniInfoController::class, 'update'])->name('update');
    });

require __DIR__.'/settings.php';
