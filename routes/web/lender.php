<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', action: function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});