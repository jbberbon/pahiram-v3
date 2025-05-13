<?php

namespace App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems;

class GetBorrowableItemsOutputDto
{
    public function __construct(
        public bool $isSuccess = false,
        public int $errorCode = 0,
        public string $message = '',
        public array $data = [],
    ) {
    }
}
