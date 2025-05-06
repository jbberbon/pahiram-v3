<?php

namespace App\Lib\Services\Borrower\DTOs\Output;

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
