<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($item) {
                return [
                    'name' => $item?->itemGroup?->model_name,
                    'apc_item_id' => $item?->apc_item_id,
                    'is_required_supervisor_approval' => $item?->is_required_supervisor_approval,
                    'department' => $item?->department?->shorthand_name,
                    'images' => $item?->itemGroup?->itemGroupImages?->map(function ($image) {
                        return [
                            'url' => $image->url,
                        ];
                    }),
                ];
            }),
            'pagination' => [
                'current_page' => $this->currentPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'last_page' => $this->lastPage(),
                'next_page_url' => $this->nextPageUrl(),
                'prev_page_url' => $this->previousPageUrl(),
            ],
        ];
    }
}
