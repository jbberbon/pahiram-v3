<?php

namespace App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems;
class GetBorrowableItemsInputDto
{
    public function __construct(
        public ?string $office = null,
        public ?string $search = null,
        public ?int $perPage = null,
        public ?int $page = null,
    ) {
    }
}
