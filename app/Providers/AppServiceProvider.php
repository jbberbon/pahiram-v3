<?php

namespace App\Providers;

use App\Lib\UseCases\Borrower\BorrowItem\GetBorrowableItems;
use App\Lib\UseCases\Borrower\BorrowItem\Interfaces\IGetBorrowableItems;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IGetBorrowableItems::class, GetBorrowableItems::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
