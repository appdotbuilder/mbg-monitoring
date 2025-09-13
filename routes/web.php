<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DistribusiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Main dashboard on home page - redirects to dashboard if authenticated, shows welcome if not
Route::get('/', function () {
    if (auth()->check()) {
        return app(DashboardController::class)->index(request());
    }
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Main dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes for CRUD operations
    Route::resource('sekolah', SekolahController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('distribusi', DistribusiController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
