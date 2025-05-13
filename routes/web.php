<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// Route::middleware('auth')->group(function () {
//     Route::get('dashboard', action: function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/web/borrower.php';
require __DIR__ . '/web/lender.php';

require __DIR__ . '/web/psuedo_api/borrower.php';
require __DIR__ . '/web/psuedo_api/lender.php';