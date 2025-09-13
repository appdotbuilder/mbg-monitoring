<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\PenerimaMbgController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Main dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource routes for CRUD operations
    Route::resource('sekolah', SekolahController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('distribusi', DistribusiController::class);
    Route::resource('penerima-mbg', PenerimaMbgController::class);
    
    // Report routes
    Route::resource('reports', ReportController::class)->only(['index', 'store']);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
