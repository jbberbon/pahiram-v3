<?php

namespace App\Http\Requests\BorrowItemController;

use App\Lib\Constants\DEPARTMENT;
use Illuminate\Foundation\Http\FormRequest;

class BorrowItemIndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'office' => 'nullable|in:' . implode(',', array: DEPARTMENT::LENDING_OFFICES),
            'search' => 'nullable|string|max:255',
            'per-page' => 'nullable|integer|min:1|max:50',
            'page' => 'nullable|integer|min:1',
        ];
    }
}
