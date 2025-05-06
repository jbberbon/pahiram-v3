<?php

use App\Http\Controllers\Lender\BorrowRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('api')->group(function () {
        // 01. Borrow Request Controller
        Route::patch('borrow-request/{request_id}/approve;', [BorrowRequestController::class, 'approve'])
            ->name('borrow-items.approve');

        
    });


}); 