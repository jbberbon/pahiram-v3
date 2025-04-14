<?php

namespace App\Lib\Interfaces\Services;

use App\Lib\DTOs\Auth\ApcisUserDto;
use App\Lib\DTOs\UserService\CreateUserResponseDto;

interface UserServiceInterface {
    public function createuser(ApcisUserDto $userData): CreateUserResponseDto;
}