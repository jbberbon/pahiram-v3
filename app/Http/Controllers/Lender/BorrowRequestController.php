<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use App\Http\Requests\BorrowItemController\BorrowItemIndexRequest;
use Illuminate\Http\Request;

class BorrowRequestController extends Controller
{
    public function index(BorrowItemIndexRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search'] ?? '';
        $perPage = $validated['per-page'] ?? 20;
        $page = $validated['page'] ?? 1;


    }
}
