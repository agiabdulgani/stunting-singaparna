<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VillageController;
use App\Http\Controllers\WebAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - SIMONITA
| Sistem Informasi Monitoring Stunting & MBG Singaparna
|--------------------------------------------------------------------------
*/


// ==========================================================================
// 1. AUTHENTICATION
// ==========================================================================
// Hanya dapat diakses oleh user yang BELUM login.
// ==========================================================================

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [
        WebAuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        WebAuthController::class,
        'login'
    ]);

    // Register
    Route::get('/register', [
        WebAuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        WebAuthController::class,
        'register'
    ]);
});


// ==========================================================================
// 2. ROOT
// ==========================================================================

Route::get('/', function () {
    return redirect()->route('dashboard');
});


// ==========================================================================
// 3. APLIKASI UTAMA
// ==========================================================================
// Semua route di bawah wajib login.
// ==========================================================================

Route::middleware('auth')->group(function () {


    // ======================================================================
    // AUTH / LOGOUT
    // ======================================================================

    Route::post('/logout', [
        WebAuthController::class,
        'logout'
    ])->name('logout');


    // ======================================================================
    // DASHBOARD
    // ======================================================================

    Route::get('/dashboard', [
        VillageController::class,
        'index'
    ])->name('dashboard');


    // ======================================================================
    // EXPORT LAPORAN
    // ======================================================================

    Route::prefix('export')
        ->name('export.')
        ->group(function () {

            // Export PDF
            Route::get('/pdf', [
                VillageController::class,
                'exportPdf'
            ])->name('pdf');

            // Export Excel
            Route::get('/excel', [
                VillageController::class,
                'exportExcel'
            ])->name('excel');
        });


    // ======================================================================
    // MODUL 1 - DATA SASARAN
    // ======================================================================

    Route::prefix('target')
        ->name('target.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeTarget'
            ])->name('store');

            Route::get('/{id}/edit', [
                VillageController::class,
                'editTarget'
            ])->name('edit');

            Route::put('/{target}', [
                VillageController::class,
                'updateTarget'
            ])->name('update');

            Route::delete('/{target}', [
                VillageController::class,
                'destroyTarget'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 2 - DATA PENDUKUNG
    // ======================================================================

    Route::prefix('support')
        ->name('support.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeSupport'
            ])->name('store');

            Route::put('/{support}', [
                VillageController::class,
                'updateSupport'
            ])->name('update');

            Route::delete('/{support}', [
                VillageController::class,
                'destroySupport'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 3 - IDENTIFIKASI KENDALA
    // ======================================================================

    Route::prefix('constraint')
        ->name('constraint.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeConstraint'
            ])->name('store');

            Route::put('/{constraint}', [
                VillageController::class,
                'updateConstraint'
            ])->name('update');

            Route::delete('/{constraint}', [
                VillageController::class,
                'destroyConstraint'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 4 - PENYEDIAAN ANGGARAN
    // ======================================================================

    Route::prefix('budget')
        ->name('budget.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeBudget'
            ])->name('store');

            Route::put('/{budget}', [
                VillageController::class,
                'updateBudget'
            ])->name('update');

            Route::delete('/{budget}', [
                VillageController::class,
                'destroyBudget'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 5 - CAPAIAN LAYANAN
    // ======================================================================

    Route::prefix('service')
        ->name('service.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeService'
            ])->name('store');

            Route::put('/{service}', [
                VillageController::class,
                'updateService'
            ])->name('update');

            Route::delete('/{service}', [
                VillageController::class,
                'destroyService'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 6 - MAKAN BERGIZI GRATIS (MBG)
    // ======================================================================

    Route::prefix('mbg')
        ->name('mbg.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeMbg'
            ])->name('store');

            Route::put('/{mbg}', [
                VillageController::class,
                'updateMbg'
            ])->name('update');

            Route::delete('/{mbg}', [
                VillageController::class,
                'destroyMbg'
            ])->name('destroy');
        });


    // ======================================================================
    // MODUL 7 - DATA INDIVIDU BALITA
    // ======================================================================
    //
    // PENTING:
    // Jangan menggunakan method MBG untuk data individu.
    // Pastikan VillageController memiliki:
    //
    // storeIndividual()
    // updateIndividual()
    // destroyIndividual()
    //
    // ======================================================================

    Route::prefix('individual')
        ->name('individual.')
        ->group(function () {

            Route::post('/', [
                VillageController::class,
                'storeIndividual'
            ])->name('store');

            Route::put('/{individual}', [
                VillageController::class,
                'updateIndividual'
            ])->name('update');

            Route::delete('/{individual}', [
                VillageController::class,
                'destroyIndividual'
            ])->name('destroy');
        });

});