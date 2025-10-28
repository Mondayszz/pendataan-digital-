<?php

use App\Http\Controllers\KkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('kk.index');
});

Route::resource('kk', KkController::class);
Route::get('/kk-export', [KkController::class, 'export'])->name('kk.export');

// Penduduk routes removed as requested (KK only)
