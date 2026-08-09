<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\WebAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - SIMONITA (Stunting & MBG Singaparna)
|--------------------------------------------------------------------------
*/

// 1. RUTE AUTHENTICATION (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login']);
    Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [WebAuthController::class, 'register']);
});

// Logout (Memerlukan Sesi Active)
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout')->middleware('auth');

// 2. RUTE APLIKASI UTAMA (Wajib Login)
Route::middleware('auth')->group(function () {

    // Halaman Utama & Dashboard SIMONITA
    Route::get('/', [VillageController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [VillageController::class, 'index']);

    // Export Laporan (PDF & Excel)
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('/pdf', [VillageController::class, 'exportPdf'])->name('pdf');
        Route::get('/excel', [VillageController::class, 'exportExcel'])->name('excel');
    });

    // CRUD 1: Data Sasaran
    Route::post('/target', [VillageController::class, 'storeTarget'])->name('target.store');
    Route::put('/target/{target}', [VillageController::class, 'updateTarget'])->name('target.update');
    Route::delete('/target/{target}', [VillageController::class, 'destroyTarget'])->name('target.destroy');

    // CRUD 2: Data Pendukung
    Route::post('/support', [VillageController::class, 'storeSupport'])->name('support.store');
    Route::put('/support/{support}', [VillageController::class, 'updateSupport'])->name('support.update');
    Route::delete('/support/{support}', [VillageController::class, 'destroySupport'])->name('support.destroy');

    // CRUD 3: Identifikasi Kendala
    Route::post('/constraint', [VillageController::class, 'storeConstraint'])->name('constraint.store');
    Route::put('/constraint/{constraint}', [VillageController::class, 'updateConstraint'])->name('constraint.update');
    Route::delete('/constraint/{constraint}', [VillageController::class, 'destroyConstraint'])->name('constraint.destroy');

    // CRUD 4: Penyediaan Anggaran
    Route::post('/budget', [VillageController::class, 'storeBudget'])->name('budget.store');
    Route::put('/budget/{budget}', [VillageController::class, 'updateBudget'])->name('budget.update');
    Route::delete('/budget/{budget}', [VillageController::class, 'destroyBudget'])->name('budget.destroy');

    // CRUD 5: Capaian Layanan
    Route::post('/service', [VillageController::class, 'storeService'])->name('service.store');
    Route::put('/service/{service}', [VillageController::class, 'updateService'])->name('service.update');
    Route::delete('/service/{service}', [VillageController::class, 'destroyService'])->name('service.destroy');

    // CRUD 6: Makan Bergizi Gratis (MBG)
    Route::post('/mbg', [VillageController::class, 'storeMbg'])->name('mbg.store');
    Route::put('/mbg/{mbg}', [VillageController::class, 'updateMbg'])->name('mbg.update');
    Route::delete('/mbg/{mbg}', [VillageController::class, 'destroyMbg'])->name('mbg.destroy');

});