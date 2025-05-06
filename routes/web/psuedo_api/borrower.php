<?php

use App\Http\Controllers\Borrower\BorrowItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('api')->group(function () {
        // 01. Borrow Items Controller
        Route::get('borrow-item', [BorrowItemController::class, 'index'])
            ->name('borrow-item.index');
        Route::get('borrow-request/{request_id}', [BorrowItemController::class, 'show'])
            ->name('borrow-items.show');
        Route::patch('borrow-request/{request_id}', [BorrowItemController::class, 'update'])
            ->name('borrow-items.update');
        Route::patch('borrow-request/{request_id}/cancel;', [BorrowItemController::class, 'cancel'])
            ->name('borrow-items.cancel');

        // // 02. Borrow Request Controller
        // Route::get('borrow-request', [BorrowItemController::class, 'index'])
        //     ->name('borrow-request.index');
        // Route::get('borrow-request/{request_id}', [BorrowItemController::class, 'show'])
        //     ->name('borrow-items.show');
        // Route::patch('borrow-request/{request_id}', [BorrowItemController::class, 'update'])
        //     ->name('borrow-items.update');
        // Route::patch('borrow-request/{request_id}/cancel;', [BorrowItemController::class, 'cancel'])
        //     ->name('borrow-items.cancel');
    });




});