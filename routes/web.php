<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LicenseController;
use Illuminate\Support\Facades\Route;

/* Web Routes (Demo Version) 
Panel demostrativo del sistema de licencias
*/

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('gym')->name('gym.')->group(function() {
        Route::get('/generate', [LicenseController::class, 'create'])->name('create');
        Route::post('/store', [LicenseController::class, 'store'])->name('store');
        Route::get('/list', [LicenseController::class, 'index'])->name('index');
        Route::get('/download/{license}', [LicenseController::class, 'download'])->name('download');
        Route::put('/update/{id}', [LicenseController::class, 'update'])->name('update');
    });
});
