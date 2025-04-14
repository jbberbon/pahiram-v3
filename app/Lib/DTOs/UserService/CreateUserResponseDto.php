<?php

namespace App\Lib\DTOs\UserService;

use App\Models\User;

class CreateUserResponseDto {
    public bool $isSuccess = false;
    public ?User $user = null;
}