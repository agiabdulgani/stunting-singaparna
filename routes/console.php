<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| File ini digunakan untuk mendaftarkan Artisan Console Commands.
|
*/


// ==========================================================================
// COMMAND: INSPIRE
// ==========================================================================

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Menampilkan kutipan inspiratif');