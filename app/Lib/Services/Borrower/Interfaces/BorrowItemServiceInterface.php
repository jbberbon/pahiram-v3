<?php

namespace App\Lib\Services\Borrower\Interfaces;

interface BorrowItemServiceInterface
{
    public function getBorrowableItems(
        string $office,
        string $search,
        int $perPage,
        int $page
    ): array;

    public function getBorrowableItemsByDepartment(
        string $departmentId,
        string $search,
        int $perPage,
        int $page
    ): array;
}