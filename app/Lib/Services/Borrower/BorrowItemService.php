<?php

namespace App\Lib\Services\Borrower;

use App\Http\Resources\BorrowItemResource;
use App\Lib\Constants\Statuses\ITEM_STATUS;
use App\Lib\Services\Borrower\DTOs\Input\GetBorrowableItemsInputDto;
use App\Lib\Services\Borrower\DTOs\Output\GetBorrowableItemsOutputDto;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\ItemStatus;

class BorrowItemService
{
    public function __construct()
    {
        // Constructor logic if needed
    }

    public function getBorrowableItems(GetBorrowableItemsInputDto $params): GetBorrowableItemsOutputDto
    {
        $response = new GetBorrowableItemsOutputDto();

        try {
            // 01. Start with the base query
            $activeId = ItemStatus::where('item_status', ITEM_STATUS::ACTIVE)->value('id');
            $items = Item::with([
                'itemGroup' => function ($query) {
                    $query->select('id', 'model_name');  // Only select 'id' and 'model_name' from the 'item_groups' table
                },
                'department' => function ($query) {
                    $query->select('id', 'shorthand_name');  // Only select 'id' and 'shorthand_name' from the 'departments' table
                },
                'itemGroup.itemGroupImages' => function ($query) {
                    $query->select('id', 'url');
                }
            ])
                ->where('is_borrowable', true)
                ->where('item_status_id', $activeId)
                ->get();

            // 02. Filter by department
            if ($params->office) {
                $departmentId = Department::where('shorthand_name', $params->office)->value('id');
                if ($departmentId) {
                    $items = $items->where('department_id', $departmentId);
                }
            }

            // 03. Filter by search term
            if ($params->search) {
                $searchedItemsId = ItemGroup::where('name', 'like', '%' . $params->search . '%')->pluck('id');
                // If no results, set the query to an empty set
                if ($searchedItemsId->isNotEmpty()) {
                    $items = $items->whereIn('item_group_id', $searchedItemsId);
                } else {
                    // Return no items (empty query)
                    $items = $items->whereIn('item_group_id', []);
                }
            }

            // 04. Paginate
            $perPage = $params->perPage ?? 20;
            $items = $items->paginate($perPage);

            // 05. Format the response
            $items = BorrowItemResource::collection($items);
            $response->isSuccess = true;
            $response->data = $items->getData();
            return $response;
            
        } catch (\Exception $e) {
            $response->errorCode = 500;
            $response->message = 'An error occurred while fetching borrowable items.';
            return $response;
        }

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