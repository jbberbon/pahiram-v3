<?php

namespace App\Lib\Services\Borrower;


use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsInputDto;
use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsOutputDto;
use App\Lib\UseCases\Borrower\BorrowItem\Interfaces\IGetBorrowableItems;
use Illuminate\Support\Facades\Log;

class BorrowItemService
{
    private IGetBorrowableItems $getBorrowableItemsUseCase;
    public function __construct(IGetBorrowableItems $getBorrowableItemsUseCase)
    {
        $this->getBorrowableItemsUseCase = $getBorrowableItemsUseCase;
    }

    public function getBorrowableItems(GetBorrowableItemsInputDto $params): GetBorrowableItemsOutputDto
    {
        Log::info('Fetching borrowable items with params: ', (array)$params);
        return $this->getBorrowableItemsUseCase->execute($params);
    }

    public function createBorrowItem($data)
    {
        // Logic to create a new borrow item
        return $data;
    }

    public function updateBorrowItem($id, $data)
    {
        // Logic to update an existing borrow item
        return $data;
    }

    public function deleteBorrowItem($id)
    {
        // Logic to delete a borrow item
        return true;
    }
}