<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowItemController\BorrowItemIndexRequest;
use App\Lib\Services\Borrower\BorrowItemService;
use App\Lib\UseCases\Borrower\BorrowItem\DTOs\GetBorrowableItems\GetBorrowableItemsInputDto;
use Illuminate\Support\Facades\Log;

class BorrowItemController extends Controller
{
    private BorrowItemService $borrowItemService;

    public function __construct(BorrowItemService $borrowItemService)
    {
        $this->borrowItemService = $borrowItemService;
    }

    public function index(BorrowItemIndexRequest $request)
    {
        $validated = $request->validated();

        // 01. Call the service to get the borrowable items
        $response = $this->borrowItemService->getBorrowableItems(
            new GetBorrowableItemsInputDto(
                search: $validated['search'] ?? '',
                perPage: $validated['per-page'] ?? 20,
                page: $validated['page'] ?? 1,
                office: $validated['department'] ?? null
            )
        );

        // 02. Check if the service call was successful
        if (!$response->isSuccess) {
            Log::error('Error fetching borrowable items', [
                'code' => $response->errorCode,
                'message' => $response->message,
                // 'input' => $response->input,
            ]);
            return response('', $response->errorCode);
        }

        // 03. Success
        return response()->json(
            $response->data
        );
    }
}
