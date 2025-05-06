<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    /**
     * Transform the resource into an array for the API response.
     */
    public function toApiArray(Request $request): array
    {
        return [
            'apcId' => $this?->apc_id,
            'fullName' => $this?->first_name . ' ' . $this?->last_name,
            'firstName' => $this?->first_name,
            'lastName' => $this?->last_name,
            'email' => $this?->email,

            // 'role' => optional($this->userRole)->role?->name,

        ];
    }
}
