<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('borrow', action: function () {
        return Inertia::render('borrow/borrow-items/BorrowItems');
    })->name('borrow');

    Route::get('borrow/checkout', action: function () {
        return Inertia::render('borrow/checkout/Checkout');
    })->name('borrow/checkout');
});