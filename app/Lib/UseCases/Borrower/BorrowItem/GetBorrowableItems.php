<?php

namespace App\Lib\UseCases\Borrower\BorrowItem;

use App\Lib\Constants\Statuses\ITEM_STATUS;
use App\Lib\UseCases\Borrower\BorrowItem\Collections\BorrowItemCollection;
use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsInputDto;
use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsOutputDto;
use App\Lib\UseCases\Borrower\BorrowItem\Interfaces\IGetBorrowableItems;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\ItemStatus;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class GetBorrowableItems implements IGetBorrowableItems
{
    public function execute(GetBorrowableItemsInputDto $params): GetBorrowableItemsOutputDto
    {
        $response = new GetBorrowableItemsOutputDto();

        try {
            $activeId = ItemStatus::where('item_status', ITEM_STATUS::ACTIVE)->value('id');

            $query = ItemGroup::leftJoin('items', function ($join) use ($activeId) {
                $join->on('items.item_group_id', '=', 'item_groups.id')
                    ->where('items.is_borrowable', true)
                    ->where('items.item_status_id', $activeId);
            })
                ->leftJoin('item_group_images', 'item_group_images.item_group_id', '=', 'item_groups.id')
                ->leftJoin('departments', 'departments.id', '=', 'items.department_id')
                ->select(
                    'item_groups.id as id',
                    'item_groups.model_name as name',
                    'item_groups.description as description',
                    'items.is_required_supervisor_approval as is_required_supervisor_approval',
                    'departments.shorthand_name as department',
                    DB::raw(
                        'json_agg(DISTINCT item_group_images.url) 
                        FILTER (WHERE item_group_images.url IS NOT NULL) as image_urls'
                    ),  // Filter NULL values
                    DB::raw('COUNT(items.id) as available_count'),
                )
                ->groupBy(
                    'item_groups.id',
                    'item_groups.model_name',
                    'item_groups.description',
                    'items.is_required_supervisor_approval',
                    'departments.shorthand_name',
                );

            // Filter by department
            if ($params->office) {
                $departmentId = Department::where('shorthand_name', $params->office)->value('id');
                if ($departmentId) {
                    $query->where('items.department_id', $departmentId);
                }
            }

            // Filter by search term
            if ($params->search) {
                $searchedItemsId = ItemGroup::where('model_name', 'like', '%' . $params->search . '%')->pluck('id');
                $query->whereIn('item_groups.id', $searchedItemsId->isNotEmpty() ? $searchedItemsId : []);
            }

            // Paginate
            $perPage = $params->perPage ?? 20;
            $itemsPaginator = $query->paginate($perPage);

            // return
            $response->isSuccess = true;
            $response->data = $itemsPaginator ? self::formatBorrowableItems($itemsPaginator) : [];
            return $response;
        } catch (\Exception $e) {
            \Log::error('Error fetching borrowable items: ' . $e->getMessage());
            $response->errorCode = 500;
            $response->message = $e->getMessage();
            return $response;
        }
    }

    public function formatBorrowableItems(LengthAwarePaginator $itemsPaginator): array
    {
        $items = $itemsPaginator->getCollection()->map(function ($item) {
            return [
                'id' => $item->id ?? null,
                'name' => $item->name ?? null,
                'is_required_supervisor_approval' => $item->is_required_supervisor_approval ?? null,
                'description' => $item->description ?? null,
                'department' => $item->department ?? null,
                'available_count' => $item->available_count ?? null,
                'images' => !empty($item->image_urls)
                    ? json_decode($item->image_urls, true) ?? []
                    : [],
            ];
        })->values(); // reset keys just in case

        return [
            'items' => $items,
            'pagination' => [
                'current_page' => $itemsPaginator->currentPage(),
                'per_page' => $itemsPaginator->perPage(),
                'total' => $itemsPaginator->total(),
                'last_page' => $itemsPaginator->lastPage(),
            ],
        ];
    }


}