<?php

namespace App\Lib\UseCases\Borrower\BorrowItem\Interfaces;

use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsInputDto;
use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsOutputDto;

interface IGetBorrowableItems
{
    public function execute(GetBorrowableItemsInputDto $params): GetBorrowableItemsOutputDto;
}